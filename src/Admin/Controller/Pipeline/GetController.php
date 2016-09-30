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
use Phoenix\Controller\Display\EditDisplayController;
use Windwalker\Core\Model\ModelRepository;
use Windwalker\Core\View\AbstractView;

/**
 * The GetController class.
 * 
 * @since  1.0
 */
class GetController extends EditDisplayController
{
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
	 * Property model.
	 *
	 * @var  PipelineModel
	 */
	protected $model = 'pipeline';

	/**
	 * Property view.
	 *
	 * @var  PipelineHtmlView
	 */
	protected $view = 'pipeline';

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
	 * prepareExecute
	 *
	 * @param ModelRepository $model
	 *
	 * @return void
	 */
	protected function prepareModelState(ModelRepository $model)
	{
		parent::prepareModelState($model);
	}

	/**
	 * prepareViewData
	 *
	 * @param   AbstractView $view
	 *
	 * @return  void
	 */
	protected function prepareViewData(AbstractView $view)
	{
		parent::prepareViewData($view);
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
