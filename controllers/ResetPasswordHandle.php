<?php
require "../model/Database.php";
$db = new Database();

$passUpdateInfo = '' ;
if ( isset($_POST['password']) && isset($_POST['cpassword'])) {

    if ( $db->dbConnect() )
    {
        $token = $_GET['token'] ;
        $dbuserid = $db->search_token($token)  ; 

        if( isset($dbuserid) && $dbuserid  )                              // This is userid whose password has to be updated
        {
            if( $db->update_password( $dbuserid, $_POST['password']))
            {
                $passUpdateInfo = 'Password has been updated' ;
            }
            else
                $passUpdateInfo = 'Please try again' ;
        }
        else
        {
            header("Location: forgot_password.php");
            die();
        }
    }

} else die() ;

?>