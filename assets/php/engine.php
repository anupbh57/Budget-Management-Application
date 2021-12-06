<?php 
require 'db.php';

$date = $_POST['d-date'];
$title = $_POST['d-title'];
$amount = $_POST['d-amount'];
$description = $_POST['d-description'];
$category = $_POST['selected'];

if(isset($_POST['d-switch']) && $_POST['d-switch'] == 'expense') 
{
    $recordtype = 1;
}
else
{
    $recordtype = 0;
}	 

if(mysqli_connect_error()) {
    echo "Connection To The Database Failed";
} 
else {
    $sql = "INSERT INTO `records` (`date`, title, amount, `description`, category, `type`)
    VALUES ('$date','$title','$amount','$description','$category', '$recordtype')";

if (mysqli_query($connection_db, $sql)) {
    // echo "done!";

} 
else {
    echo "There appears to be an error with the database. Please refer to the error below:";
    echo "Error: " . $sql . "<br>" . mysqli_error($connection_db);
}
}
mysqli_close($connection_db);

?>
