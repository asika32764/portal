<?php
/**
 * Part of portal project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Portal\Provider;

use Github\Client;
use Windwalker\DI\Container;
use Windwalker\DI\ServiceProviderInterface;

/**
 * The GithubApiProvider class.
 *
 * @since  {DEPLOY_VERSION}
 */
class GithubApiProvider implements ServiceProviderInterface
{
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container $container The DI container.
	 *
	 * @return  void
	 */
	public function register(Container $container)
	{
		$container->share(Client::class, function (Container $container)
		{
			$config = $container->get('config');
			$github = new Client;
			$github->authenticate($config->get('github.token'), null, Client::AUTH_URL_TOKEN);

			return $github;
		})->alias('github', Client::class);
	}
}
