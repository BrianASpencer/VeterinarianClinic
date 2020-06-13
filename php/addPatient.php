<?php
// for database connnection
include("config.php");

// lookign at POST form to see if add button was pressed
// if so, query database to add new patient
if($_SERVER["REQUEST_METHOD"] == "POST") {
    //user wnats to create an account
    if(isset($_POST['add'])){
        global $db;
        $ownerID = $_POST['ownerID'];
        $name = $_POST['name'];
        $species = $_POST['species'];
        $color = $_POST['color'];
        $birth = $_POST['birth'];
        $query = "INSERT INTO patients(ownerID, fName, species, color, dOB) VALUES('".$ownerID."', '".$name."', '".$species."', '".$color."', '".$birth."');";
        query($db, $query);
        header("location:welcome.php");
        exit();
    }
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

?>

<html>

    <head>
        <title>Add Patient</title>
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
            <h4>Fill in all fields and click Add Patient when done.</h4>
            <div style = "width:50%; border: solid 2px #333333; border-radius: 5px; border-color: white; " align = "left">

                <div style = "margin:30px">

                    <form action = "" method = post>
                        <input type="text" class="form-control" placeholder="Owner's ID" aria-label="Owner's ID" aria-describedby="basic-addon2" name="ownerID">
                        <br>
                        <input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="basic-addon2" name="name">
                        <br>
                        <input type="text" class="form-control" placeholder="Species" aria-label="Species" aria-describedby="basic-addon2" name="species">
                        <br>
                        <input type="text" class="form-control" placeholder="Color" aria-label="Color" aria-describedby="basic-addon2" name="color">
                        <br>
                        <input type="text" class="form-control" placeholder="Date Of Birth YYYY-MM-DD" aria-label="Date Of Birth YYYY-MM-DD" aria-describedby="basic-addon2" name="birth">
                        <br>
                        <button type="submit" name="add" class="btn btn-secondary btn-lg btn-block">Add Patient</button>
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
