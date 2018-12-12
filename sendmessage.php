<?php
   include('session.php');
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){

	$sendtext = $_POST["sendtext"];
	$contact = $_POST['contact'];
	$type = $_POST['type'];
	$demail = $_POST['demail'];
	$dphone = $_POST['dphone'];
	$temail = $_POST['temail'];
	$tphone = $_POST['tphone'];

	$email ='';
	$phone = '';
		if ($contact=='D') {

	 		$email= $demail;
	 		$phone = $dphone;

		} elseif($contact=='T'){

			$email= $temail;
	 		$phone = $tphone;
		}else{
			$email=$schoolemail;
			$phone = $schoolphone;
		}

		if ($type == 'E') {
			//mail send format. $mail= $to."<br>".$subject."<br>".$headers."<br>".$txt;
			$to = $email;
			$headers = "From: ".$_SESSION['login_user']. "\r\n";
			$subject ="School Shuttle Services -". $login_session;
			$txt =$sendtext."<br> From: ". $login_session;

			$mail= $to."<br>".$subject."<br>".$headers."<br>".$txt;

			mail($to,$subject, $txt, $headers);
			// echo $mail;
			$message= 'Email Sent';
		} elseif ($type=='W') {
			// $message =$phone ."   ".$sendtext;
			header("location:http://api.whatsapp.com/send?phone=".$phone."&text=".$sendtext);

		}elseif($type=='S') {
			$sendtext = rawurlencode($sendtext);
			$msgstatus = url_get_contents("http://gps.kirungi.co.ug/sms.php?to=".$phone."&text=".$sendtext);



			if(strpos($msgstatus,'status=0') == '434'){

				$message = "SMS sent";

			}elseif(strpos($msgstatus,'status=34') == '434') {

				$error = 'error: SMS Server Down. Please Contact Admin.';

			}elseif(strpos($msgstatus,'status=2') == '434') {

				$error = 'error: Insufficient Balance. Contact Admin.';

			}elseif(strpos($msgstatus,'status=1') == '434') {

				$error = 'error: Un authorised user. Contact Admin.';

			}elseif(strpos($msgstatus,'status=3') == '434' ||strpos($msgstatus,'status=4') !== false  ) {

				$error = 'error: Unauthorized destination number.';

			}else {
				$error = 'error: SMS not Sent: '. $msgstatus;
			}
			
		}else{
		    $error = "Error occured ";
		}

}
?>
<html">
   <head>
   		<?php echo $_SESSION['theme']; ?>
        <link rel="stylesheet" href="css/styles.css">

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


	  <title>Contact Shuttle- School Shuttle Services Management System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style type="text/css">
	body{
		}
        .header {
            background-color: rgba(0,0,0,1);
            height: 10%;
        }
        
