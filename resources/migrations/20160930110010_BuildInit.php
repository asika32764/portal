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
 * Migration class of BuildInit.
 */
class BuildInit extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->createTable(Table::BUILDS, function(Schema $schema)
		{
			$schema->primary('id')->comment('Primary Key');
			$schema->integer('pipeline_id')->comment('Pipeline ID');
			$schema->char('type')->length(10)->comment('pr, branch');
			$schema->integer('number')->comment('PR Number');
			$schema->varchar('branch')->comment('Branch');
			$schema->varchar('url')->comment('URL');
			$schema->text('detail')->comment('Detail Text');
			$schema->char('status')->comment('pending, success, error, failure');
			$schema->longtext('logs')->comment('Logs');
			$schema->datetime('created')->comment('Created Date');
			$schema->varchar('created_by')->comment('Author');
			$schema->datetime('modified')->comment('Modified Date');
			$schema->varchar('modified_by')->comment('Modified User');
			$schema->text('params')->comment('Params');

			$schema->addIndex('pipeline_id');
			$schema->addIndex('number');
			$schema->addIndex('branch');
			$schema->addIndex('type');
			$schema->addIndex('created_by');
		});
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->drop(Table::BUILDS);
	}
}
