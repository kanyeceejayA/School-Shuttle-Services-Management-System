<?php
   	include('dbconnect.php');
   	session_start();
   	$ses_sql='before';
   	$shuttle_sql='before';
   
   	if(!isset($_SESSION['login_user'])){
      
    	header("location:login.php");
   	}

   	$email = $_SESSION['login_user'];


    //set theme
	    if(!isset($_SESSION['theme'])){
	    	$_SESSION['theme']='<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.5/darkly/bootstrap.min.css">';
		}

   	//get username
   	if ($_SESSION['is_admin'] == 1 ) {

  		$ses_sql = "select StaffName from MemberOfStaff where staffemail = \"$email\"";
		$results = $db->query($ses_sql);
		$row = $results->fetch_assoc(); 

	   	$login_session = $row['StaffName'];
   	}else {

	  	$ses_sql = "select guardianName from Guardian where email = \"$email\"";
	  	$results = $db->query($ses_sql);
		$row = $results->fetch_assoc(); 

	   	$login_session = $row['guardianName'];

	}
      //set school variables
         $schoolemail = 'kakbr800@gmail.co.ug';
         $schoolphone = 256705346151;
         $schoollat  = 0.3316472; 
         $schoollng   = 32.5698705;


   	// get shuttle no
   	if ($_SESSION['is_admin'] == 1 ) {

   		$shuttle_sql = "select shuttleno from MemberOfStaff where staffemail = \"$email\"";
   		$resultss = $db->query($shuttle_sql);
		$row2 = $resultss->fetch_assoc(); 

   		$user_shuttle = $row2["shuttleno"];

         
   	} else {

   		$shuttle_sql = "select shuttleno from Guardian g join Child c on c.childid = g.childid where g.email = \"$email\"";
   		$resultss = $db->query($shuttle_sql);
		$row2 = $resultss->fetch_assoc(); 

   		$user_shuttle = $row2["shuttleno"];
   	}
	
	//alternative to file_get_contents
	function url_get_contents ($Url) {
	    if (!function_exists('curl_init')){ 
	        die('CURL is not installed!');
	    }
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $Url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $output = curl_exec($ch);
	    curl_close($ch);
	    return $output;
	}

   	
?>