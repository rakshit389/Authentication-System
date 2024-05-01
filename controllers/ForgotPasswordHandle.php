<?php
require "../model/Database.php";
$db = new Database();

function generateToken() {
    return bin2hex(random_bytes(16)); 
}

$sendmailInfo = '' ;
if ( isset($_POST['userid']) && isset($_POST['send_mail'])) {
    
    $to = $_POST['userid'];
    $subject = "DoNotReply Reset Password";
    $token = generateToken() ;

    $resetLink = "http://localhost/authentication/views/reset_password.php?token=$token";
    $message = "Hii\nPlease click on the below url to reset your password.\n $resetLink";
 
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers = "From: rakshit.upd@gmail.com" . "\r\n" ;
  
    if( isset($_POST['userid']) && isset($token) )
    {
        if ($db->dbConnect()) {
            
            if( $db->search_user( $_POST['userid'] ) )
            {
                if ( $db->update_token( $_POST['userid'] , $token ) ) 
                {
                    if (  mail($to, $subject, $message, $headers ) ) {
                        $sendmailInfo = "If the user exist then you'll receive a mail" ;
                    } else {
                        $sendmailInfo = 'Try Again later' ;
                    }
                }  
            }
            else
            {
                $sendmailInfo = "User doesn't exist" ;
            }
        }
    }
} else die() ;
?>