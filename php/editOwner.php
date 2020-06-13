<?php
// for database connnection
include("config.php");

$error = "";

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

// lookign at POST form to see if submit button was pressed
// if so, query database to edit owner
if($_SERVER["REQUEST_METHOD"] == "POST") {
    //user wnats to create an account
    if(isset($_POST['submit'])){
        header("location:welcome.php");
        exit();
    }
}

// these statements query and then fill in the fields of the boxes
$query = "SELECT * FROM owners WHERE oid=$ownerID";
$result = query($query);
$fields = mysqli_fetch_assoc($result);
$fnPlace = "First Name: ".htmlspecialchars($fields['fName']);
$lnPlace = "Last Name: ".htmlspecialchars($fields['lName']);
$pnPlace = "Phone Number: ".htmlspecialchars($fields['phoneNum']);

?>

<html>

    <head>
        <title>Edit Owner</title>
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
                        <input type="text" class="form-control" placeholder="<?php echo $fnPlace; ?>" name="firstName">
                        <br>
                        <input type="text" class="form-control" placeholder="<?php echo $lnPlace; ?>" name="lastName">
                        <br>
                        <input type="text" class="form-control" placeholder="<?php echo $pnPlace; ?>" name="phoneNumber">
                        <br>
                        <div style = "font-size:11px; color: white;"><?php echo $error; ?></div>
                        <button type="submit" name="edit" class="btn btn-secondary btn-lg btn-block">Submit Changes</button>
                    </form>

                </div>

            </div>

        </div>
        
        <br>
        <footer>
            <p class="text-center font-weight-bold">Copyright &copy; Hippo Manager Assessment</p>
            <p class="text-center font-weight-bold">Created by Brian Spencer</p>
        </footer>

    </body>
</html>