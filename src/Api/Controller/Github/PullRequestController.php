<?php
/**
 * Part of portal project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Api\Controller\Github;

use Admin\DataMapper\PipelineMapper;
use Portal\Review\BuildHelper;
use Windwalker\Core\Controller\AbstractController;
use Windwalker\Structure\Structure;

/**
 * The PullRequestController class.
 *
 * @since  {DEPLOY_VERSION}
 */
class PullRequestController extends AbstractController
{
	use DeployControllerTrait;

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
		// Create build
		$repo = $data['repository.full_name'];

		// Find pipeline
		$pipeline = PipelineMapper::findOne(['github' => $repo]);

		if ($pipeline->isNull())
		{
			throw new \RuntimeException('Pipeline for ' . $repo . ' not found.');
		}

		$this->createBuild($pipeline->id, $data['pull_request.number'], BuildHelper::TYPE_PR);

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
		$repo = $data['repository.full_name'];
		$number = $data['pull_request.number'];

		$this->processDeploy($data, $repo, $number, BuildHelper::TYPE_PR);

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
