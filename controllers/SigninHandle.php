<?php
require "../model/Database.php";
$db = new Database();

$wrongPasswordErr = "" ;

if (isset($_POST['userid']) && isset($_POST['password'])) {
    if ($db->dbConnect()) {
        if ( $db->logIn( $_POST['userid'], $_POST['password'])) 
        {
            if (session_status() === PHP_SESSION_NONE) 
                session_start();
            
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $userid;
            header("location: welcome.php");
        } else { $wrongPasswordErr = 'Wrong password' ; }
    } else {
        header("location: trouble.php") ;
        die();
    }
} else die() ;
?>