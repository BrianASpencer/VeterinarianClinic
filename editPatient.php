<?php
include("config.php");

$patientID = $_GET['pid'];

function query($query) {
    global $db;
    $result = mysqli_query($db, $query);
    if (!$result) {
        return -1;
    }
    return $result; 
}


if($_SERVER["REQUEST_METHOD"] == "POST") {
    //user wnats to create an account
    if(isset($_POST['submit'])){
        header("location:welcome.php");
        exit();
    }
}

$query = "SELECT * FROM patients WHERE pid=$patientID";
$result = query($query);
$fields = mysqli_fetch_assoc($result);
$nPlace = htmlspecialchars($fields['fName']);
$sPlace = htmlspecialchars($fields['species']);
$cPlace = htmlspecialchars($fields['color']);
$bPlace = htmlspecialchars($fields['dOB']);

?>

<html>

    <head>
        <title>Edit Patient</title>

        <link rel="stylesheet" href="design.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </head>

    <body class="p-3 mb-2 bg-primary text-white">

        <h1 class="display-1">Clinic Manager</h1>

        <br><br>

        <div align = "center">
            <h4>Update any fields and click Submit Changes when done.</h4>
            <div style = "width:50%; border: solid 2px #333333; border-radius: 5px; border-color: white; " align = "left">

                <div style = "margin:30px">

                    <form action = "" method = post>
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

    </body>
</html>