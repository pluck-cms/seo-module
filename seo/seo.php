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

	//quickfix for issue #4, needs to be cleaned up
	//first loads the $lang variable is not yet installed
	if ($lang){
		$seoauthor = $lang['general']['pluck_dev_team'];
		$seoname = $lang['seo']['title'];
		$seointro = $lang['seo']['intro'];
	} else {
		//defaults in english
		$seoname = 'seo enhancements';
		$seointro = 'This module enables rewritten URLs. See "module" page for webserver configuration hints.';
		$seoauthor = "pluck development team";
	}

	return array(
		'name'          => $seoname,
		'intro'         => $seointro,
		'version'       => '0.4',
		'author'        => $seoauthor,
		'website'       => 'http://www.pluck-cms.org',
		'icon'          => 'images/seo.png',
		'compatibility' => '4.7'
	);
}

function is_apache() {
	if (strpos($_SERVER['SERVER_SOFTWARE'],'Apache') !== false)
		return TRUE;
	else
		return FALSE;
}

function seo_module_is_on() {
	return module_get_setting('seo', 'enable_seo') === 'true';
}

function seo_page_url_prefix(&$prefix) {
	if (seo_module_is_on()) $prefix = '';
}

function seo_album_url_prefix(&$prefix) {
	if (seo_module_is_on()) $prefix = '/.album/';
}

function seo_blog_url_prefix(&$prefix) {
	if (seo_module_is_on()) $prefix = '/.blog/';
}

function seo_blog_cat_prefix(&$prefix) {
	if (seo_module_is_on()) $prefix = '/.blog-category/';
}

function seo_theme_content(&$content) {
	if (seo_module_is_on()) {
		$content = str_replace('href="?file=', 'href="'.SITE_URL.'/', $content);
		$content = str_replace('src="images/', 'src="'.SITE_URL.'/images/', $content);
	}
}

function seo_settings_default() {
	return array(
		'enable_seo'	=> 'false',
	);
}

function seo_admin_module_settings_beforepost() {
	global $lang;
	echo '<span class="kop2">'.$lang['seo']['title'].'</span>
		<table>
			<tr>
				<td><input type="checkbox" name="enable_seo" id="enable_seo" value="true" ' . (seo_module_is_on() ? ' checked="checked"' : '') . '/></td>
				<td><label for="enable_seo">&emsp; '.$lang['seo']['enablecheckbox'].'</label></td>
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
