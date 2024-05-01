<?php
require "../model/Database.php";
$db = new Database();

$userExistErr = "" ;
if ( isset($_POST['userid']) && isset($_POST['password'])) {
    
    if ($db->dbConnect()) {

        $query_result = $db->signUp( $_POST['userid'], $_POST['password'] ) ;
        if ( $query_result === 1024 ) 
        {
            $userExistErr = 'Email id already exists' ;
            die();
        }
        else if ( $query_result )
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $_POST['userid'] ;
            header("location: welcome.php");
        } else {
            header("location: trouble.php") ;
            die();
        }
    } else {
        header("location: trouble.php") ;
        die();
    }
} else die() ;
?>