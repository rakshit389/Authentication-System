<?php

$passwordErr = "" ;
$cpasswordErr = "" ;
$passwordFormatErr = false ;
$proceed = true ;


if ( $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['set_new_password']) ) {

    $password = checkInput($_POST["password"])  ;
    $cpassword = checkInput($_POST["cpassword"])  ;
  
    if( empty($password) )
    {
        $passwordErr = 'Please enter new password' ;
        $proceed = false ;
    }
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s]).{8,50}$/" , $password)  && !empty($password) ) 
    {
        $passwordErr =  'Password should be 8-50 characters long and must contain at least one uppercase letter, one lowercase letter, one number, and one special character.' ; 
        $proceed = false ;
        $passwordFormatErr = true ;
    } 

    if( empty($cpassword)  && !empty($password) &&   !($passwordFormatErr)  )
    {
        $cpasswordErr = 'Please enter confirm password' ;
        $proceed = false ;
    }

    if ( $password != $cpassword  && !empty($cpassword) ) 
    {
        $cpasswordErr =  "Password didn't match" ; 
        $proceed = false ;
    } 

    if( $proceed )
        require '../controllers/ResetPasswordHandle.php' ;
}
function checkInput($input)
{
    $input = trim($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>