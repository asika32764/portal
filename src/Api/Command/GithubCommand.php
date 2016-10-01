<?php
/**
 * Part of portal project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Api\Command;

use Api\Command\Github\DeployCommand;
use Windwalker\Core\Console\CoreCommand;

/**
 * The GithubCommand class.
 *
 * @since  {DEPLOY_VERSION}
 */
class GithubCommand extends CoreCommand
{
	protected $name = 'github';
	protected $description = 'GitHub Review commands';

	/**
	 * init
	 *
	 * @return  void
	 */
	protected function init()
	{
		parent::init();

		$this->addChild(DeployCommand::class);
	}
}