</style>
<body>
<!-- Navigation Header -->
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
				</button>
				<a class="navbar-brand" href="index.php">School Shuttle Services<br>Management System</a>
			</div>
				<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li><a href="index.php"><span class='glyphicon glyphicon-home'></span> Home</a></li>

					<li><a href="displaymap.php"><span class='glyphicon glyphicon-map-marker'></span> Display Map</a></li>

					<?php if(!($_SESSION['is_admin'])){ echo " 
					<li class='active'><a href='sendmessage.php'><span class='glyphicon glyphicon-phone'></span> Contact Us</a></li>
					";}?>

					<?php if($_SESSION['is_admin']){ echo " 
					<li class='dropdown active'>
						<a class='dropdown-toggle' data-toggle='dropdown' href='#'><span class='glyphicon glyphicon-phone'></span> Contact
						<span class='caret'></span></a>
						<ul class='dropdown-menu'>
							<li class='active'><a href='sendmessage.php'>Contact Us</a></li>
							<li><a href='sendguardianmessage.php'>Contact Guardians</a></li>
						</ul>
					</li>";} ?>

					<?php if(!($_SESSION['is_admin'])){ echo " 
					<li><a href='viewstaff.php'><span class='glyphicon glyphicon-record'></span> View Staff</a></li>
					";}?>

					<?php if($_SESSION['is_admin']){ echo " 
					<li class='dropdown'>
						<a class='dropdown-toggle' data-toggle='dropdown' href='#'><span class='glyphicon glyphicon-record'></span> View Lists
						<span class='caret'></span></a>
						<ul class='dropdown-menu'>
							<li><a href='viewchildren.php'>View Children</a></li>
							<li><a href='viewstaff.php'>View Staff</a></li>
						</ul>
					</li> ";} ?>

					<?php if($_SESSION['is_admin']){ echo " 
					<li class='dropdown'>
						<a class='dropdown-toggle' data-toggle='dropdown' href='#'><span class='glyphicon glyphicon-pencil'></span> Register
						<span class='caret'></span></a>
						<ul class='dropdown-menu'>
							<li><a href='registerchild.php'>Register Child</a></li>
							<li><a href='savelocation.php'>Add Home Location</a></li>
							<li><a href='registeradmins.php'>Register Staff</a></li>
							<li><a href='pic.php'>Add Profile Picture</a></li> 
						</ul>
					</li>
					"; }?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class='dropdown'>
						<a class='dropdown-toggle' data-toggle='dropdown' href='#'><span class="glyphicon glyphicon-qrcode"></span> Theme
						<span class='caret'></span></a>
						<ul class='dropdown-menu'>
							<li><a href='white.php'>Light Theme</a></li>
							<li><a href='blue.php' >Blue Theme</a></li>
							<li><a href='dark.php' >Dark Theme</a></li>
						</ul>
					</li>

					<li><a href="editdetails.php"><span class="glyphicon glyphicon-user"></span> Edit Details</a></li>
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
				</ul>
			</div>
		</div>
	</nav>

<div style="height:85%; min-height:750px; background-color:rgba(0,0,0,0);" align="center">

		<br>
		<h5 align="center" >
            <a href="index.php">
				<img src="images/new/yellow_bus-512.png" height="50px">
            </a>
			<br>Contacts for Shuttle Number <?php echo $user_shuttle; ?>
		</h5>
			
		<table table style="border-spacing: 10px 10px;border-collapse: separate; width: 50%; max-width:800px;" class="table table-bordered">
			<tr><th>Driver</th><th>Teacher On Board</th></tr>
			<tr><td>
				<?php 
					$sql = "SELECT staffName, staffNumber, staffPicture, staffemail FROM drivershuttle where shuttleNo =  '".$GLOBALS['user_shuttle']."';";
                                    $driver = $db->query($sql);
                                  
                                    if ($driver->num_rows > 0) {
                                        // output data of each row
                                        
                                    	$row = $driver->fetch_assoc();
                                            echo "<img src='".$row["staffPicture"]."' height='100px' width='100px' class='img-circle'>
                                            <br>
                                            name: ".$row["staffName"]."<br>
                                            No.: ". $row["staffNumber"]."<br>
                                            Email: ". $row['staffemail'];
                                            $demail = $row['staffemail'];
                                            $dphone = $row['staffNumber'];
                                    
                                    }
                ?>
            </td><td>
            	<?php
            		$sql = "SELECT staffName, staffNumber, staffPicture, staffemail FROM teachershuttle where shuttleNo =  '".$GLOBALS['user_shuttle']."';";
                                    $driver = $db->query($sql);
                                  
                                    if ($driver->num_rows > 0) {
                                        // output data of each row
                                        
                                        while($row = $driver->fetch_assoc()) {
                                            echo "<img src= '" . $row["staffPicture"] . "' height='100px' width='100px' class='img-circle'>
                                            <br>
                                            name: ".$row["staffName"]."<br>
                                            No.: ". $row["staffNumber"]."<br>
                                            Email: ". $row['staffemail'];

                                            $temail = $row['staffemail'];
                                            $tphone = $row['staffNumber'];
                                        }
                                    } else {
                                        echo "No Teacher Details";
                                    }
                ?>
            </td></tr>
            </table>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='POST'>
					<input type='text' name='temail' hidden="true"<?php echo "value='$temail'"; ?>>
					<input type='text' name='tphone' hidden="true"<?php echo "value='$tphone'"; ?>>
					<input type='text' name='demail' hidden="true"<?php echo "value='$demail'"; ?>>
					<input type='text' name='dphone' hidden="true"<?php echo "value='$dphone'"; ?>>
					<textarea class="input" placeholder="Enter message Here" name="sendtext" required="true"></textarea>
					<br><br>
					Who To Contact:
					<select class="input" name="contact" style="color: black;">
						<option value="D">Driver</option>
						<option value="T">Teacher</option>
				  		<option value="S">School</option>
					</select>
					<br><br>
					Type Of Message: 
					<select class="input" name="type" style="color: black;">
						<option value="E">Email</option>
						<option value="S">SMS</option>
				  		<option value="W">Whatsapp</option>
					</select>
					<br><br>
					<input type="submit" name="submit" class="inputbtn" value="Send Message">
				</form>
				
				<?php echo "<p style='color: green'>".$message."</p>"; ?>
					<?php echo "<p style='color: red'>".$error."</p>"; ?>




</div>
<?php include 'footer.php'; ?>
</body>
   
</html>