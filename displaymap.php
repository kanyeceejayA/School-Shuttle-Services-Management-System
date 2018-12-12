<!doctype html>
<html lang="en">
<?php include 'session.php'; ?>

<head>
    <meta charset="UTF-8">
    <title>Gps Tracker</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maps.google.com/maps/api/js?v=3&sensor=false&libraries=adsense,+CA&key=YOUR_API_KEY"></script>
    <script src="js/maps.js"></script>
    <script src="js/leaflet-0.7.5/leaflet.js"></script>
    <script src="js/leaflet-plugins/google.js"></script>
    <script src="js/leaflet-plugins/bing.js"></script>

    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="js/leaflet-0.7.5/leaflet.css">  
    
    <!-- 
        themes gotten from here:  http://www.bootstrapcdn.com/#bootswatch_tab 
    -->    
    <?php echo $_SESSION['theme']; ?>
    <link rel="stylesheet" href="css/styles.css">
            
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

                    <li class="active"><a href="displaymap.php"><span class='glyphicon glyphicon-map-marker'></span> Display Map</a></li>

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


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4" id="toplogo">
                <img id="halimage" src="images/new/yellow_bus-512.png">School Shuttle Tracker
            </div>
            <div class="col-sm-8" id="messages"></div>
        </div>
        <div class="row">
            <div class="col-sm-12" id="mapdiv">
                <div id="map-canvas"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" id="selectdiv">
                <select id="routeSelect" tabindex="1"> </select>
            </div>
        </div>
        <div class="row" align="center">

            <div class="col-sm-3 deletediv">
                <?php if($_SESSION['is_admin']==1){
                        echo  '<input type="button" id="delete" value="Delete" tabindex="2" class="btn btn-primary">';
                    }
                ?>
            </div>
            <div class="col-sm-3 autorefreshdiv">
                <input type="button" id="autorefresh" value="Auto Refresh Off" tabindex="3" class="btn btn-primary">
            </div>
            <div class="col-sm-3 refreshdiv">
                <input type="button" id="refresh" value="Refresh" tabindex="4" class="btn btn-primary">
            </div>
            <div class="col-sm-3 viewalldiv">
                <?php if($_SESSION['is_admin']==1){
                        echo  '<input type="button" id="viewall" value="View All" tabindex="5" class="btn btn-primary">';
                    }
                ?>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-4">
                <table style="width:100%">
                    <tr>
                        <td>
                                                      
                            <?php
                                function getDriverDetails($db){
                                    $sql = "SELECT staffName, staffNumber, staffPicture FROM drivershuttle where shuttleNo =  '".$GLOBALS['user_shuttle']."';";
                                    $driver = $db->query($sql);
                                  
                                    if ($driver->num_rows > 0) {
                                        // output data of each row
                                        
                                    	$row = $driver->fetch_assoc();
                                            echo "<img src='".$row["staffPicture"]."' height='100px' width='100px' class='img-thumbnail'>
                                            </td>
                                            <td>
                                            <strong>Driver</strong><br>
                                            name: ".$row["staffName"]."<br>
                                            No.: ". $row["staffNumber"]."<br>";
                                    
                                    }
                                }

                                getDriverDetails($db);
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-4">
                <table style="width:100%">
                    <tr>
                        <td>
                                                      
                            <?php
                                function getTeacherDetails($db){
                                    $sql = "SELECT staffName, staffNumber, staffPicture, staffemail FROM teachershuttle where shuttleNo =  '".$GLOBALS['user_shuttle']."';";
                                    $driver = $db->query($sql);
                                  
                                    if ($driver->num_rows > 0) {
                                        // output data of each row
                                        
                                        while($row = $driver->fetch_assoc()) {
                                            echo "<img src= '" . $row["staffPicture"] . "' height='100px' width='100px'>
                                            </td>
                                            <td>
                                            <strong>Teacher</strong><br>
                                            name: ".$row["staffName"]."<br>
                                            No.: ". $row["staffNumber"]."<br>
                                            Email:". $row['staffemail'];
                                        }
                                    } else {
                                        echo "No Teacher Details";
                                    }
                                }

                                getTeacherDetails($db);
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-4">
                <table style="width:100%">
                    <tr>
                        <td>
                                                      
                            <?php
                                    //get lat and Long
                                    $sql1 = "SELECT latitude, longitude FROM notifyview where email =  '".$_SESSION['login_user']."';";
                                    $driver = $db->query($sql1);

                                    if ($driver->num_rows > 0) {
                                        while($row = $driver->fetch_assoc()) {
                                            $lat = $row['latitude'];
                                            $long = $row['longitude'];
                                        }
                                    }else{
                                        $lat=0;
                                        $long=0;
                                    };

                                    if ($_SESSION['is_admin']) {
                                        $sql= "SELECT shuttleno,speed, max(gpsTime) from gpslocations WHERE shuttleno='".$GLOBALS['user_shuttle']."' GROUP by shuttleno, speed;";
                                    }else{
                                        $sql = "SELECT shuttleno,
                                                     speed, 
                                                    ( 6371 * acos( cos( radians($lat) ) * cos( radians( latitude) ) * cos( radians( longitude ) - radians($long) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) as distance
                                         from gpslocations WHERE shuttleno='".$GLOBALS['user_shuttle']."' and lastUpdate = (SELECT max(lastUpdate) from gpslocations WHERE shuttleno='".$GLOBALS['user_shuttle']."');";
                                    }
                                    $driver = $db->query($sql);
                                  
                                    if ($driver->num_rows > 0) {
                                        // output data of each row
                                        
                                        while($row = $driver->fetch_assoc()) {
                                            echo "<img src='images/new/yellow_bus-512.png' height='100px' width='100px' >
                                            </td>
                                            <td>
                                            <strong>Shuttle Details</strong><br>
                                            Shuttle Reg. No: ".$GLOBALS['user_shuttle']."<br>
                                            Shuttle Speed: ".$row["speed"]."<br>";
                                            if (!($_SESSION['is_admin'])) {
                                            echo   "Shuttle Distance: ".round($row["distance"],2)." km<br>";
                                            }
                                        }
                                    } else {
                                        echo "No further Details";
                                    }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
        
        </div>
    </div>
    <?php include 'footer.php'; ?>      
</body>
</html>
    