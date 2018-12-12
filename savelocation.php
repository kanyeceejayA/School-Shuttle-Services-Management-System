<!DOCTYPE html>
<?php include('session.php');
	if (!($_SESSION['is_admin']==1)) {
		header("location:login-admin.php");
	}
    $childID =$_SESSION['editchildID'];
    $childName =$_SESSION['editchildName'];
 ?>
 <?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$childsID =$_POST["childID"];
	$childName = $_POST["childName"];
	$latitude = round($_POST["lat"],7);
	$longitude = round($_POST["lng"],7);

	if (isset($_POST["lat"]) && isset($_POST["lng"])) {

	$sql = "UPDATE `Child` SET latitude= '$latitude' , longitude='$longitude' where childID= '$childsID';";

		if ($db->query($sql) == TRUE) {

	 		$message = "New Home Location Successfully Saved". $childsID;
		} else {
		    $error = "Error adding Child: <br>" . $db->error;
		}
	} else {
		 $error = "Please select Location: <br>".$latitude.$longitude;
	}

}

?>
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
					<li class='dropdown active'>
						<a class='dropdown-toggle' data-toggle='dropdown' href='#'><span class='glyphicon glyphicon-pencil'></span> Register
						<span class='caret'></span></a>
						<ul class='dropdown-menu'>
							<li><a href='registerchild.php'>Register Child</a></li>
							<li  class='active'><a href='savelocation.php'>Add Home Location</a></li>
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

<br>
		<h3 align="center" >
			<img src="images/new/yellow_bus-512.png" height="50px">
			<br> School Shuttle Services<br> Management System
		</h3>
		<div align="center">
			<form action="" method="POST">
				child: &nbsp
				<select id="childID" name="childID"class="input" style="color: black;">
						<option>-Select Child-</option>
						<?php 
							$sql='select childID, childName from Child;';
							$results = $db->query($sql); 

							if($results->num_rows > 0 ){
								while($row = $results->fetch_assoc()) {
									if ($childID == $row["childID"]) {
										echo '<option value="'.$row["childID"].'" selected="true">'.$row["childName"].'</option>';	
									}
									else{
										echo '<option value="'.$row["childID"].'">'.$row["childName"].'</option>';
									}
								}
							}
							else{
								$error = 'No children Registered';
							}
						?>
					</select><br>
				<!-- lat: -->
				<input type="text" id="lat" name="lat"  hidden="true" >
				<!-- &nbsp long: -->
				<input type="text" id="lng" name="lng" hidden="true" >
				<h4>Please Select Child's Home On The Map Below</h4>
				<input type="submit" name="save Location" class="inputbtn">
			</form>
				<?php echo "<p style='color: green'>$message</p>";?>
				<?php echo "<p style='color: red'>$error</p>";?>
		</div>
	<div class="container-fluid" align="center" style="height:500px;">
		<div id="map" style="width:100%;height: 100%;" > </div>
	</div>
	<br><br>
	<div style="width: 100%;height: 3%;bottom: 0px;position: absolute;">
		
	</div>

<script>
function myMap() {
  var myCenter = new google.maps.LatLng(<?php echo $schoollat.",".$schoollng ?>);
  var mapCanvas = document.getElementById("map");
  var mapOptions = {center: myCenter, zoom: 15};
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({
    position: myCenter,
    map: map,
    draggable:true,
    title:"Drag To Pick Up Location"
  });
	marker.setMap(map);

  document.getElementById('lat').value= 51.508742;
    document.getElementById('lng').value= -0.120850 ; 

    // marker drag event
    google.maps.event.addListener(marker,'drag',function(event) {
        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('lng').value = event.latLng.lng();
    });

//     //marker drag event end
    google.maps.event.addListener(marker,'dragend',function(event) {
        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('lng').value = event.latLng.lng();
});
}


</script>


<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=myMap"></script>



</body>
</html>
