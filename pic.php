<?php include 'session.php'; ?>

<!DOCTYPE html>
<html>
<head>
   		<?php echo $_SESSION['theme']; ?>
        <link rel="stylesheet" href="css/styles.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	  <title>School Shuttle Services Management System- Registration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body >
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
                            <li><a href='registerchild.php'>Register Child</a></li>
                            <li><a href='savelocation.php'>Add Home Location</a></li>
                            <li><a href='registeradmins.php'>Register Staff</a></li>
                            <li class='active'><a href='pic.php'>Add Profile Picture</a></li> 
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


<div style="height:85%;"> 
	<br>
		<h3 align="center" >
			<img src="images/new/yellow_bus-512.png" height="50px">
			<br> School Shuttle Services<br> Management System
		</h3>

	<div align="center" style="padding-top:15%">
		
		<form action="upload.php" method="post" enctype="multipart/form-data">

		    Select Display Picture for:
            <select id="StaffID" name="StaffID"class="input" style="color: black;">
                <option>-Select Staff Member-</option>
                <?php 
                    $sql='select staffID, staffName from MemberOfStaff;';
                    $results = $db->query($sql); 

                    if($results->num_rows > 0 ){
                        while($row = $results->fetch_assoc()) {
                            if ($_SESSION['editStaffID'] == $row["staffID"]) {
                                echo '<option value="'.$row["staffID"].'" selected="true">'.$row["staffName"].'</option>';  
                            }
                            else{
                                echo '<option value="'.$row["staffID"].'">'.$row["staffName"].'</option>';
                            }
                        }
                    }
                    else{
                        $error = 'No Staff Registered';
                    }
                ?>
            </select>

		    <input type="file" accept="image/*" name="staffimage" id="staffimage" width="200px" > <br>
		    <input type="submit" value="Upload Image" name="submit" class="inputbtn" >
		</form>
	</div>
</div>
</body>
</html>