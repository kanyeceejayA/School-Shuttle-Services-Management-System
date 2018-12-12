<?php
   include('session.php');
?>
<html>
   <head>
   		<?php echo $_SESSION['theme']; ?>
        <link rel="stylesheet" href="css/styles.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		

	  <title>View Shuttle Staff- School Shuttle Services Management System</title>
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
					<li class='active'><a href='viewstaff.php'><span class='glyphicon glyphicon-record'></span> View Staff</a></li>
					";}?>

					<?php if($_SESSION['is_admin']){ echo " 
					<li class='dropdown active'>
						<a class='dropdown-toggle' data-toggle='dropdown' href='#'><span class='glyphicon glyphicon-record'></span> View Lists
						<span class='caret'></span></a>
						<ul class='dropdown-menu'>
							<li class='active'><a href='viewchildren.php'>View Children</a></li>
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

<div style="height:80%; min-height:1500px; background-color:rgba(0,0,0,0);" align="center">

		<br>
		<h3 align="center" >
            <a href="index.php">
				<img src="images/new/yellow_bus-512.png" height="50px">
            </a>
			<br> School Shuttle Services<br> Management System
		</h3>
			
			<h4>Children</h4>
				
		    	<table style="width: 80%; max-width: 768px" class="table table-bordered">
		    		<tr><th>ID</th><th>Name</th><th>Date Of Birth</th><th>Shuttle</th></tr>
		    		<?php
			                $sql2 = "SELECT `childID`, `childName`, `dateOfBirth`, `shuttleNo` FROM Child;";
			                $driver = $db->query($sql2);
			              
			                if ($driver->num_rows > 0) {
			                    // output data of each row
			                    
			                    while($row = $driver->fetch_assoc()) {
			                        echo 
			                        "<tr><td>
			                        ".$row["childID"]."
			                        </td><td>
			                        ". $row["childName"]."
			                        </td><td>
			                        ".$row["dateOfBirth"]."
			                        </td><td>
			                        ".$row['shuttleNo']."
			                        </td></tr>";
			                    }
			                } else {
			                    echo "No Student Details";
			                }
			            
			    	?>
		    	</table>

		    	<h4 align="center">Guardians</h4>
		    	<table style="width: 80%; max-width: 768px" class="table table-bordered">
		    		<tr><th>ID</th><th>Name</th><th>Phone Number</th><th>Email</th><th>Child Name</th></tr>
		    		<?php
			            function getTeacherDetails($db){
			                $sql = "SELECT `guardianID`, `guardianName`, `phoneNumber`, `email`, `password`, `childName` FROM Guardian join Child on Child.childID = Guardian.childID;";
			                $driver = $db->query($sql);
			              
			                if ($driver->num_rows > 0) {
			                    // output data of each row
			                    
			                    while($row = $driver->fetch_assoc()) {
			                        echo 
			                        "<tr><td>
			                        ".$row["guardianID"]."
			                        </td><td>
			                        ".$row["guardianName"]."
			                        </td><td>
			                        ".$row["phoneNumber"]."
			                        </td><td>
			                        ". $row["email"]."
			                        </td><td>
			                        ".$row['childName']."
			                        </td></tr>";
			                    }
			                } else {
			                    echo "No Guardian Details";
			                }
			            }

			            getTeacherDetails($db);
			    	?>
		    	</table>
		

    	<a href = "./">List of pages</a><br>
    	<a href = "logout.php">Sign Out</a>

</div>
<?php include 'footer.php'; ?>
</body>
   
</html>