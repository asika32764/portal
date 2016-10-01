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
use Admin\Record\PipelineRecord;
use Portal\Review\BuildHelper;
use Portal\Review\Deployment;
use Windwalker\Core\Controller\AbstractController;
use Windwalker\Data\Data;
use Windwalker\Structure\Structure;
use Windwalker\Utilities\Reflection\ReflectionHelper;

/**
 * The PushController class.
 *
 * @since  {DEPLOY_VERSION}
 */
class PushController extends AbstractController
{
	/**
	 * Do execute action.
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$data = $this->request->getBody()->__toString();

		$data = new Structure($data);

		$repo = $data['repository.full_name'];

		// Find pipeline
		$pipeline = PipelineMapper::findOne(['github' => $repo]);

		if ($pipeline->isNull())
		{
			throw new \RuntimeException('Pipeline for ' . $repo . ' not found.');
		}

		$branch = explode('/', $data['ref']);
		$branch = array_pop($branch);

		$build = BuildMapper::findOne(['pipeline_id' => $pipeline->id, 'type' => BuildHelper::TYPE_BRANCH, 'branch' => $branch]);

		if ($build->isNull())
		{
			$build = $this->createBuild($data, $pipeline, $branch);
		}

		// Deploy
		$sha = $data['after'];

		/** @var Deployment $deploy */
		$deploy = $this->container->newInstance(Deployment::class, ['pipeline' => $pipeline]);
		return $deploy->deploy($build, $sha);
	}

	/**
	 * createBuild
	 *
	 * @param Structure      $data
	 * @param PipelineRecord $pipeline
	 * @param string         $branch
	 *
	 * @return Data
	 */
	protected function createBuild(Structure $data, PipelineRecord $pipeline, $branch)
	{
		$this->getPackage()
			->getMvcResolver()
			->getModelResolver()
			->addNamespace(ReflectionHelper::getNamespaceName(AdminPackage::class) . '/Model');

		// Create build
		/** @var BuildModel $model */
		$model = $this->getModel('Build');

		$build = new Data([
			'pipeline_id' => $pipeline->id,
			'branch' => $branch,
			'type'   => BuildHelper::TYPE_BRANCH,
			'url'    => $data['commits.url'],
			'detail' => $data->toString(),
		]);

		$model->save($build);

		return $build;
	}
}
