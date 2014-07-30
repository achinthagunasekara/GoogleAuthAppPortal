<?php

/* 
 * Archie Gunasekara
 * 2014
 */

//user must be logged in to view any valid page
if(array_key_exists(@$_REQUEST['page'], $valid_pages) && $_SESSION['user_name'] != "")
{
	$title = $valid_pages[@$_REQUEST['page']];
	$page = @$_REQUEST['page'];
}
else
{
	$title = $valid_pages['go'];
	$page = 'go';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<META NAME="keywords" CONTENT="Portal">
<META NAME="description" CONTENT="Portal">

<title><?php echo $title ?></title>

<script type="text/javascript" src="libs/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="libs/js/tabs.js"></script>

<link href="css/960.css" rel="stylesheet" type="text/css" />
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/tabs.css" rel="stylesheet" type="text/css" />

</head>

<body>

<div class="container_12" id="main_container">
	<div id="head" class="grid_12 head_div">

	</div>
