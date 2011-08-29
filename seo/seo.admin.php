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

require_once ('data/modules/blog/functions.php');

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
	//First check for Apache and mod_rewrite module.
	if (!is_apache_module(false))
		$errors[] = show_error('The mod_rewrite module for Apache is not enabled on your server, or you are not running an Apache server. This module supports only Apache servers. Please ask the system administrator to enable it.', 1, true);
	if (!file_exists('.htaccess'))
			$errors[] = show_error('In order for this module to function properly, you should copy the file called <i>.htaccess</i> (you can find it in the <i>data/modules/seo</i> directory) to the root directory of your pluck installation, using your FTP-application.', 1, true);

	if (!isset($errors))
		show_error('The seo enhancements module has been configured properly.', 3);
	else {
		foreach ($errors as $error)
			echo $error;
		unset($error);
	}
	?>
	<p>
		<a href="?action=modules">&lt;&lt;&lt; <?php echo $lang['general']['back']; ?></a>
	</p>
<?php
}
?>