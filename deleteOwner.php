<?php
include("config.php");
session_start();
$id = $_GET['id'];
print "<h1>Are you sure you want to delete Owner $id?</h1>";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    //user wnats to create an account
    if(isset($_POST['delete'])){
        mysqli_query($db,"DELETE FROM owners WHERE id='".$id."'");
        header("location:welcome.php");
        exit();
    }
}



?>

<html>

    <head>
        <title>Delete Owner</title>

        <link rel="stylesheet" href="design.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </head>

    <body class="p-3 mb-2 bg-primary text-white">

        <br><br>

        <div align = "center">
            <div style = "width:50%" align = "left">

                <div style = "margin:30px">

                    <form action = "" method = post>
                        <button type="submit" name="delete" class="btn btn-secondary btn-lg btn-block">Delete</button>
                    </form>

                </div>

            </div>

        </div>

    </body>
</html>