<?php include('session.php'); ?>
<?php

    $childID =$_SESSION["editchildID"];
	$childName = $_SESSION['editchildName'];

if ($_SERVER["REQUEST_METHOD"] == "POST"){

	$guardianID = $_POST["guardianID"];
	$guardianName = $_POST["guardianName"];
	$phoneNumber = $_POST["phoneNumber"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$showmore = $_POST["showmore"];



	$sql2 = "INSERT INTO `Guardian` (`guardianID`, `guardianName`, `phoneNumber`, `email`, `password`, `childID`) VALUES ('$guardianID', '$guardianName', '$phoneNumber', '$email', '$password', '$childID')";

	if ($db->query($sql2) == TRUE) {
		$message= "New Guardian Added Successfully";
		$showmore= 2;
	}else{
		$error = "Error adding guardian: <br>" . $db->error;
		$readd=1;
	}

}
?>
<html>
   
   <head>
   		<?php echo $_SESSION['theme']; ?>
        <link rel="stylesheet" href="css/styles.css">
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
					<li class='dropdown active' >
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
<!-- End of Nav Menu -->

	<div style="height: 85%">
		<br>
		<h3 align="center" >
			<img src="images/new/yellow_bus-512.png" height="50px">
			<br> School Shuttle Services<br> Management System
		</h3>
		<div align="center" id="div1">

			<form name="regform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<table style="border-spacing: 10px 10px; text-align: center;" align="center">
				<tr><th>Child</th><th style="width:5%"></th><th>Guardian</th></tr>
				<tr><td align="left">
					<?php echo "<h2>ChildId: ".$childID."<br> Name:". $childName;?>
				</td><td>&nbsp</td><td>
					<input type="number" placeholder="guardianID" name="guardianID" class="input"/> <br><br>

					<input type="text" placeholder="Full Name" name="guardianName" required="true"class="input" /><br><br>

					<input type="number" placeholder="Phone Number" name="phoneNumber" required="true" class="input"/><br><br>

					<input type ="email" placeholder="Enter Email" name="email" required="true"class="input"/><br><br>

					<input type="password" placeholder="password" name="password" required="true" class="input"/><br><br>

			    	<?php
			    	if (isset($show)) {
			    		echo "<a href=addguardian.php>Click here to Add another guardian</a>";
			    	}
			    	?>
					</select>
				</td></tr>
				<tr><td colspan="3" align="center">
					<input type="submit" class="inputbtn" /><br><br>
					<p style="color: green"><?php echo $message ?></p>
					<p style="color: red"><?php echo $error ?></p>
					<?php
			    	if (isset($readd)) {
			    		echo "<a href=addguardian.php>Click here to retry adding guardian</a>";
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