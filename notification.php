<?php
    include 'session.php';

    $latitude       = isset($_GET['latitude']) ? $_GET['latitude'] : '0';
    $longitude      = isset($_GET['longitude']) ? $_GET['longitude'] : '0';
    $shuttleno       = isset($_GET['shuttleno']) ? $_GET['shuttleno'] : 0;

    $params2 = array(':latitude'        => $latitude,
                    ':longitude'       => $longitude,
                    ':shuttleno'       => $shuttleno
                );
    

        $stmt = $pdo->prepare("SELECT   guardianid,
                                        guardianName, 
                                        childname, 
                                        phoneNumber,email,
                                        latitude,
                                        longitude, 
                                        shuttleno,
                                        ( 6371 * acos( cos( radians(:latitude) ) * cos( radians( latitude) ) * cos( radians( longitude ) - radians(:longitude) ) + sin( radians(:latitude) ) * sin( radians( latitude ) ) ) ) as distance
                                        FROM notifyview
                                        having distance<10");

    $stmt->execute($params2);


    foreach ($stmt as $row) {
        $km = round($row['distance'],2);
        $dist = ($km>=1) ? $km." Kilometres" : ($km*1000)." Metres" ;  //change to metres if distance is too short
        $name =explode(' ', $row['guardianName']);

        $txt = "Hey ". $name[0] .", the school shuttle ".$row['shuttleno']." is headed for ".$row['childname']."'s shuttle stop. it's ". $dist ." away";

        if ($km>5){
            $to = $row['email'];
            $subject = "Shuttle Alert! ". $dist ." Away";
            $headers = "From: noreply@kirungi.co.ug" . "\r\n";

            mail($to,$subject, $txt,$headers);

            $mail= "<br><br>".$to."<br>".$subject."<br>".$headers."<br>".$txt."<br><br>";            
            echo $mail;
        } else if($km<1){

            $to = $row['email'];
            $subject = "Shuttle Alert! ". $dist ." Away";
            $headers = "From: noreply@kirungi.co.ug" . "\r\n";

           // mail($to,$subject, $txt,$headers);

            $mail= "<br><br>".$to."<br>".$subject."<br>".$headers."<br>".$txt."<br><br>";            
            echo $mail;

            // Send SMS
            
            $sendtext = rawurlencode($txt);
            $url = 'http://gps.kirungi.co.ug/sms.php?to='.$row['phoneNumber'].'&text='.$sendtext;
            $result = url_get_contents($url);

            echo $result;
        }
    
    }

    



   
   ?>
