<?php
require 'db.php';

$rowid = $_POST['delholder'];


if(mysqli_connect_error()) {
    echo "Connection To The Database Failed";
} 
else {
    $sql = "DELETE FROM records WHERE `id` = '$rowid'";

if (mysqli_query($connection_db, $sql)) {
    echo 'done'; 
} 

else {
    echo "There appears to be an error with the database. Please refer to the error below:";
    echo "Error: " . $sql . "<br>" . mysqli_error($connection_db);
}
}
mysqli_close($connection_db);

?>