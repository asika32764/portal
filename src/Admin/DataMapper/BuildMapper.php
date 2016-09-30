<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Admin\DataMapper;

use Admin\Record\BuildRecord;
use Admin\Table\Table;
use Windwalker\Core\DataMapper\CoreDataMapper;
use Windwalker\Event\Event;

/**
 * The BuildMapper class.
 * 
 * @since  1.0
 */
class BuildMapper extends CoreDataMapper
{
	/**
	 * Property table.
	 *
	 * @var  string
	 */
	protected static $table = Table::BUILDS;

	/**
	 * Property keys.
	 *
	 * @var  string
	 */
	protected static $keys = 'id';

	/**
	 * Property alias.
	 *
	 * @var  string
	 */
	protected static $alias = 'build';

	/**
	 * Property dataClass.
	 *
	 * @var  string
	 */
	protected static $dataClass = BuildRecord::class;

	/**
	 * onAfterFind
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterFind(Event $event)
	{
		// Add your logic
	}

	/**
	 * onAfterCreate
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterCreate(Event $event)
	{
		// Add your logic
	}

	/**
	 * onAfterUpdate
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterUpdate(Event $event)
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

	/**
	 * onAfterFlush
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterFlush(Event $event)
	{
		// Add your logic
	}

	/**
	 * onAfterUpdateAll
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterUpdateAll(Event $event)
	{
		// Add your logic
	}
}
