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
use Admin\Table\Table;
use Github\Client;
use Portal\Review\BuildHelper;
use Portal\Review\Deployment;
use Windwalker\Core\Controller\AbstractController;
use Windwalker\Data\Data;
use Windwalker\Structure\Structure;
use Windwalker\Utilities\Reflection\ReflectionHelper;

/**
 * The PullRequestController class.
 *
 * @since  {DEPLOY_VERSION}
 */
class PullRequestController extends AbstractController
{
	const ACTION_OPENED = 'opened';
	const ACTION_SYNCHRONIZE = 'synchronize';

	/**
	 * Do execute action.
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$data = $this->request->getBody()->__toString();

		$data = new Structure($data);

		return $this->delegate($data['action'], $data);
	}

	/**
	 * opened
	 *
	 * @param Structure $data
	 *
	 * @return  string
	 */
	protected function opened(Structure $data)
	{
		$this->getPackage()
			->getMvcResolver()
			->getModelResolver()
			->addNamespace(ReflectionHelper::getNamespaceName(AdminPackage::class) . '/Model');

		// Create build
		/** @var BuildModel $model */
		$model = $this->getModel('Build');

		$repo = $data['repository.full_name'];

		// Find pipeline
		$pipeline = PipelineMapper::findOne(['github' => $repo]);

		if ($pipeline->isNull())
		{
			throw new \RuntimeException('Pipeline for ' . $repo . ' not found.');
		}

		$model->save(new Data([
			'pipeline_id' => $pipeline->id,
			'number' => $data['pull_request.number'],
			'type'   => BuildHelper::TYPE_PR,
			'url'    => $data['pull_request.url'],
			'detail' => $data->toString(),
		]));

		return $this->synchronize($data);
	}

	/**
	 * synchronize
	 *
	 * @param Structure $data
	 *
	 * @return  string
	 */
	protected function synchronize(Structure $data)
	{
		$sha = $data['pull_request.head.sha'];

		$repo = $data['repository.full_name'];
		$number = $data['pull_request.number'];

		$pipeline = PipelineMapper::findOne(['github' => $repo]);

		if ($pipeline->isNull())
		{
			throw new \RuntimeException("No pipeline for: $repo");
		}

		$build = BuildMapper::findOne([
				'pipeline_id' => $pipeline->id,
				'number' => $number,
				'type' => BuildHelper::TYPE_PR
			]);

		$deploy = $this->container->newInstance(Deployment::class, ['pipeline' => $pipeline]);
		$deploy->deploy($build, $sha);

//		$params = [
//			'state' => 'success',
//			'target_url' => 'http://lyrasoft.net',
//			'description' => 'Hello World',
//			'context' => 'lyra-portal'
//		];
//
//		$github->api('repo')->statuses()->create('lyrasoft', 'portal', $sha, $params);
//
//		$github->api('deployment')->updateStatus('lyrasoft', 'portal', 13135528, [
//			'state' => 'success',
//			'target_url' => 'http://lyrasoft.net',
//			'description' => 'Hello World'
//		]);
	}
}
