<?php
require 'db.php';
$date = $_POST['fe-date'];
$title = $_POST['fe-title'];
$amount = $_POST['fe-amount'];
$description = $_POST['fe-description'];
$category = $_POST['selected'];
$rowId = $_POST['rowid'];


if(isset($_POST['e-switch']) && 
   $_POST['e-switch'] == 'expense') 
{
    $recordtype = 1;
}
else
{
    $recordtype = 0;
}	 

echo $date, $title, $amount, $description, $category, $rowId ;


if(mysqli_connect_error()) {
    echo "Connection To The Database Failed";
} 
else {
    $sql = "UPDATE records SET `date` = '$date', title = '$title', amount = '$amount', description = '$description', category = '$category', `type` = '$recordtype' WHERE id = '$rowId'";

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
