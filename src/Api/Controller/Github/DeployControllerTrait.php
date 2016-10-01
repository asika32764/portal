<?php
/**
 * Part of portal project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Api\Controller\Github;

use Admin\AdminPackage;
use Admin\DataMapper\BuildMapper;
use Admin\DataMapper\PipelineMapper;
use Admin\Model\BuildModel;
use Admin\Record\BuildRecord;
use Portal\Review\BuildHelper;
use Symfony\Component\Process\Process;
use Windwalker\Data\Data;
use Windwalker\Structure\Structure;
use Windwalker\Utilities\Reflection\ReflectionHelper;

/**
 * The DeployControllerTrait class.
 *
 * @since  {DEPLOY_VERSION}
 */
trait DeployControllerTrait
{
	/**
	 * registerModelPath
	 *
	 * @return  void
	 */
	protected function registerModelPath()
	{
		$this->getPackage()
			->getMvcResolver()
			->getModelResolver()
			->addNamespace(ReflectionHelper::getNamespaceName(AdminPackage::class) . '/Model');
	}

	/**
	 * processDeploy
	 *
	 * @param Structure $data
	 * @param string    $repo
	 * @param string    $name
	 * @param string    $type
	 *
	 * @return  int
	 */
	protected function processDeploy(Structure $data, $repo, $name, $type = BuildHelper::TYPE_PR)
	{
		$pipeline = PipelineMapper::findOne(['github' => $repo]);

		if ($pipeline->isNull())
		{
			throw new \RuntimeException("No pipeline for: $repo");
		}

		$key = $type == BuildHelper::TYPE_PR ? 'number' : 'branch';

		/** @var BuildRecord $build */
		$build = BuildMapper::findOne([
			'pipeline_id' => $pipeline->id,
			$key   => $name,
			'type' => $type
		]);

		// Update information
		$build->status = BuildHelper::STATUS_PENDING;
		$build->url    = BuildHelper::TYPE_PR == $type ? $data['pull_request.url'] : $data['repository.url'];
		$build->detail = $data->toString();

		$build->store();

		return $this->runDeployCommand($build);
	}

	/**
	 * createBuild
	 *
	 * @param int    $pipelineId
	 * @param string $name
	 * @param string $type
	 *
	 * @return  boolean
	 */
	protected function createBuild($pipelineId, $name, $type)
	{
		$key = $type == BuildHelper::TYPE_PR ? 'number' : 'branch';

		if (BuildMapper::findOne(['pipeline_id' => $pipelineId, $key => $name])->notNull())
		{
			return true;
		}

		$data = new Data([
			'pipeline_id' => $pipelineId,
			'type' => $type
		]);

		$data->$key = $name;

		/** @var BuildModel $model */
		$model = $this->getModel('Build');

		return $model->save($data);
	}

	/**
	 * runDeployCommand
	 *
	 * @param BuildRecord $build
	 *
	 * @return  int
	 */
	protected function runDeployCommand(BuildRecord $build)
	{
		if ($this->app->environment->platform->isWin())
		{
			$proc = new Process('start /b php ' . WINDWALKER_ROOT . '/windwalker github deploy ' . $build->id);

			return $proc->run();
		}

		$proc = new Process('php ' . WINDWALKER_ROOT . '/windwalker github deploy ' . $build->id . ' &');

		return $proc->start();
	}
}
