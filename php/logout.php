<?php
   session_start();

   // destroy session and go back to login page
   if(session_destroy()) {
      header("Location: login.php");
   }
?>