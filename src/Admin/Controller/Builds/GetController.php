<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Admin\Controller\Builds;

use Admin\Model\BuildsModel;
use Admin\View\Builds\BuildsHtmlView;
use Phoenix\Controller\Display\ListDisplayController;
use Windwalker\Core\Model\ModelRepository;
use Windwalker\Core\View\AbstractView;

/**
 * The GetController class.
 * 
 * @since  1.0
 */
class GetController extends ListDisplayController
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'builds';

	/**
	 * Property itemName.
	 *
	 * @var  string
	 */
	protected $itemName = 'build';

	/**
	 * Property listName.
	 *
	 * @var  string
	 */
	protected $listName = 'builds';

	/**
	 * Property model.
	 *
	 * @var  BuildsModel
	 */
	protected $model = 'builds';

	/**
	 * Property view.
	 *
	 * @var  BuildsHtmlView
	 */
	protected $view = 'builds';

	/**
	 * Property ordering.
	 *
	 * Please remember add table alias.
	 *
	 * @var  string
	 */
	protected $defaultOrdering = null;

	/**
	 * Property direction.
	 *
	 * @var  string
	 */
	protected $defaultDirection = null;

	/**
	 * prepareExecute
	 *
	 * @return  void
	 */
	protected function prepareExecute()
	{
		$this->layout = $this->input->get('layout');
		$this->format = $this->input->get('format', 'html');

		parent::prepareExecute();
	}

	/**
	 * prepareUserState
	 *
	 * @param   ModelRepository $model
	 *
	 * @return  void
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
}
