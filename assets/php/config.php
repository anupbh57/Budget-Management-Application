<?php
require 'db.php';
    session_start();

if(mysqli_connect_error()) {
    echo "Connection To The Database Failed";
  } 

  $sql = "SELECT id, setting_option FROM settings";
  $result = $connection_db->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) { 
        switch($row['id']) {
          case 1:
            $iappname = $row['setting_option'];
          break;
          case 2:
            $iusername = $row['setting_option'];
          break;
          case 3:
            $itagline = $row['setting_option'];
          break;
          case 4:
            $icountry = $row['setting_option'];
          break;
          case 5:
            $icurrency = $row['setting_option'];
          break;
        }      }
    } 
    if(mysqli_connect_error()) {
      echo "Connection To The Database Failed";
    } 
    else {
      if (mysqli_query($connection_db, $sql)) {
    } 
    else {
      echo "There appears to be an error with the database. Please refer to the error below:";
      echo "Error: " . $sql . "<br>" . mysqli_error($connection_db);
    }
    }


    $sql = "SELECT  username, email FROM user WHERE id = 1";
    $result = $connection_db->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) { 
      
        $dbausername = $row['username'];
        $dbaemail = $row['email'];
      }
    } 
    if(mysqli_connect_error()) {
      echo "Connection To The Database Failed";
    } 
    else {
      if (mysqli_query($connection_db, $sql)) {
    } 
    else {
      echo "There appears to be an error with the database. Please refer to the error below:";
      echo "Error: " . $sql . "<br>" . mysqli_error($connection_db);
    }
}
    $connection_db->close();

?>