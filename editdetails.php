<?php
	include 'session.php';
	
	$target = ($_SESSION['is_admin']==1) ? 'editadmindetails.php' : 'editchilddetails.php' ;
	header('location:'.$target);
?>