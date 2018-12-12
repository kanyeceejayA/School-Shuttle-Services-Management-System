<?php
   include('session.php');
?>
<html">
   <head>
   		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.5/darkly/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">

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
    <header class="header">
        <div class="row">
            <div class="col-sm-2" id="toplogo">
                <a href="index.php"><img id="halimage" src="images/new/yellow_bus-512.png"><br>Home</a>
            </div>
            <div class="col-sm-2"><img id="halimage" src="images/new/map-line.png" height="512px"><br>Display Map</div>
            <div class="col-sm-2">Contact</div>
            <div class="col-sm-2"><img src="images/new/shuttle_bus_stop.png" height="100%"><br>View Staff</div>
            <div class="col-sm-2">View </div>
            <div class="col-sm-2">Display Map</div>
        </div>
    </header>
<div style="height:80%; min-height:800px; background-color:rgba(0,0,0,0);" align="center">

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

    			<td id='d2'class="tab"><a href="sendmessage.php" ><img src="images/new/shuttle_bus_stop.png" height="100%"><br> Contact shuttle Driver</a></td>
    					
    		</tr>
    		<tr>
                <td id="d6"class="tab" ><a href="viewstaff.php"><img src="images/new/shuttle_bus_stop.png" height="100%"><br> View Staff</a></td>

    			<td id='d2'class="tab"><a href="editdetails.php" ><img src="images/new/shuttle_bus_stop.png" height="100%"><br> Edit Details</a></td> 
    		</tr>
    		<?php //if($_SESSION['is_admin']){ echo " 
    		?>
    		<tr>	
    			<td id='d7'class='tab'><a href='displaymap-admin.php'><img src='images/new/map-line.png' height='80%'><br>Display Map (Admin)</a></td>
    			<td id='d3'class='tab'><a href='registerchild.php'><img src='images/new/shuttle_bus_stop.png' height='100%' ><br> Register Child</a></td>
    		</tr><tr>
    			<td id='d4'class='tab'><a href='registeradmins.php'><img src='images/new/shuttle_bus_stop.png' height='100%'><br> Register Staff</a></td>
    		</tr>
    		<!-- "; }?> -->
    	</table>
    	<a href = "./">List of pages</a><br>
    	<a href = "logout.php">Sign Out</a>

</div>
<?php include 'footer.php'; ?>
</body>
   
</html>