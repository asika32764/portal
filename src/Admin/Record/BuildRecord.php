<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Admin\Record;

use Admin\Record\Traits\BuildDataTrait;
use Admin\Table\Table;
use Windwalker\Event\Event;
use Windwalker\Record\Record;

/**
 * The BuildRecord class.
 *
 * @since  1.0
 */
class BuildRecord extends Record
{
	use BuildDataTrait;

	/**
	 * Property table.
	 *
	 * @var  string
	 */
	protected $table = Table::BUILDS;

	/**
	 * Property keys.
	 *
	 * @var  string
	 */
	protected $keys = ['id'];

	/**
	 * onAfterLoad
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterLoad(Event $event)
	{
		// Add your logic
	}

	/**
	 * onAfterStore
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterStore(Event $event)
	{
		// Add your logic
	}

	/**
	 * onAfterDelete
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterDelete(Event $event)
	{
		// Add your logic
	}
}
