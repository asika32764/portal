<?php
/**
 * Part of portal project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Portal\Review;

use Windwalker\Filesystem\Path;
use Windwalker\Ioc;

/**
 * The BuildHelper class.
 *
 * @since  {DEPLOY_VERSION}
 */
class BuildHelper
{
	const TYPE_PR = 'pr';
	const TYPE_BRANCH = 'branch';

	const STATUS_PENDING = 'pending';
	const STATUS_SUCCESS = 'success';
	const STATUS_ERROR   = 'error';
	const STATUS_FAILURE = 'error';

	/**
	 * getBuildPath
	 *
	 * @param string $repo
	 * @param string $type
	 * @param string $name
	 *
	 * @return string
	 */
	public static function getBuildPath($repo, $type, $name)
	{
		list($user, $repo) = explode('/', $repo);

		$config = Ioc::getConfig();

		$root = $config->get('build.root', '/var/www/net/lyrasoft/review');

		$path = $root . '/' . $user . '/' . $repo . '/' . static::getBuildName($type, $name);

		return Path::clean($path);
	}

	/**
	 * getBuildUrl
	 *
	 * @param string $repo
	 * @param string $type
	 * @param string $name
	 *
	 * @return  string
	 */
	public static function getBuildUrl($repo, $type, $name)
	{
		list($user, $repo) = explode('/', $repo);

		$config = Ioc::getConfig();

		$host = $config->get('build.host', 'review.lyrasoft.net/');

		$url = 'http://' . $host . '/' . $user . '/' . $repo . '/' . static::getBuildName($type, $name);

		return $url;
	}

	/**
	 * getBuildName
	 *
	 * @param string $type
	 * @param string $name
	 *
	 * @return  bool|string
	 */
	public static function getBuildName($type, $name)
	{
		switch ($type)
		{
			case static::TYPE_PR:
				return 'pr-' . $name;
			case static::TYPE_BRANCH:
				return $name;
			default:
				return 'test';
		}
	}
}
