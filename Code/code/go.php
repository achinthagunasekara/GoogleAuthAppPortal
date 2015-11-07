<?php

/* 
 * Achintha Gunasekara
 * 2014
 */

if($_SESSION['user_name'] != "") {

	header( 'Location: index.php?page=home' );
}
else {

	$auth = new Authenticator();

	if($_REQUEST["go"] == true) {

		if($auth->user_login($_REQUEST["user_name"], $_REQUEST["password"])) {

			$_SESSION['user_name'] = $_REQUEST["user_name"];
			header( 'Location: index.php?page=home' ) ;
		}
		else {

			$tmp_message = "Login failed";

			$tpl->assign('message', $tmp_message);
			$auth->destroy_session_data();
		}
	}

	$tpl->display('go.tpl');
}

?>
