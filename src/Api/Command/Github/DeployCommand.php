<?php
/**
 * Part of portal project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Api\Command\Github;

use Admin\DataMapper\BuildMapper;
use Admin\DataMapper\PipelineMapper;
use Portal\Review\BuildHelper;
use Portal\Review\Deployment;
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

	/**
	 * doExecute
	 *
	 * @return  array
	 */
	protected function doExecute()
	{
		$id = $this->getArgument(0);

		$build = BuildMapper::findOne($id);

		$pipeline = PipelineMapper::findOne($build->pipeline_id);

		$data = new Structure($build->detail);

		/** @var Deployment $deploy */
		$deploy = $this->console->container->newInstance(Deployment::class, ['pipeline' => $pipeline]);

		$sha = $build->type == BuildHelper::TYPE_PR ? $data['pull_rerquest.sha'] : $data['after'];

		return $deploy->deploy($build, $sha);
	}
}
