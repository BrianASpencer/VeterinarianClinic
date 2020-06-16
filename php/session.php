<?php
    // this file allows us to address user in the session
    include('config.php');
    session_start();

    $user_check = $_SESSION['login_user'];

    $ses_sql = mysqli_query($db,"select uName from vets where uName = '$user_check' ");

    $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

    // setting the username for login session
    $login_session = htmlspecialchars($row['uName']);

    if(!isset($_SESSION['login_user'])){
        header("location:login.php");
        die();
    }
?>