
<?php
include 'session.php';
 function findName($x,$db){
 	$sql = "SELECT childName FROM Child where childID = '$x';";
			$result = $db->query($sql);

			if ($result->num_rows > 0) {
			    $row = $result->fetch_assoc();
			        echo $row['childName'];
			} else {
			    echo 'No One by that name. '.$x;
			}
 }

 ?>