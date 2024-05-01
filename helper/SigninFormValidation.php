<?php
$useridErr = "";
$passwordErr = "" ;

$proceed = true ;
if ( $_SERVER["REQUEST_METHOD"] === "POST" ) {

    $userid = checkInput($_POST["userid"])  ;
    $password = checkInput($_POST["password"]) ;
    
    if (empty($userid)) {
        $useridErr = 'Please enter userid';
        $proceed = false ;
    } 
    if (!preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/" , $userid) && !empty($userid) ) 
    {
        $useridErr =  'Invalid email id format' ; 
        $proceed = false ;
    } 
    if( empty($password) )
    {
        $passwordErr = 'Please enter password' ;
        $proceed = false ;
    }

    if( $proceed )
        require '../controllers/SigninHandle.php' ;
}
function checkInput($input)
{
    $input = trim($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>