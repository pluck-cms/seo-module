<?php
/*
 * This file is part of the seo enhancements module for pluck
 * Copyright (c) pluck team
 * http://www.pluck-cms.org

 * Pluck is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * See docs/COPYING for the complete license.
*/

//Make sure the file isn't accessed directly.
defined('IN_PLUCK') or exit('Access denied!');

function seo_pages_admin() {
	$module_page_admin[] = array(
		'func'  => 'seo',
		'title' => 'seo enhancements'
	);
	return $module_page_admin;
}

function seo_page_admin_seo() {
	global $lang;
	?>
	<p>
		<strong>The seo enhancements module enables rewritten URLs. This page shows the current status of this module.</strong>
	</p>
	<?php
	//First check for Apache web server
	if (is_apache()) {
		if (!file_exists('.htaccess')) {
			if (seo_module_is_on()) {
				show_error('The seo enhancements module is enabled. In order for this module to function properly, you should copy the <i>htaccess.txt</i> file from the <i>data/modules/seo</i> directory to the root directory of your pluck installation and rename it to "<i>.htaccess</i>".', 1);
			} else {
				show_error('The seo enhancements module is disabled. If you want to enable this module, you should copy the <i>htaccess.txt</i> file from the <i>data/modules/seo</i> directory to the root directory of your pluck installation and rename it to "<i>.htaccess</i>".', 2);
			}
		} else {
			$htaccess = file_get_contents('.htaccess');
			if (preg_match('/^\s*RewriteEngine\s+On\s*$/im', $htaccess)
				&& preg_match('/^\s*RewriteRule\s+.*\?file\=/im', $htaccess)) {
				if (seo_module_is_on()) {
					show_error('The seo enhancements module is enabled and the web server is configured properly.', 3);
				} else {
					show_error('The seo enhancements module is disabled but the web server is configured to rewrite URLs. You should delete the <i>.htaccess</i> file in the root directory of your pluck installation.', 1);
				}
			} else {
				if (seo_module_is_on()) {
					show_error('The seo enhancements module is enabled. In order for this module to function properly, you should add the contents of the <i>htaccess.txt</i> file in the <i>data/modules/seo</i> directory to the <i>.htaccess</i> file in the root directory of your pluck installation.', 1);
				} else {
					show_error('The seo enhancements module is disabled. If you want to enable this module, you should add the contents of the <i>htaccess.txt</i> file in the <i>data/modules/seo</i> directory to the <i>.htaccess</i> file in the root directory of your pluck installation.', 2);
				}
			}
		}
	//Not an Apache web server
	} else {
		if (seo_module_is_on()) {
			show_error('The seo enhancements module is enabled but cannot detect your web server\'s configuration. In order for this module to function properly, you should configure your web server\'s URL rewrite engine similar to the <i>htaccess.txt</i> file for Apache web servers in the <i>data/modules/seo</i> directory.', 2);
		} else {
			show_error('The seo enhancements module is disabled and cannot detect your web server\'s configuration. In order for this module to function properly, you should remove your web server\'s URL rewrite configuration if set up previously.', 2);
		}
	}
	?>
	<p>
		<a href="?action=modules">&lt;&lt;&lt; <?php echo $lang['general']['back']; ?></a>
	</p>
<?php
}
?>