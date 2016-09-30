<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Admin\Form\Build;

use Admin\Field\Build\BuildListField;
use Admin\Field\Build\BuildModalField;
use Phoenix\Form\PhoenixFieldTrait;
use Windwalker\Core\Form\AbstractFieldDefinition;
use Windwalker\Core\Language\Translator;
use Windwalker\Form\Field;
use Windwalker\Form\Form;
use Windwalker\Validator\Rule;

/**
 * The BuildEditDefinition class.
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
				->label(Translator::translate('admin.build.field.title'))
				->setFilter('trim')
				->required(true);

			// Alias
			$this->text('alias')
				->label(Translator::translate('admin.build.field.alias'));

			// Image
			$this->text('image')
				->label(Translator::translate('admin.build.field.image'));

			// URL
			$this->text('url')
				->label(Translator::translate('admin.build.field.url'))
				->setValidator(Rule\UrlValidator::class)
				->set('class', 'validate-url');

			// Example: Build List
			$this->add('build_list', BuildListField::class)
				->label('List Example');

			// Example: Build Modal
			$this->add('build_modal', BuildModalField::class)
				->label('Modal Example');
		});

		// Text Fieldset
		$this->fieldset('text', function(Form $form)
		{
			// Introtext
			$this->textarea('introtext')
				->label(Translator::translate('admin.build.field.introtext'))
				->set('rows', 10);

			// Fulltext
			$this->textarea('fulltext')
				->label(Translator::translate('admin.build.field.fulltext'))
				->set('rows', 10);
		});

		// Created fieldset
		$this->fieldset('created', function(Form $form)
		{
			// State
			$this->radio('state')
				->label(Translator::translate('admin.build.field.state'))
				->set('class', 'btn-group')
				->set('default', 1)
				->option(Translator::translate('phoenix.grid.state.published'), '1')
				->option(Translator::translate('phoenix.grid.state.unpublished'), '0');

			// Created
			$this->calendar('created')
				->label(Translator::translate('admin.build.field.created'));

			// Modified
			$this->calendar('modified')
				->label(Translator::translate('admin.build.field.modified'))
				->disabled();

			// Author
			$this->text('created_by')
				->label(Translator::translate('admin.build.field.author'));

			// Modified User
			$this->text('modified_by')
				->label(Translator::translate('admin.build.field.modifiedby'))
				->disabled();
		});
	}
}
