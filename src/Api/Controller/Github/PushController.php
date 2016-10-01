<?php
/**
 * Part of portal project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Api\Controller\Github;

use Admin\DataMapper\BuildMapper;
use Admin\DataMapper\PipelineMapper;
use Admin\Model\BuildModel;
use Admin\Record\PipelineRecord;
use Portal\Review\BuildHelper;
use Windwalker\Core\Controller\AbstractController;
use Windwalker\Data\Data;
use Windwalker\Structure\Structure;

/**
 * The PushController class.
 *
 * @since  {DEPLOY_VERSION}
 */
class PushController extends AbstractController
{
	use DeployControllerTrait;

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

		$build = $this->createBuild($pipeline->id, $branch, BuildHelper::TYPE_BRANCH);

		return $this->processDeploy($build, $repo, $branch, BuildHelper::TYPE_BRANCH);
	}
}
