<?php include('session.php'); 
	if (!($_SESSION['is_admin']==1)) {
		header("location:login-admin.php");
	}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $staffID =$_POST["staffID"];
	$staffName = $_POST["staffName"];
	$staffNumber = $_POST["staffNumber"];
	$staffEmail = $_POST["staffEmail"];
	$password = $_POST["password"];
	$stafftype = $_POST["stafftype"];
	$permitNumber = $_POST["permitNumber"];
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];

	$sql = "UPDATE `MemberOfStaff` SET 	`staffName`= '$staffName',
										`staffNumber`='$staffNumber',
										`staffEmail` = '$staffEmail',
										`password` = '$password' 
								where 	`staffID` ='$staffID';";


		if ($db->query($sql) == TRUE) {

	 	if ($stafftype =='D'){

	 		$permitNumber = $_POST["permitNumber"];
	 		$sql2 = "UPDATE driver SET 	permitNo = $permitNumber
	 								where staffID='$staffID'";

	 		if ($db->query($sql2) == TRUE) {
	 			$Message= "Driver Details updated Successfully";
	 			$picshow=1;
	 		}else{
	 		$Message= "Member of Staff Added Successfully, but";
	 		$error = "Error adding extra details: <br>" . $db->error;
	 		}

	 	} else if ($stafftype='T'){

	 		$startDate = $_POST["startDate"];
	 		$endDate = $_POST["endDate"];
	 		$sql3 = "UPDATE teacher set dutyStartDate = '$startDate',
								 		dutyEndDate = '$endDate'
								 		where staffID='$staffID'";

	 		if ($db->query($sql3) == TRUE) {
	 		 $Message= "New Teacher Added Successfully";
	 		 $picshow=1;
	 		}else{
	 		$Message= "Member of Staff Added Successfully, but";
	 		$error = "Error adding extra details: <br>" . $db->error;
	 		}
	 	}


	 	//store the ID for use in carrying out other tasks.
	    $_SESSION['editStaffID'] = $staffID;
	} else {
	    $error = "Error: <br>" . $db->error;
	}

 
}
?>
<script type="text/javascript">
	function showmore() {
		var e = document.getElementById("stafftype").value;
		
		if (e == "T") {
			document.getElementById("startDate").style.display = 'block';
			document.getElementById("endDate").style.display='block';
			document.getElementById("permitNumber").style.display='none';
		} else if (e == "D"){
			document.getElementById("startDate").style.display = 'none';
			document.getElementById("endDate").style.display='none';
			document.getElementById("permitNumber").style.display='block';
		}
		else {
		 	window.alert("Error! Please reload Page");
		}
		
	}
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

<html>
   
   <head>
   		<?php echo $_SESSION['theme']; ?>
        <link rel="stylesheet" href="css/styles.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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

					<li class="active"><a href="editdetails.php"><span class="glyphicon glyphicon-user"></span> Edit Details</a></li>
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
				</ul>
			</div>
		</div>
	</nav>
  
	<div style="height: 85%">
		<br>
		<h3 align="center" >
			<img src="images/new/yellow_bus-512.png" height="50px">
			<br> School Shuttle Services<br> Management System
		</h3>
		<div align="center" id="div1">
			<h2>Edit Employee Details</h2> <div id="demo"></div>
			<?php 
				$sql2 = "SELECT `staffID`, `staffName`, `staffNumber`, `staffEmail`, `shuttleNo` FROM MemberOfStaff WHERE `staffEmail` ='".$_SESSION['login_user']."';";
				$driver = $db->query($sql2);
	              
                if ($driver->num_rows > 0) {
                    // output data of each row
                    
                    while($row = $driver->fetch_assoc()) {
                      
                      $staffID=$row['staffID'];
                      $staffName=$row['staffName'];
                      $staffNumber=$row['staffNumber'];
                      $staffEmail=$row['staffEmail'];
                      $shuttleNo=$row['shuttleNo'];

                    }
                } else {
                    echo "No Details ". $_SESSION['login_user'];
                }
		            
		   
			 ?>
			<form name="regform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<table>
				<tr><td>
					staffID:
				  <input type="number" placeholder="staffID" name="staffID" class="input" disabled="true" <?php echo "value='$staffID'" ;?>/> <br><br>
				  Full Name:
				  <input type="text" placeholder="Full Name" name="staffName" required="true"class="input" <?php echo "value='$staffName'" ;?>/><br><br>
				  Enter Email:
				  <input type ="email" placeholder="Enter Email" name="staffEmail" required="true"class="input"<?php echo "value='$staffEmail'" ;?>/><br><br>
				  password:
				  <input type="password" placeholder="password" name="password" required="true" class="input"/><br><br>
				  Shuttleno:
					<select id="shuttleNo" name="shuttleNo" placeholder="Shuttle Number" class="input" style="color: black;" <?php echo "value='$shuttleNo'" ;?>>
						<option>-Select Shuttle-</option>
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
					</select><br><br>
			  	</td><td>
			  		Phone Number:<br>
				  <input type="number" placeholder="256#########" id="no" name="staffNumber" required="true" class="input" onchange="validateNo()" /><br>
					<span style='color: red;' id="telerror"></span>
					<br>
				  <select class="input" style="color: rgb(0,0,0);" required="true" name="stafftype" id="stafftype" onchange="showmore()">
				  		<option value="T">Teacher</option>
				  		<option value="D">Driver</option>
				  </select> <br><br>
				  <span id="permit" style="display:none;" >Permit No.:</span>
				  <input type ="text" id="permitNumber" name="permitNumber" placeholder="permit Number" class="inputthin" style="display:none;" <?php echo "value=".$permitNumber ;?>/><br>
				 <span id="sd">Start Date:<input type ="date" name="startDate" id="startDate" class="inputthin" style="display:block;"<?php echo "value=".$startDate ;?>/></span>
				  <span id="endd">End Date:</span>
				  <input type ="date" name="endDate" id="endDate" class="inputthin" style="display:block;"<?php echo "value=".$endDate ;?>/><br>
			  	</td></tr>
			  	<tr><td colspan="2" align="center">
			  	<input type="submit" class="inputbtn" />
					<?php echo "<p style='color: green'>".$Message."</p>"; ?>
					<?php echo "<p style='color: red'>".$error."</p>"; ?>

					<?php if(isset($picshow)){ echo "<a id='pic' href='pic.php' style=>upload profile picture for $staffName </a>";} ?>
				</td></tr>
			</table>
			</form>
			
			 
		</div>

	</div>
	 <?php include 'footer.php'; ?>
  </body>
</html>