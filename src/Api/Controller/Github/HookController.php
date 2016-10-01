<?php
/**
 * Part of portal project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Api\Controller\Github;

use Windwalker\Core\Controller\AbstractController;
use Windwalker\Core\Controller\Traits\JsonApiTrait;
use Windwalker\Core\Controller\Traits\JsonResponseTrait;
use Windwalker\String\StringNormalise;
use Windwalker\Structure\Structure;

/**
 * The HookController class.
 *
 * @since  {DEPLOY_VERSION}
 */
class HookController extends AbstractController
{
	use JsonApiTrait;

	/**
	 * Do execute action.
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$body = $this->request->getBody()->__toString();

		$this->verifySignature($body);

		$event = $this->input->header->get('X-Github-Event');
		$event = StringNormalise::toCamelCase($event);

		$controller = __NAMESPACE__ . '\\' . $event . 'Controller';

		return $this->hmvc(new $controller, $this->input, $this->getPackage());
	}

	/**
	 * verifySignature
	 *
	 * @param   string  $body
	 *
	 * @return  void
	 */
	protected function verifySignature($body)
	{
		$sign = $this->input->header->getString('X-Hub-Signature');

		if (!$sign)
		{
			throw new \RuntimeException('Miss X-Hub-Signature');
		}

		list($algo, $signature) = explode('=', $sign, 2);
		
		if (!hash_equals($signature, hash_hmac($algo, $body, $this->app->get('system.secret'))))
		{
			throw new \RuntimeException('Signature invalid.');
		}
	}
}
