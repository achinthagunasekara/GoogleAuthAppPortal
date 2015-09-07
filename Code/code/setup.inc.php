<?php

/* 
 * Archie Gunasekara
 * 2014
 */
 
$config = parse_ini_file(BASE_PATH . '/includes/config.ini.php', TRUE);

$valid_pages = array(
		"go" => "Login Page",
		"home" => "Home",
		"your_app" => "Your Application",
		"login_check" => "Login Check"
		);

//Load all the class files
if ($handle = opendir('includes/classes/'))
{
	while (false !== ($file = readdir($handle)))
	{
		if ($file != "." && $file != "..")
		{
			$reverse = strrev($file); //remove any temp files
			if($reverse{0} != "~")
			{
				include "includes/classes/" . $file;
			}
		}
	}

	closedir($handle);
}
else
{
	echo "Failed to load the modules!";
}

define('SMARTY_DIR', BASE_PATH.'/libs/smarty/');

require_once(SMARTY_DIR.'Smarty.class.php');

class Smarty_Extend extends Smarty
{
	function Smarty_Extend($path_dir, $cache = false, $subdirs = false)
	{
		//$this->Smarty();
		parent::__construct();
		$this->template_dir = $path_dir.'/templates';
		$this->secure_dir = $path_dir.'/templates';
		$this->config_dir = $path_dir.'/config';
		$this->compile_dir = $path_dir.'/files/templates_c';
		$this->cache_dir = $path_dir.'/files/cache';
		$this->caching = $cache;
		$this->use_sub_dirs = $subdirs;
		$this->config_booleanize = true;
	}
}

define('DEFAULT_CACHE_LIFETIME', 3600);

/**
* Main Instance of Smarty Template Engine
* @global Smarty_Extend $tpl
*/

$tpl = new Smarty_Extend(BASE_PATH,false);

/*
* Turn on error reporting in debug mode
* this is done after smarty etc since they
* trigger lost of E_STRICT errors
*/

if (isset($config['DEBUG']) && $config['DEBUG']) {
    error_reporting(E_ALL | E_STRICT);
} else {
    error_reporting(E_ALL ^ E_NOTICE);
}

/* Set a few vars that are always available to all apps */

$tpl->assign('config_path',$config['PATH']);
$tpl->assign('base_path','');

?>