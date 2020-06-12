<?php
// for database connnection
include("config.php");

// make sure the ID passed is an integer, otherwise go back to welcome page.
if(is_numeric($_GET['pid'])){
    $patientID = intval($_GET['pid']);
} else {
    header("location:welcome.php");
    exit();
}

// function to query the database
function query($query) {
    global $db;
    $result = mysqli_query($db, $query);
    if (!$result) {
        return -1;
    }
    return $result; 
}

// query to delete all patients with the passed ID value
$query = "DELETE FROM patients WHERE pid=$patientID;";

query($query);

//return to welcome page after deletion
header("Location: welcome.php");
exit();

?>