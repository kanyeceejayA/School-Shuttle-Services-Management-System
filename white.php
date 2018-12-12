<?php
	include 'session.php';
	$_SESSION['theme']='<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.5/cerulean/bootstrap.min.css">';

	header('location:index.php');
?>