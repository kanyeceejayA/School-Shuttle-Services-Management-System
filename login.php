<?php
   include 'dbconnect.php';

   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // email and password sent from form 
      
      $myemail = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT guardianid FROM Guardian WHERE email = '$myemail' and password = password('$mypassword')";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      

      // If result matched $myemail and $mypassword, table row must be 1 row
        
      if($count == 1) {
         
        $_SESSION['login_user'] = $myemail;
        header("location: index.php");

      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
   
   <head>
      <title>School Shuttle Services Management System- Login Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.5/darkly/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

            <style type="text/css">
                    body{
                        background-image: url("images/new/bus-hd.png");
                        background-size: 100%;
                        background-position: center;
                        background-repeat: no-repeat;
                        background-color: lightblue;
                    }
            </style>
   </head>
   
    <body>
       
    <div style="background-color: rgba(0,0,0,0.7); height:100%">

        <br><h3 align="center" ><img src="images/new/yellow_bus-512.png" height="50px"><br> School Shuttle Services<br> Management System</h3>

        <div align = "center" style="vertical-align: center; padding-top: 50px;">

         <div style = "width:40%; max-width:400px; min-width:300px; border: solid 1px #333333; background: rgba(0,0,0,0.6);" align = "center">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Guardian Login</b></div>
            
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px; font-size: 10px" align="right">
                <a href="login-admin.php">Switch to Admin Login</a>
            </div>    
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                    <input type = "text" name = "email" class="input" placeholder="email" /><br><br>
                    <input type = "password" name = "password" class = "input" placeholder="password" /><br><br>
                    <input type = "submit" value = " Submit " class="inputbtn"/><br>
                        
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
                    
            </div>
                
         </div>
      </div>
      <div style="height: 3%; position:fixed; bottom:0px; background-color:rgba(0,0,0,0.7); width: 100%; font-size: 10px" align="center">
       Copyright, Kanyesigye, Humphrey, Henry, & James </div>
    </div>
    </body>
</html>