<?php
/**
 * Part of portal project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Api\Command\Github;

use Symfony\Component\Process\Process;
use Windwalker\Core\Console\CoreCommand;
use Windwalker\Core\DateTime\DateTime;
use Windwalker\Core\Logger\Logger;
use Windwalker\Structure\Structure;

/**
 * The DeployCommand class.
 *
 * @since  {DEPLOY_VERSION}
 */
class DeployCommand extends CoreCommand
{
	protected $name = 'deploy';
	protected $description = 'Review agent deploy commands';

	protected function doExecute()
	{
		$path = $this->getArgument(0);

		$config = (new Structure)->loadFile($path . '/.portal.yml', 'yaml');

		$scripts = (array) $config->get('scripts');

		foreach ($scripts as $i => $script)
		{
			if (!is_string($script))
			{
				throw new \RuntimeException('Script line: ' . ($i + 1) . ' not a string');
			}

			$this->run($script, $path);
		}

		return true;
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

//		$this->out(sprintf('[%s][%s] %s', $type, gmdate(DateTime::FORMAT_YMD_HIS), $message));
		Logger::debug('deploy', $message);

		return $this;
	}
}
