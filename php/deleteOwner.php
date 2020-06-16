<?php
// for database connnection
include("config.php");

// make sure the ID passed is an integer, otherwise go back to welcome page.
if(is_numeric($_GET['oid'])){
    $ownerID = intval($_GET['oid']);
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

// preparing query to see if owner has pets that are patients
$query = "SELECT * FROM patients WHERE ownerID=$ownerID";
$result = query($query);
$row = mysqli_fetch_assoc($result);
$count = mysqli_num_rows($result);

// if they do, tell user that they have patients
if ($count > 0) {
    $errorMsg = "***Patient(s) are owned by this person! Please edit or delete those patients first.***";
    header("Location:welcome.php?error=$errorMsg");
} else {
    // query to delete all patients with the passed ID value
    $query = "DELETE FROM owners WHERE oid=$ownerID";

    query($query);
    //return to welcome page after deletion
    header("Location: welcome.php?error=");
}
?>