<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Admin\Form\Pipeline;

use Admin\Field\Pipeline\PipelineListField;
use Admin\Field\Pipeline\PipelineModalField;
use Phoenix\Form\PhoenixFieldTrait;
use Windwalker\Core\Form\AbstractFieldDefinition;
use Windwalker\Core\Language\Translator;
use Windwalker\Form\Field;
use Windwalker\Form\Form;
use Windwalker\Validator\Rule;

/**
 * The PipelineEditDefinition class.
 *
 * @since  1.0
 */
class EditDefinition extends AbstractFieldDefinition
{
	use PhoenixFieldTrait;

	/**
	 * Define the form fields.
	 *
	 * @param Form $form The Windwalker form object.
	 *
	 * @return  void
	 */
	public function doDefine(Form $form)
	{
		// Basic fieldset
		$this->fieldset('basic', function(Form $form)
		{
			// ID
			$this->hidden('id');

			// Title
			$this->text('title')
				->label(Translator::translate('admin.pipeline.field.title'))
				->setFilter('trim')
				->required(true);

			// Alias
			$this->text('github')
				->label('GitHub');

			// Image
//			$this->text('image')
//				->label(Translator::translate('admin.pipeline.field.image'));
		});

		// Text Fieldset
		$this->fieldset('text', function(Form $form)
		{
			// Introtext
			$this->textarea('config')
				->label('Config')
				->set('rows', 10);
		});

		// Created fieldset
		$this->fieldset('created', function(Form $form)
		{
			// State
			$this->radio('state')
				->label(Translator::translate('admin.pipeline.field.state'))
				->set('class', 'btn-group')
				->set('default', 1)
				->option(Translator::translate('phoenix.grid.state.published'), '1')
				->option(Translator::translate('phoenix.grid.state.unpublished'), '0');

			// Created
			$this->calendar('created')
				->label(Translator::translate('admin.pipeline.field.created'));

			// Modified
			$this->calendar('modified')
				->label(Translator::translate('admin.pipeline.field.modified'))
				->disabled();

			// Author
			$this->text('created_by')
				->label(Translator::translate('admin.pipeline.field.author'));

			// Modified User
			$this->text('modified_by')
				->label(Translator::translate('admin.pipeline.field.modifiedby'))
				->disabled();
		});
	}
}
