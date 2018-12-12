<?php include('session.php');
	if (!($_SESSION['is_admin']==1)) {
		header("location:login-admin.php");
	}
 ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $childID =$_POST["childID"];
	$childName = $_POST["childName"];
	$dateOfBirth = $_POST["dateOfBirth"];
	$shuttleNo = $_POST["shuttleNo"];
	$guardianID = $_POST["guardianID"];
	$guardianName = $_POST["guardianName"];
	$phoneNumber = $_POST["phoneNumber"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$showmore = $_POST["showmore"];


	$sql = "INSERT INTO `Child` (`childID`, `childName`, `dateOfBirth`,  `shuttleNo`) VALUES ('$childID', '$childName', '$dateOfBirth', '$shuttleNo')";


		if ($db->query($sql) == TRUE) {

	 		$sql2 = "INSERT INTO `Guardian` (`guardianID`, `guardianName`, `phoneNumber`, `email`, `password`, `childID`) VALUES ('$guardianID', '$guardianName', '$phoneNumber', '$email', password('$password'), '$childID')";

	 		if ($db->query($sql2) == TRUE) {
	 			$message= "New Child and Guardian Added Successfully";
	 			$showmore= 2;
	 		}else{
	 			$message = "New Child Added Successfully, but";
	 			$error = "Error adding guardian: <br>" . $db->error;
	 			$readd=1;
	 		}



		 	//store the ID for use in adding other guardians.
		    $_SESSION['editchildID'] = $childID;
		    $_SESSION['editchildName'] = $childName;

		} else {
		    $error = "Error adding Child: <br>" . $db->error;
		}

}
?>
<html>
   
   <head>
   		<?php echo $_SESSION['theme']; ?>
        <link rel="stylesheet" href="css/styles.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			function validateNo() {
				var x = document.getElementById('no').value;

				if (x.length < 12 || x.length >12) {
					document.getElementById('telerror').innerHTML='Please check number length';
					return false;
				}else {
					if (!(x.startsWith('256'))) {
						document.getElementById('telerror').innerHTML='please start with country code';
						return false;
					}	
				}

				document.getElementById('telerror').innerHTML="";
				return true;
				
			}
		</script>

	  <title>School Shuttle Services Management System- Registration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
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
					<li><a href='sendmessage.php'><span class='glyphicon glyphicon-phone'></span> Contact Us</a></li>
					";}?>

					<?php if($_SESSION['is_admin']){ echo " 
					<li class='dropdown'>
						<a class='dropdown-toggle' data-toggle='dropdown' href='#'><span class='glyphicon glyphicon-phone'></span> Contact
						<span class='caret'></span></a>
						<ul class='dropdown-menu'>
							<li><a href='sendmessage.php'>Contact Us</a></li>
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
					<li class='dropdown active'>
						<a class='dropdown-toggle' data-toggle='dropdown' href='#'><span class='glyphicon glyphicon-pencil'></span> Register
						<span class='caret'></span></a>
						<ul class='dropdown-menu'>
							<li class='active'><a href='registerchild.php'>Register Child</a></li>
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



	<div style="height: 89%">
		<br>
		<h3 align="center" >
			<img src="images/new/yellow_bus-512.png" height="50px">
			<br> School Shuttle Services<br> Management System
		</h3>
		<div align="center" id="div1">

			<form name="regform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<table style="border-spacing: 10px 10px; text-align: right;" align="center">
				<tr><th>Child</th><th style="width:5%"></th><th>Guardian</th></tr>
				<tr><td>
					ChildID:
					<input type="number" placeholder="childID" name="childID" class="input"/> <br><br>
					Full Name
					<input type="text" placeholder="Full Name" name="childName" required="true"class="input" /><br><br>
					Date of Birth:
					<input type="date" placeholder="Date of Birth" name="dateOfBirth" required="true" class="input"/><br><br>

					Shuttleno:
					<select id="shuttleNo" name="shuttleNo" placeholder="Shuttle Number" class="input" style="color: black;">
						<option selected="true">-Select Shuttle-</option>
						<?php 
							$sql='select shuttleNo from shuttle;';
							$results = $db->query($sql); 

							if($results->num_rows > 0 ){
								while($row = $results->fetch_assoc()) {
									echo '<option value="'.$row["shuttleNo"].'">'.$row["shuttleNo"].'</option>';
								}
							}
							else{
								$error = 'No shuttles Registered';
							}
						?>
					</select>
				</td><td>&nbsp</td><td>
					guardianID:
					<input type="number" placeholder="guardianID" name="guardianID" class="input"/> <br><br>
					Full Name:
					<input type="text" placeholder="Full Name" name="guardianName" required="true"class="input" /><br><br>
					Phone Number:
					<input type="number" placeholder="256#########" id="no" name="phoneNumber" required="true" class="input" onchange="validateNo()" /><br>
					<span style='color: red;' id="telerror"></span>
					<br>
					Enter Email:
					<input type ="email" placeholder="Enter Email" name="email" required="true"class="input"/><br><br>
					password:
					<input type="password" placeholder="password" name="password" required="true" class="input"/><br><br>

			    
				</td></tr>
				<tr><td colspan="3" align="center">
					<?php
			    	if (isset($showmore)) {
			    		echo "<a href='savelocation.php'>Add Home Location</a> <br>
			    			  <a href=addguardian.php>Click here to Add another guardian</a><br>";
			    	}
			    	?>
					<input type="submit" class="inputbtn" /><br><br>
					<p style="color: green"><?php echo $message ?></p>
					<p style="color: red"><?php echo $error ?></p>
					<?php
			    	if (isset($readd)) {
			    		echo "<a href=addguardian.php>Click here to Retry adding guardian</a>";
			    	}
			    	?>
				</td></tr>
			</table>
			</form>
			 
		</div>
	</div>
  </body>
	 <?php include 'footer.php'; ?>
</html>