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

// lookign at POST form to see if submit button was pressed
// if so, query database to edit patient
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['submit'])){
        header("location:welcome.php");
        exit();
    }
}

// these statements query and then fill in the fields of the boxes
$query = "SELECT * FROM patients WHERE pid=$patientID";
$result = query($query);
$fields = mysqli_fetch_assoc($result);
$ownerID = "Owner's ID: ".htmlspecialchars($fields['ownerID']);
$nPlace = "Name: ".htmlspecialchars($fields['fName']);
$sPlace = "Species: ".htmlspecialchars($fields['species']);
$cPlace = "Color: ".htmlspecialchars($fields['color']);
$bPlace = "DOB: ".htmlspecialchars($fields['dOB']);

?>

<html>

    <head>
        <title>Edit Patient</title>
        <link rel="shortcut icon" href="parkway-veterinary-hospital-dublin-veterinarian-png-vet-400_387.png">
        <link rel="stylesheet" href="design.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </head>

    <body class="p-3 mb-2 bg-primary text-white">

        <h1 class="display-1">Clinic Manager</h1>
        <img src="hospital-512.png" width="128" height="128" class="img-fluid rounded mx-auto d-block">
        <br><br>

        <div align = "center">
            <h4>Update any fields and click Submit Changes when done.</h4>
            <div style = "width:50%; border: solid 2px #333333; border-radius: 5px; border-color: white; " align = "left">

                <div style = "margin:30px">

                    <form action = "" method = post>
                        <input type="text" class="form-control" placeholder="<?php echo $ownerID; ?>" name="ownerID">
                        <br>
                        <input type="text" class="form-control" placeholder="<?php echo $nPlace; ?>" name="name">
                        <br>
                        <input type="text" class="form-control" placeholder="<?php echo $sPlace; ?>" name="species">
                        <br>
                        <input type="text" class="form-control" placeholder="<?php echo $cPlace; ?>" name="color">
                        <br>
                        <input type="text" class="form-control" placeholder="<?php echo $bPlace; ?>" name="birth">
                        <br>
                        <button type="submit" name="submit" class="btn btn-secondary btn-lg btn-block">Submit Changes</button>
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