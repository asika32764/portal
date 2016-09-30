<?php
/**
 * Part of edutw project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Portal\Script;

use Phoenix\Script\BootstrapScript;
use Windwalker\Core\Asset\AbstractScript;

/**
 * The AngleScript class.
 *
 * @since  {DEPLOY_VERSION}
 */
class AngleScript extends AbstractScript
{
	const THEME_A = 'a';
	const THEME_B = 'b';
	const THEME_C = 'c';
	const THEME_D = 'd';
	const THEME_E = 'e';
	const THEME_F = 'f';
	const THEME_G = 'g';
	const THEME_H = 'h';

	/**
	 * css
	 *
	 * @param string $theme
	 *
	 * @return  void
	 */
	public static function css($theme = self::THEME_E)
	{
//		static::getAsset()->alias('phoenix/js/jquery/jquery.js', 'portal/vendor/jquery/dist/jquery.js');

		if (!static::inited(__METHOD__))
		{
			static::addCSS('portal/vendor/simple-line-icons/css/simple-line-icons.css');
			static::addCSS('portal/vendor/animate.css/animate.min.css');
			static::addCSS('portal/vendor/whirl/dist/whirl.css');
			static::addCSS('portal/css/bootstrap.css');
			static::addCSS('portal/vendor/fontawesome/css/font-awesome.min.css');
			static::addCSS('portal/css/app.css');
			static::addCSS('portal/css/theme-' . $theme . '.css');
			static::addCSS('portal/css/admin.css');
		}
	}

	/**
	 * js
	 *
	 * @return  void
	 */
	public static function js()
	{
		if (!static::inited(__METHOD__))
		{
			BootstrapScript::script();
			static::addJS('portal/vendor/modernizr/modernizr.custom.js');
			static::addJS('portal/vendor/jQuery-Storage-API/jquery.storageapi.js');
			static::addJS('portal/vendor/jquery.easing/js/jquery.easing.js');
			static::addJS('portal/vendor/animo.js/animo.js');
//			static::addJS('portal/js/modules/sidebar.js');
//			static::addJS('portal/js/modules/toggle-state.js');
			static::addJS('portal/js/app.js');
		}
	}

	/**
	 * core
	 *
	 * @param string $theme
	 *
	 * @return  void
	 */
	public static function core($theme = self::THEME_E)
	{
		static::css($theme);
		static::js();
	}
}
