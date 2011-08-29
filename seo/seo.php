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

function seo_info() {
	global $lang;
	return array(
		'name'          => 'seo enhancements',
		'intro'         => 'This module enables rewritten URLs. Only for use with Apache webserver.',
		'version'       => '0.2',
		'author'        => $lang['general']['pluck_dev_team'],
		'website'       => 'http://www.pluck-cms.org',
		'icon'          => 'images/seo.png',
		'compatibility' => '4.7'
	);
}
function is_apache_module($htaccess = true) {
$result = false;
	if (function_exists('apache_get_modules'))
		$result = in_array('mod_rewrite', apache_get_modules());
	else {
		ob_start();
		phpinfo(INFO_MODULES);
		$contents = ob_get_contents();
		ob_end_clean();
		$result = (strpos($contents, 'mod_rewrite') !== false);
	}
	if($htaccess)
		return ($result && file_exists('.htaccess')) ? true : false;
	else
		return $result;
}
function seo_module_is_on() {
	if (module_get_setting('seo','enable_seo') == 'true' && is_apache_module())
		return true;
	else
		return false;
}
function seo_page_url_prefix($prefix) {
	if (seo_module_is_on() && basename($_SERVER['PHP_SELF']) != 'admin.php')
		return $prefix = SITE_URL.'/';
	else
		return;
}
function seo_album_url_prefix($prefix) {
	if (seo_module_is_on())
		return $prefix = '/album/';
	else
		return;
}
function seo_blog_url_prefix($prefix) {
	if (seo_module_is_on())
		return $prefix = '/blog/';
	else
		return;
}
function seo_blog_cat_prefix($prefix) {
	if (seo_module_is_on())
		return $prefix = '/blog-category/';
	else
		return;
}
function seo_theme_content($content) {
	if (seo_module_is_on()) {
		$content = str_replace('href="?file=', 'href="'.SITE_URL.'/', $content);
		$content = str_replace('src="images/', 'src="'.SITE_URL.'/images/', $content);
	}
	return $content;
}

function seo_settings_default() {
	return array(
		'enable_seo'	=> true,
	);
}
function seo_admin_module_settings_beforepost() {
	echo '<span class="kop2">seo</span>
		<table>
			<tr>
				<td><input type="checkbox" name="enable_seo" id="enable_seo" value="true" '; if (module_get_setting('seo','enable_seo') == 'true') { echo 'checked="checked" '; } echo '/></td>
				<td><label for="enable_seo">&emsp; Enable seo module</label></td>
			</tr>
	</table><br />';
}

function seo_admin_module_settings_afterpost() {
	//Compose settings array
	$settings = array(
		'enable_seo' => (isset($_POST['enable_seo'])) ? 'true' : 'false',
	);
	//Save settings
	module_save_settings('seo', $settings);
}
?>