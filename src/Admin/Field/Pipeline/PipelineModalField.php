<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Admin\Field\Pipeline;

use Admin\Table\Table;
use Phoenix\Field\ModalField;

/**
 * The PipelineModalField class.
 *
 * @since  1.0
 */
class PipelineModalField extends ModalField
{
	/**
	 * Property table.
	 *
	 * @var  string
	 */
	protected $table = Table::PIPELINES;

	/**
	 * Property view.
	 *
	 * @var  string
	 */
	protected $view = 'pipelines';

	/**
	 * Property package.
	 *
	 * @var  string
	 */
	protected $package = 'admin';

	/**
	 * Property titleField.
	 *
	 * @var  string
	 */
	protected $titleField = 'title';

	/**
	 * Property keyField.
	 *
	 * @var  string
	 */
	protected $keyField = 'id';
}
