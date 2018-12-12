<?php
	include 'session.php';
	$_SESSION['theme']='<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.5/superhero/bootstrap.min.css">';

	header('location:index.php');
?>