<?php

/* 
 * Archie Gunasekara
 * 2014
 */

session_start();

require_once('config.ini.php');
require_once(BASE_PATH.'/code/setup.inc.php');

if(array_key_exists("user_name", $_SESSION) && $_REQUEST["page"] == "login_check") {

	include "code/" . $_REQUEST["page"] . ".php";
}
else {

	include "header.php";
	include "code/" . $page . ".php";
	include "footer.php";
}

?>
