<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Admin\Controller\Pipeline;

use Admin\Model\PipelineModel;
use Admin\View\Pipeline\PipelineHtmlView;
use Phoenix\Controller\AbstractSaveController;
use Windwalker\Core\Controller\Traits\CsrfProtectionTrait;
use Windwalker\Data\DataInterface;
use Windwalker\Data\Data;

/**
 * The SaveController class.
 * 
 * @since  1.0
 */
class SaveController extends AbstractSaveController
{
	use CsrfProtectionTrait;
	
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'pipeline';

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

	/**
	 * Property formControl.
	 *
	 * @var  string
	 */
	protected $formControl = 'item';

	/**
	 * Property model.
	 *
	 * @var  PipelineModel
	 */
	protected $model;

	/**
	 * Property view.
	 *
	 * @var  PipelineHtmlView
	 */
	protected $view;

	/**
	 * prepareExecute
	 *
	 * @return  void
	 */
	protected function prepareExecute()
	{
		parent::prepareExecute();
	}

	/**
	 * preSave
	 *
	 * @param DataInterface $data
	 *
	 * @return void
	 */
	protected function preSave(DataInterface $data)
	{
		parent::preSave($data);
	}

	/**
	 * postSave
	 *
	 * @param DataInterface $data
	 *
	 * @return  void
	 */
	protected function postSave(DataInterface $data)
	{
		parent::postSave($data);
	}

	/**
	 * postExecute
	 *
	 * @param mixed $result
	 *
	 * @return  mixed
	 */
	protected function postExecute($result = null)
	{
		return parent::postExecute($result);
	}
}
