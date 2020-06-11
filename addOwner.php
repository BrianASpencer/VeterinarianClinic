<?php
include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST") {
    //user wnats to create an account
    if(isset($_POST['add'])){
        mysqli_query($db,"DELETE FROM owners WHERE id='".$id."'");
        header("location:welcome.php");
        exit();
    }
}

?>

<html>

    <head>
        <title>Add Owner</title>

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
            <div style = "width:50%; border: solid 2px #333333; border-radius: 5px; border-color: white; " align = "left">

                <div style = "margin:30px">

                    <form action = "" method = post>
                        <input type="text" class="form-control" placeholder="First Name" aria-label="First Name" aria-describedby="basic-addon2" name="firstName">
                        <br>
                        <input type="text" class="form-control" placeholder="Last Name" aria-label="Last Name" aria-describedby="basic-addon2" name="lastName">
                        <br>
                        <input type="text" class="form-control" placeholder="Phone Number 123-456-7890" aria-label="Phone Number 123-456-7890" aria-describedby="basic-addon2" name="phoneNumber">
                        <br>
                        <button type="submit" name="add" class="btn btn-secondary btn-lg btn-block">Submit Changes</button>
                    </form>

                </div>

            </div>

        </div>

    </body>
</html>