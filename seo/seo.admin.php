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
		'title' => $lang['seo']['title']
	);
	return $module_page_admin;
}

function seo_page_admin_seo() {
	global $lang;
	?>
	<p>
		<strong><?php echo $lang['seo']['description']; ?></strong>
	</p>
	<?php
	//First check for Apache web server
	if (is_apache()) {
		if (!file_exists('.htaccess')) {
			if (seo_module_is_on()) {
				show_error($lang['seo']['enablednohtaccess'], 1);
			} else {
				show_error($lang['seo']['disablednohtaccess'] , 2);
			}
		} else {
			$htaccess = file_get_contents('.htaccess');
			if (preg_match('/^\s*RewriteEngine\s+On\s*$/im', $htaccess)
				&& preg_match('/^\s*RewriteRule\s+.*\?file\=/im', $htaccess)) {
				if (seo_module_is_on()) {
					show_error($lang['seo']['correct'], 3);
				} else {
					show_error($lang['seo']['disabledwithhtaccess'], 1);
				}
			} else {
				if (seo_module_is_on()) {
					show_error($lang['seo']['enabledhtaccessincomplete'], 1);
				} else {
					show_error($lang['seo']['disabledhtaccessincomplete'], 2);
				}
			}
		}
	//Not an Apache web server
	} else {
		if (seo_module_is_on()) {
			show_error($lang['seo']['enablednotapache'], 2);
		} else {
			show_error($lang['seo']['disablednotapache'], 2);
		}
	}
	?>
	<p>
		<a href="?action=modules">&lt;&lt;&lt; <?php echo $lang['general']['back']; ?></a>
	</p>
<?php
}
?>
