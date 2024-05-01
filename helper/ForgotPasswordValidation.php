<?php
$useridErr = "";
$passwordErr = "" ;
$cpasswordErr = "" ;
$passwordFormatErr = false ;
$proceed = true ;



if ( $_SERVER["REQUEST_METHOD"] === "POST"  && isset($_POST['userid']) ) {

    $userid = checkInput($_POST["userid"])  ;
    
    if (empty($userid)) {
        $useridErr = 'Please enter userid';
        $proceed = false ;
    } 
    if (!preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/" , $userid) && !empty($userid) ) 
    {
        $useridErr =  'Invalid email id format' ; 
        $proceed = false ;
    } 

    if( $proceed )
        require '../controllers/ForgotPasswordHandle.php' ;
}
function checkInput($input)
{
    $input = trim($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>