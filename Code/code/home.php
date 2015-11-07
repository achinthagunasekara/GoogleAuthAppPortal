<?php

/* 
 * Achintha Gunasekara
 * 2014
 */
 
if($_REQUEST["logout"] == true) {
	
	$auth = new Authenticator();
	$auth->destroy_session_data();
	header( 'Location: index.php?page=go' ) ;
}

$tpl->assign('user_name', $_SESSION['user_name']);
$tpl->display('home.tpl');

?>
