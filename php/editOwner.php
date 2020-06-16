<?php
// for database connnection
include("config.php");

$error = "";

// make sure the ID passed is an integer, otherwise go back to welcome page.
if(is_numeric($_GET['oid'])){
    $ownerID = intval($_GET['oid']);
} else {
    header("location:welcome.php?error=");
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

// these statements query and then fill in the fields of the boxes
$query = "SELECT * FROM owners WHERE oid=$ownerID";
$result = query($query);
$fields = mysqli_fetch_assoc($result);
$fName = "First Name: ".htmlspecialchars($fields['fName']);
$lName = "Second Name: ".htmlspecialchars($fields['lName']);
$phoneNum = "Phone Number: ".htmlspecialchars($fields['phoneNum']);

// function to validate a string to be in xxx-xxx-xxxx format
function validatePhone($phone) {
    return preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone);
}

// gathering fields of text boxes
// if they're empty, use database values
function gatherFields($fields) {
    $indexArr = array('fName', 'lName', 'phoneNum');
    $helperArr = array(trim($_POST['fName']), trim($_POST['lName']), $_POST['phoneNum']);
    $result = array();
    for($i = 0; $i < count($helperArr); $i+= 1) {
        if (strlen($helperArr[$i]) == 0) {
            array_push($result, $fields[$indexArr[$i]]);
        } else {
            array_push($result, $helperArr[$i]);
        }
    }
    return $result;
}

// lookign at POST form to see if submit button was pressed
// if so, query database to edit patient
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['submit'])){
        
        $editedFields = gatherFields($fields);
        $lengthOfFirstName = strlen($editedFields[0]);
        $lengthOfLastName = strlen($editedFields[1]);
        $number = validatePhone($editedFields[2]);
        
        if ($number and $lengthOfFirstName >0 and $lengthOfLastName >0) {
            // array of information provided in form
            $query = 'UPDATE owners SET fName= (?), lName= (?), phoneNum= (?) WHERE oid= (?)';
            if (!mysqli_prepare($db, $query)) {
                echo "SQL error";
            } else {
                $stmt = mysqli_prepare($db, $query);
                mysqli_stmt_bind_param($stmt, "sssi", $editedFields[0], $editedFields[1], $editedFields[2], $ownerID);
                mysqli_stmt_execute($stmt);
            }
            $result = mysqli_stmt_get_result($stmt);
            header("location:welcome.php?error=");
            exit();
        } else {
            // if any of the criteria isn't correct, error message is updated.
            if (!$number) {
                $error = 'Please enter phone number as 123-456-7890.';
            }
            if ($lengthOfFirstName == 0) {
                $error = $error.' First name cannot be empty.';
            }
            if ($lengthOfLastName == 0) {
                $error = $error.' Last name cannot be empty.';
            }
        }
    }
}
?>

<html>

    <head>
        <title>Edit Patient</title>
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
            <h4>Update any fields and click Submit Changes when done.</h4>
            <div style = "width:50%; border: solid 2px #333333; border-radius: 5px; border-color: white; " align = "left">

                <div style = "margin:30px">

                    <form action = "" method = post>
                        <input type="text" class="form-control" placeholder="<?php echo $fName; ?>" name="fName">
                        <br>
                        <input type="text" class="form-control" placeholder="<?php echo $lName; ?>" name="lName">
                        <br>
                        <input type="text" class="form-control" placeholder="<?php echo $phoneNum; ?>" name="phoneNum">
                        <br>
                        <div style = "font-size:11px; color: white;"><?php echo $error; ?></div>
                        <button type="submit" name="submit" class="btn btn-secondary btn-lg btn-block">Submit Changes</button>
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