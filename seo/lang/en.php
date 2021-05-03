<?php
/**
 * @brief seo admin Language dictionary;
 * 
 * @fileinfo: data/modules/seo/lang/en.php
 */
$lang['seo']['title'] = 'seo enhancements';
$lang['seo']['description'] = 'The seo enhancements module enables rewritten URLs. This page shows the current status of this module.';
$lang['seo']['intro'] = 'This module enables rewritten URLs. See "module" page for webserver configuration hints.';
$lang['seo']['enablecheckbox'] = 'Enable URL rewriting';

$lang['seo']['enablednohtaccess'] = 'The seo enhancements module is enabled. In order for this module to function properly, you should copy the <i>htaccess.txt</i> file from the <i>data/modules/seo</i> directory to the root directory of your pluck installation and rename it to "<i>.htaccess</i>".';
$lang['seo']['disablednohtaccess'] = 'The seo enhancements module is disabled. If you want to enable this module, you should copy the <i>htaccess.txt</i> file from the <i>data/modules/seo</i> directory to the root directory of your pluck installation and rename it to "<i>.htaccess</i>".';
$lang['seo']['correct'] = 'The seo enhancements module is enabled and the web server is configured properly.';
$lang['seo']['disabledwithhtaccess'] = 'The seo enhancements module is disabled but the web server is configured to rewrite URLs. You should delete the <i>.htaccess</i> file in the root directory of your pluck installation, or activate the seo module <a href="admin.php?action=modulesettings">here</a>.';
$lang['seo']['enabledhtaccessincomplete'] = 'The seo enhancements module is enabled. In order for this module to function properly, you should add the contents of the <i>htaccess.txt</i> file in the <i>data/modules/seo</i> directory to the <i>.htaccess</i> file in the root directory of your pluck installation.';
$lang['seo']['disabledhtaccessincomplete'] = 'The seo enhancements module is disabled. If you want to enable this module, you should add the contents of the <i>htaccess.txt</i> file in the <i>data/modules/seo</i> directory to the <i>.htaccess</i> file in the root directory of your pluck installation.';
$lang['seo']['enablednotapache'] = 'The seo enhancements module is enabled but cannot detect your web server\'s configuration. In order for this module to function properly, you should configure your web server\'s URL rewrite engine similar to the <i>htaccess.txt</i> file for Apache web servers in the <i>data/modules/seo</i> directory.';
$lang['seo']['disablednotapache'] = 'The seo enhancements module is disabled and cannot detect your web server\'s configuration. In order for this module to function properly, you should remove your web server\'s URL rewrite configuration if set up previously.';
