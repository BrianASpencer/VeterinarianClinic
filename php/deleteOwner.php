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

// query to delete all owners with the passed ID value
$query = "DELETE FROM owners WHERE oid=$ownerID;";

query($query);

//return to welcome page after deletion
header("Location: welcome.php");
exit();

?>