<?php
// for database connnection
include("config.php");

$error = "";

// lookign at POST form to see if add button was pressed
// if so, query database to add new patient
function gatherFields() {
    $indexArr = array('ownerID', 'fName', 'species', 'color', 'dOB');
    $helperArr = array($_POST['ownerID'], $_POST['name'], $_POST['species'], $_POST['color'], $_POST['birth']);
    $result = array();
    for($i = 0; $i < count($helperArr); $i+= 1) {
        array_push($result, $helperArr[$i]);
    }
    $result[0] = intval($result[0]);
    return $result;
}

function validateDate($date) {
    if (!strtotime($date)) {
        return false;
    }
    list($year, $month, $day) = explode('-', $date);
    return checkdate($month, $day, $year);
}

function doesOwnerExist($ownerID) {
    global $db;
    $sql = 'SELECT * FROM owners WHERE oid = (?)';
    if (!mysqli_prepare($db, $sql)) {
        echo "SQL error";
    } else {
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "s", $ownerID);
        mysqli_stmt_execute($stmt);
    }
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    return ($count > 0);
}

// lookign at POST form to see if submit button was pressed
// if so, query database to add patient
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['add'])){
        $editedFields = gatherFields();
        $newOwnerID = $editedFields[0];
        $exists = doesOwnerExist($newOwnerID);
        $date = validateDate($editedFields[4]);
        if ($exists and $date) {
            // array of information provided in form
            $query = 'INSERT INTO patients(ownerID, fName, species, color, dOB) VALUES(?, ?, ?, ?, ?)';
            if (!mysqli_prepare($db, $query)) {
                echo "SQL error";
            } else {
                $stmt = mysqli_prepare($db, $query);
                mysqli_stmt_bind_param($stmt, "issss", $editedFields[0], $editedFields[1], $editedFields[2], $editedFields[3],
                                      $editedFields[4]);
                mysqli_stmt_execute($stmt);
            }
            $result = mysqli_stmt_get_result($stmt);
            header("location:welcome.php?error=");
            exit();
        } else {
            if (!$exists) {
                $error = 'Owner does not exist.';
            }
            if (!$date) {
                $error = $error.' Date is invalid. Please use YYYY-MM-DD.';
            }
        }
    }
}

?>

<html>

    <head>
        <title>Add Patient</title>
        <link rel="shortcut icon" href="../images/parkway-veterinary-hospital-dublin-veterinarian-png-vet-400_387.png">
        <link rel="stylesheet" href="../css/design.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </head>

    <body class="p-3 mb-2 bg-primary text-white">

        <h1 class="display-1">Clinic Manager</h1>
        <img src="../images/hospital-512.png" width="128" height="128" class="img-fluid rounded mx-auto d-block">
        <br><br>

        <div align = "center">
            <h4>Fill in all fields and click Add Patient when done.</h4>
            <div style = "width:50%; border: solid 2px #333333; border-radius: 5px; border-color: white; " align = "left">

                <div style = "margin:30px">

                    <form action = "" method = post>
                        <input type="text" class="form-control" placeholder="Owner's ID" name="ownerID">
                        <br>
                        <input type="text" class="form-control" placeholder="Name" name="name">
                        <br>
                        <input type="text" class="form-control" placeholder="Species" name="species">
                        <br>
                        <input type="text" class="form-control" placeholder="Color" name="color">
                        <br>
                        <input type="text" class="form-control" placeholder="Date Of Birth YYYY-MM-DD" name="birth">
                        <br>
                        <div style = "font-size:11px; color: white;"><?php echo $error; ?></div>
                        <button type="submit" name="add" class="btn btn-secondary btn-lg btn-block">Add Patient</button>
                    </form>

                </div>

            </div>

        </div>
        
        <br>
        <footer>
            <p class="text-center font-weight-bold">Hippo Manager Assessment &copy; 2020</p>
            <p class="text-center font-weight-bold">Created by Brian Spencer</p>
        </footer>

    </body>
</html>