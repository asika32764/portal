<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Admin\Controller\Builds;

use Phoenix\Controller\Batch\BatchDelegatingController;
use Windwalker\Core\Controller\Traits\CsrfProtectionTrait;

/**
 * The UpdateController class.
 *
 * @since  1.0
 */
class BatchController extends BatchDelegatingController
{
	use CsrfProtectionTrait;
	
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'builds';

	/**
	 * Property itemName.
	 *
	 * @var  string
	 */
	protected $itemName = 'build';

	/**
	 * Property listName.
	 *
	 * @var  string
	 */
	protected $listName = 'builds';
}
