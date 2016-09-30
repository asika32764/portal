<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Admin\View\Build;

use Phoenix\Script\BootstrapScript;
use Phoenix\Script\PhoenixScript;
use Phoenix\View\EditView;
use Phoenix\View\ItemView;
use Windwalker\Core\Renderer\RendererHelper;
use Windwalker\Core\Utilities\Classes\DocblockHelper;

/**
 * The BuildHtmlView class.
 * 
 * @since  1.0
 */
class BuildHtmlView extends EditView
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'build';

	/**
	 * Property formDefinition.
	 *
	 * @var  string
	 */
	protected $formDefinition = 'edit';

	/**
	 * Property formControl.
	 *
	 * @var  string
	 */
	protected $formControl = 'item';

	/**
	 * Property formLoadData.
	 *
	 * @var  boolean
	 */
	protected $formLoadData = true;

	/**
	 * prepareData
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @see  ItemView
	 * ------------------------------------------------------
	 * @var  $data->state  \Windwalker\Registry\Registry
	 * @var  $data->item   \Admin\Record\BuildRecord
	 *
	 * @see  EditView
	 * ------------------------------------------------------
	 * @var  $data->form   \Windwalker\Form\Form
	 *
	 * @return  void
	 */
	protected function prepareData($data)
	{
		parent::prepareData($data);

		$this->prepareScripts();
		$this->prepareMetadata();
	}

	/**
	 * prepareDocument
	 *
	 * @return  void
	 */
	protected function prepareScripts()
	{
		PhoenixScript::core();
		PhoenixScript::chosen();
		PhoenixScript::formValidation();
		BootstrapScript::checkbox(BootstrapScript::GLYPHICONS);
		BootstrapScript::buttonRadio();
		BootstrapScript::tooltip();
	}

	/**
	 * prepareMetadata
	 *
	 * @return  void
	 */
	protected function prepareMetadata()
	{
		$this->setTitle();
	}
}
