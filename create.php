<?php
include("config.php");
$error = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {

    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
    $myConfpassword = mysqli_real_escape_string($db,$_POST['confPassword']); 

    $sql = "SELECT vid FROM vets WHERE uName = '".$myusername."' and pWord = '".$mypassword."';";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($count == 0) {
        $sql = "INSERT INTO vets VALUES('".$myusername."','".$mypassword."');";
        $result = mysqli_query($db,$sql);
        header("location:login.php");
    } else {
        $error = "User already exists.";
    }
    
    //user wnats to create an account
    if(isset($_POST['createAccount'])){
      header("location:create.php");
      exit();
    }
}
?>

<html>

    <head>
        <title>Login</title>
        
        <link rel="stylesheet" href="design.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </head>

    <body class="p-3 mb-2 bg-primary text-white">
        
        <div align = "center">
            <div style = "width:50%; border: solid 2px #333333; border-radius: 5px; border-color: white; " align = "left">

                <div style = "margin:30px">

                    <form action = "" method = post>
                        <input type="text" class="form-control" placeholder="Your Username" aria-label=" Your Username" aria-describedby="basic-addon2" name="username">
                        <br>
                        <input type="password" class="form-control" placeholder="Your Password" aria-label="Your Password" aria-describedby="basic-addon2" name="password">
                        <br>
                        <input type="password" class="form-control" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="basic-addon2" name="confPassword">
                        <br>
                        <div style = "font-size:11px; color:#cc0000;"><?php echo $error; ?></div>
                        <button type="submit" class="btn btn-secondary btn-lg btn-block">Create New Account</button>
                    </form>

                </div>

            </div>

        </div>

    </body>
</html>