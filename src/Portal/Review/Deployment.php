<?php
/**
 * Part of portal project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Portal\Review;

use Admin\DataMapper\BuildMapper;
use Admin\Record\BuildRecord;
use Admin\Record\PipelineRecord;
use Admin\Record\Traits\BuildDataTrait;
use Admin\Record\Traits\PipelineDataTrait;
use Github\Client;
use Symfony\Component\Process\Process;
use Windwalker\Core\DateTime\DateTime;
use Windwalker\Core\Logger\Logger;
use Windwalker\Data\Data;
use Windwalker\Filesystem\Folder;
use Windwalker\Ioc;
use Windwalker\Structure\Structure;

/**
 * The Deployment class.
 *
 * @since  {DEPLOY_VERSION}
 */
class Deployment
{
	/**
	 * Property github.
	 *
	 * @var  Client
	 */
	protected $github;

	/**
	 * Property user.
	 *
	 * @var  string
	 */
	protected $user;

	/**
	 * Property repo.
	 *
	 * @var  string
	 */
	protected $repo;

	/**
	 * Property pipeline.
	 *
	 * @var  PipelineRecord
	 */
	private $pipeline;

	/**
	 * Property logs.
	 *
	 * @var  array
	 */
	protected $logs = [];

	/**
	 * Deployment constructor.
	 *
	 * @param Client                 $github
	 * @param Data|PipelineDataTrait $pipeline
	 */
	public function __construct(Client $github, Data $pipeline)
	{
		$this->github = $github;
		$this->pipeline = $pipeline;

		list($user, $repo) = explode('/', $pipeline->github);

		$this->user = $user;
		$this->repo = $repo;
	}

	/**
	 * deploy
	 *
	 * @param BuildRecord $build
	 * @param string      $sha
	 *
	 * @return array
	 */
	public function deploy(BuildRecord $build, $sha)
	{
		if ($build->type === BuildHelper::TYPE_PR)
		{
			$deployment = $this->createDeployment($sha);
		}

		try
		{
			$buildID = ($build->type === BuildHelper::TYPE_PR) ? $build->number : $build->branch;

			// Do deploy
			$name = BuildHelper::getBuildName($build->type, $buildID);
			$this->log('Prepare deployment.');

			$path = BuildHelper::getBuildPath($this->user . '/' . $this->repo, $build->type, $buildID);
			$this->log('Target path: ' . $path);

			// Create DB
			$dbname = 'review_' . $name;
			$db = Ioc::getDatabase();
			$dbCommand = $db->getDatabase($dbname);

			if (!$dbCommand->exists())
			{
				$dbCommand->create($dbname);
			}

			$this->log('DB created: ' . $dbname);

			// Delete first
			if (is_dir($path))
			{
				Folder::delete($path);
			}

			// Git clone
			$this->run(sprintf('git clone --depth=50 https://github.com/%s/%s.git %s', $this->user, $this->repo, $path));

			$this->log('git clone success.');

			// Load Config
			if (!is_file($path . '/.portal.yml'))
			{
				throw new \RuntimeException('.portal.yml file not found.');
			}

			$config = (new Structure)->loadFile($path . '/.portal.yml', 'yaml');
			$this->log('.portal.yml found, start running scripts.');

			// Parse Files
			$parses = (array) $config->get('parses');

			foreach ($parses as $file)
			{
				$file = $path . '/' . $file;

				if (!is_file($file))
				{
					continue;
				}

				$vars = [
					'LYRA_PORTAL_ENV_MYSQL_USER' => 'root',
					'LYRA_PORTAL_ENV_MYSQL_PASS' => '1234',
					'LYRA_PORTAL_ENV_MYSQL_DBNAME' => $dbname,
				];

				$this->replaceVariables($file, $vars);
			}

			// Run Scripts
			$scripts = (array) $config->get('scripts');

			foreach ($scripts as $i => $script)
			{
				if (!is_string($script))
				{
					throw new \RuntimeException('Script line: ' . ($i + 1) . ' not a string');
				}

				$this->run($script, $path);
			}

			if ($build->type === BuildHelper::TYPE_PR)
			{
				$deployment = $this->updateDeployment(
					$deployment['id'],
					BuildHelper::STATUS_SUCCESS,
					BuildHelper::getBuildUrl($this->user . '/' . $this->repo, $build->type, $buildID)
				);
			}

			$build->status = 'success';
		}
		catch (\Exception $e)
		{
			if ($build->type === BuildHelper::TYPE_PR)
			{
				$deployment = $this->updateDeployment(
					$deployment['id'],
					BuildHelper::STATUS_ERROR,
					BuildHelper::getBuildUrl($this->user . '/' . $this->repo, $build->type, $buildID),
					'Build error: ' . $e->getMessage()
				);
			}

			$build->status = 'error';
		}
		finally
		{
			$build->logs = implode("\n", $this->logs);
			$build->store();

			file_put_contents(WINDWALKER_LOGS . '/lasi-build.log', $build->logs);

			return $this->logs;
		}
	}

	/**
	 * createDeployment
	 *
	 * @param   string  $sha
	 *
	 * @return  array
	 */
	public function createDeployment($sha)
	{
		return $this->github->api('deployment')->create($this->user, $this->repo, ['ref' => $sha, 'environment' => 'dev-server']);
	}

	/**
	 * updateDeployment
	 *
	 * @param int    $id
	 * @param string $state
	 * @param string $url
	 * @param string $description
	 *
	 * @return array
	 */
	public function updateDeployment($id, $state, $url, $description = 'Go to LyraServer')
	{
		return $this->github->api('deployment')->updateStatus($this->user, $this->repo, $id, [
			'state'       => $state,
			'target_url'  => $url,
			'description' => $description
		]);
	}

	/**
	 * replaceVariables
	 *
	 * @param string $file
	 * @param array  $vars
	 *
	 * @return  bool
	 */
	protected function replaceVariables($file, array $vars)
	{
		$content = file_get_contents($file);

		$content = strtr($content, $vars);

		file_put_contents($file, $content);

		return true;
	}

	/**
	 * Method to get property Github
	 *
	 * @return  Client
	 */
	public function getGithubClient()
	{
		return $this->github;
	}

	/**
	 * Method to set property github
	 *
	 * @param   Client $github
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setGithubClient(Client $github)
	{
		$this->github = $github;

		return $this;
	}

	/**
	 * run
	 *
	 * @param   string  $cmd
	 *
	 * @return  int
	 */
	public function run($cmd, $cwd = null)
	{
		$this->log('>> ' . $cmd);
		$proc = new Process($cmd, $cwd);

		$r = $proc->run(function ($type, $buffer)
		{
			if ($type == Process::ERR)
			{
				$this->log($buffer, 'error');
			}
			else
			{
				$this->log($buffer);
			}
		});

		if ($r !== 0)
		{
			throw new \RuntimeException($proc->getErrorOutput());
		}

		return $r;
	}

	/**
	 * log
	 *
	 * @param string $message
	 * @param string $type
	 *
	 * @return  static
	 */
	public function log($message, $type = 'info')
	{
		if (is_array($message))
		{
			foreach ($message as $msg)
			{
				$this->log($msg);
			}

			return $this;
		}

		$this->logs[] = sprintf('[%s][%s] %s', $type, gmdate(DateTime::FORMAT_YMD_HIS), $message);

		return $this;
	}
}
