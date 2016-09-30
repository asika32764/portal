<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Admin\Table\Table;
use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Database\Schema\Column;
use Windwalker\Database\Schema\DataType;
use Windwalker\Database\Schema\Key;
use Windwalker\Database\Schema\Schema;

/**
 * Migration class of PipelineInit.
 */
class PipelineInit extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->createTable(Table::PIPELINES, function(Schema $schema)
		{
			$schema->primary('id')->comment('Primary Key');
			$schema->varchar('title')->comment('Title');
			$schema->varchar('github')->comment('Github');
			$schema->text('config')->comment('Config');
			$schema->varchar('image')->comment('Main Image');
			$schema->tinyint('state')->signed(true)->comment('0: unpublished, 1:published');
			$schema->integer('ordering')->comment('Ordering');
			$schema->datetime('created')->comment('Created Date');
			$schema->integer('created_by')->comment('Author');
			$schema->datetime('modified')->comment('Modified Date');
			$schema->integer('modified_by')->comment('Modified User');
			$schema->text('params')->comment('Params');

			$schema->addIndex('github');
			$schema->addIndex('created_by');
		});
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->drop(Table::PIPELINES);
	}
}
