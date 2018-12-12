<?php include 'session.php';?>
<!DOCTYPE html>
<html>
<head>
   		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.5/darkly/bootstrap.min.css">
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


		<br>
		<h3 align="center" >
			<img src="images/new/yellow_bus-512.png" height="50px">
			<br> School Shuttle Services<br> Management System
		</h3>
		<div align="center">
			<?php
			$editStaffID = $_POST['StaffID'];
			$target_dir = "pics/";
			$imageFileType = pathinfo($_FILES["staffimage"]["tmp_name"],PATHINFO_EXTENSION);
			$target_file = $target_dir .$editStaffID. $imageFileType;
			$uploadOk = 1;
			
			// Check file size
			if ($_FILES["staffimage"]["size"] > 500000) {
			    echo "Sorry, your file is too large.\n";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.\n";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["staffimage"]["tmp_name"], $target_file)) {
			        echo "The picture ". basename( $_FILES["staffimage"]["name"]). " has been uploaded.\n";

			        $sql = "UPDATE memberofstaff SET staffPicture='$target_file' WHERE staffid='$editStaffID';";
					if (mysqli_query($db, $sql)) {
					    echo "profile Picture updated successfully\n;";
					} else {
					    echo "Error updating picture: " . mysqli_error($conn);
					}
				} else {
			    echo "Sorry, there was an error uploading your file.";
				}
			}
			?>
		</div>
		<div align="center">
			<img src="<?php echo $target_file ?>" height="300px" width="300px" style="border-radius:10px"><br><br>
			<a href="pic.php">Upload Different Picture</a>
		</div>
		<?php include 'footer.php'; ?>
</body>
</html>