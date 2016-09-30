<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Admin\Controller\Pipelines;

use Phoenix\Controller\Batch\AbstractDeleteController;
use Windwalker\Core\Controller\Traits\CsrfProtectionTrait;

/**
 * The DeleteController class.
 *
 * @since  1.0
 */
class DeleteController extends AbstractDeleteController
{
	use CsrfProtectionTrait;
	
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'pipelines';

	/**
	 * Property itemName.
	 *
	 * @var  string
	 */
	protected $itemName = 'pipeline';

	/**
	 * Property listName.
	 *
	 * @var  string
	 */
	protected $listName = 'pipelines';
}
