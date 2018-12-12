<?php
   include('session.php');
?>
<html>
   <head>
   		<?php echo $_SESSION['theme']; ?>
        <link rel="stylesheet" href="css/styles.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	  <title>Home- School Shuttle Services Management System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style type="text/css">
	body{
		}
        .header {
            background-color: rgba(0,0,0,1);
            height: 10%;
        }
        .tab{
        	color: white;
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
					<li class="active"><a href="index.php"><span class='glyphicon glyphicon-home'></span> Home</a></li>

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

					<li><a href="editdetails.php"><span class="glyphicon glyphicon-user"></span> Edit Details</a></li>
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
				</ul>
			</div>
		</div>
	</nav>


<div style="height:85%; min-height:800px; background-color:rgba(0,0,0,0);" align="center">

		<br>
		<h3 align="center" >
            <a href="index.php">
				<img src="images/new/yellow_bus-512.png" height="50px">
            </a>
			<br> School Shuttle Services<br> Management System
		</h3>
    	<h3>Welcome To The School Shuttle Services System, <?php echo $login_session; ?></h3>

    	<table style="border-spacing: 10px 10px;border-collapse: separate; width: 80%; max-width:800px;">
    		<tr>
    			<th colspan="4" align="center">Modules</th>
    		</tr>
    		<tr>
    			<td class="tab blue" id="d1"><a href="displaymap.php"><img src="images/new/map-line.png" height="80%"><br> View Map</a></td>

    			<td id='d2'class="tab"><a href="sendmessage.php" ><img src="images/new/phone.png" height="80%"><br> Contact Us</a></td>
    					
    		</tr>
    		<tr>
                <td id="d6"class="tab" ><a href="viewstaff.php" style="color: white;"><h1><span class="glyphicon glyphicon-record"></span></h1> View Staff</a></td>

    			<td id='d2'class="tab"><a href="editdetails.php" style="color: white;"><h1><span class="glyphicon glyphicon-user"></span></h1>Edit Details</a></td> 
    		</tr>
    		<?php if($_SESSION['is_admin']){ echo " 
    		
    		<tr>	
    			<td id='d7'class='tab'><a href='viewstaff.php' style='color: white;'><h1><span class='glyphicon glyphicon-record'></span></h1> View Children</a></td></a></td>
    			<td id='d3'class='tab'><a href='registerchild.php'><img src='images/new/shuttle_bus_stop.png' height='100%' ><br> Register Child</a></td>
    		</tr><tr>
    			<td id='d4'class='tab'><a href='registeradmins.php'><img src='images/new/shuttle_bus_stop.png' height='100%'><br> Register Staff</a></td>
    			<td id='d2'class='tab'><a href='sendguardianmessage.php' ><img src='images/new/phone.png' height='80%'><br> Contact Guardians</a></td>
    		</tr>
    		"; }?>
    	</table>
    	<br>
    	<a href = "logout.php">Sign Out</a>

</div>
<?php include 'footer.php'; ?>
</body>
   
</html>