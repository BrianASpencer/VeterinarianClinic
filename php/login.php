<?php
// for database connnection
include("config.php");

session_start();
$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['login'])) {
        if (!filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
            $error = "A valid email address is required.";
            goto end;
        } else {
            $myusername = mysqli_real_escape_string($db,$_POST['username']);
            $mypassword = mysqli_real_escape_string($db,$_POST['password']);
        }
        

        $sql = "SELECT vid FROM vets WHERE uName = '".$myusername."' and pWord = '".$mypassword."';";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $active = $row['active'];

        $count = mysqli_num_rows($result);

        // If result matched $myusername and $mypassword, table row must be 1 row
        // this means there is a user that exists with these credentials
        if($count == 1) {
            //session_register("myusername");
            $_SESSION['login_user'] = $myusername;
            header("location: welcome.php");
            exit();
        } else if ($count == 0) {
            $error = "User doesn't exist.";
        } else {
            // invalid login to let them know to try again
            $error = "Invalid login. Please try again.";
        }
    }
    end:

    //user wnats to create an account
    if(isset($_POST['createAccount'])){
        header("location:createUser.php");
        exit();
    }
}

?>

<html>

    <head>
        <title>Login</title>
        <link rel="shortcut icon" href="parkway-veterinary-hospital-dublin-veterinarian-png-vet-400_387.png">
        <link rel="stylesheet" href="design.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </head>

    <body class="p-3 mb-2 bg-primary text-white">
        <div>
            <h1 class="display-1">Clinic Manager</h1>
            <img src="hospital-512.png" width="128" height="128" class="img-fluid rounded mx-auto d-block">
        </div>
        
        <br><br>

        <div align = "center">
            <div style = "width:50%; border: solid 2px #333333; border-radius: 5px; border-color: white; " align = "left">

                <div style = "margin:30px">

                    <form action = "" method = post>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon2" name="username">
                        <br>
                        <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon2" name="password">
                        <br>
                        <div style = "font-size:11px; color: white;" class="font-weight-bold"><?php echo $error; ?></div>
                        <button type="submit" name="login" class="btn btn-secondary btn-lg btn-block">Login</button>
                        <button type="submit" name="createAccount" class="btn btn-secondary btn-lg btn-block">Create New Account</button>
                        <div style = "font-size:11px; color: white;" class="font-weight-bold">Need to create an account? Click above.</div>
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
