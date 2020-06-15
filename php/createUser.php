<?php
// for database connnection
include("config.php");

$error = "";

// looking at POST form to see if user hit create account button
if($_SERVER["REQUEST_METHOD"] == "POST") {

    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
    $myConfpassword = mysqli_real_escape_string($db,$_POST['confPassword']); 
    
    if (!filter_var($myusername, FILTER_VALIDATE_EMAIL)) {
        $error = "Username must be an email address";
    } else {
        if ($mypassword == $myConfpassword) {
            $mypassword = password_hash($mypassword, PASSWORD_DEFAULT);
            $sql = 'SELECT vid FROM vets WHERE uName = (?)';
            if (!mysqli_prepare($db, $sql)) {
                echo "SQL error";
            } else {
                $stmt = mysqli_prepare($db, $sql);
                mysqli_stmt_bind_param($stmt, "s", $myusername);
                mysqli_stmt_execute($stmt);
            }
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $count = mysqli_num_rows($result);
            if($count == 0) {
                $sql = 'INSERT INTO vets(uName, pWord) VALUES(?, ?)';
                if (!mysqli_prepare($db, $sql)) {
                    echo "SQL error";
                } else {
                    $stmt = mysqli_prepare($db, $sql);
                    mysqli_stmt_bind_param($stmt, "ss", $myusername, $mypassword);
                    mysqli_stmt_execute($stmt); 
                }
                header("location:login.php");
            } else {
                $error = "User already exists.";
            }
        } else {
            $error = "Passwords must match.";
        }
    }
        
}
?>
<html>

    <head>
        <title>Create Account</title>
        <link rel="shortcut icon" href="../images/parkway-veterinary-hospital-dublin-veterinarian-png-vet-400_387.png">
        <link rel="stylesheet" href="../css/design.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </head>

    <body class="p-3 mb-2 bg-primary text-white">
        
        <div>
            <h1 class="display-1">Clinic Manager</h1>
            <img src="../images/hospital-512.png" width="128" height="128" class="img-fluid rounded mx-auto d-block">
        </div>
        
        <div align = "center">
            <div style = "width:50%; border: solid 2px #333333; border-radius: 5px; border-color: white; " align = "left">

                <div style = "margin:30px">

                    <form action = "" method = post>
                        <input type="text" class="form-control" placeholder="Your Username" name="username">
                        <br>
                        <input type="password" class="form-control" placeholder="Your Password" name="password">
                        <br>
                        <input type="password" class="form-control" placeholder="Confirm Password" name="confPassword">
                        <br>
                        <div style = "font-size:11px; color: white;"><?php echo $error; ?></div>
                        <button type="submit" class="btn btn-secondary btn-lg btn-block">Create New Account</button>
                    </form>

                </div>

            </div>

        </div>
        
        
    </body>
</html>