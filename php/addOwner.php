<?php
// for database connnection
include("config.php");

$error = "";

// function to validate a string to see if it
// follows the xxx-xxx-xxxx format
function validatePhone($phone) {
    return preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone);
}

//gathering the inputs of the text fields
function gatherFields() {
    $helperArr = array(trim($_POST['firstName']), trim($_POST['lastName']), $_POST['phoneNumber']);
    $result = array();
    for($i = 0; $i < count($helperArr); $i+= 1) {
        array_push($result, $helperArr[$i]);
    }
    return $result;
}

// lookign at POST form to see if submit button was pressed
// if so, query database to edit patient
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // add owner button added
    if(isset($_POST['add'])){
        
        $editedFields = gatherFields();
        $number = validatePhone($editedFields[2]);
        $lengthOfFirstName = strlen($editedFields[0]);
        $lengthOfLastName = strlen($editedFields[1]);
        
        // if they entered a valid phone number, first name, and last name
        if ($number and $lengthOfFirstName >0 and $lengthOfLastName >0) {
            // array of information provided in form
            $query = 'INSERT into owners(fName, lName, phoneNum) VALUES(?, ?, ?)';
            if (!mysqli_prepare($db, $query)) {
                echo "SQL error";
            } else {
                $stmt = mysqli_prepare($db, $query);
                mysqli_stmt_bind_param($stmt, "sss", $editedFields[0], $editedFields[1], $editedFields[2]);
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
        <title>Add Owner</title>
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
            <h4>Fill in all fields and click Add Owner when done.</h4>
            <div style = "width:50%; border: solid 2px #333333; border-radius: 5px; border-color: white; " align = "left">

                <div style = "margin:30px">

                    <form action = "" method = post>
                        <input type="text" class="form-control" placeholder="First Name" name="firstName">
                        <br>
                        <input type="text" class="form-control" placeholder="Last Name" name="lastName">
                        <br>
                        <input type="text" class="form-control" placeholder="Phone Number 123-456-7890" name="phoneNumber">
                        <br>
                        <div style = "font-size:11px; color: white;"><?php echo $error; ?></div>
                        <button type="submit" name="add" class="btn btn-secondary btn-lg btn-block">Add Owner</button>
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