<?php
 
require "../helper/DatabaseConfig.php";
require "../helper/sanitize.php";

class Database
{
    public $conn;
    public $data;
    private $sql;
    protected $userid;
    protected $password;
    protected $dbc ;

    public function __construct()
    {
        $this->conn = null;
        $this->data = null;
        $this->dbc = new DatabaseConfig();
    }

    function dbConnect()
    {
        $this->conn = new mysqli($this->dbc->servername, $this->dbc->username, $this->dbc->password, $this->dbc->databasename);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $this->conn ;

    }

    function logIn( $userid, $password)
    {
        $userid = prepareData($this->conn, $userid);
        $password = prepareData($this->conn, $password);

        $q = $this->conn->prepare("select * from `register` where `userid` = ?");
        $q->bind_param("s" , $userid );
        $q->execute();
        $result = $q->get_result() ;

        if ( $result->num_rows > 0) {
            $row = $result->fetch_assoc() ;
            $dbuserid = $row['userid'];
            $dbpassword = $row['password'];
            if ($dbuserid == $userid && password_verify($password, $dbpassword)) {
                $login = true;
            } else $login = false;
        } else $login = false;

        return $login;
    }

    function signUp($userid, $password) 
    {
        $userid = prepareData($this->conn, $userid);
        $password = prepareData($this->conn, $password);
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $q1 = $this->conn->prepare("select * from `register` where `userid` = ?");
        $q1->bind_param("s" , $userid );
        $q1->execute();
        $result = $q1->get_result() ;

        if( $result->num_rows > 0  )
        {
            return 1024 ;
            die();
        }

        $q2 = $this->conn->prepare("INSERT INTO `register` ( `userid` , `password` ) VALUES ( ? , ?)");
        $q2->bind_param("ss" , $userid , $password );
    
        if ( $q2->execute() ) {
            return true;
        } 
        else
             return false ;
    }

    function update_token($userid, $token):bool
    {
    
        $userid = prepareData($this->conn, $userid) ;
        $toekn =  prepareData($this->conn, $token) ;

        $q1 = $this->conn->prepare("select userid from tokens where userid = ?"); 
        $q1->bind_param("s", $userid );
        $q1->execute();
        $result = $q1->get_result();

        if( $result->num_rows > 0  )
        {
            $upd_token_query = $this->conn->prepare("UPDATE tokens SET token_number = ? WHERE userid = ?"); 
            $upd_token_query->bind_param("ss", $token, $userid );

            if( $upd_token_query->execute()  )
                return true ;
            else 
                return false ;
        }
        else
        {
            $q2 = $this->conn->prepare("INSERT INTO tokens ( userid , token_number ) VALUES ( ? , ? )") ;
            $q2->bind_param("ss" , $userid , $token );
            if ( $q2->execute() ) {
                return true ;
            }  
            else 
                return false ;
        }
    }

    function update_password($dbuserid, $password)
    {
        $dbuserid = prepareData($this->conn, $dbuserid) ;
        $password = prepareData($this->conn, $password) ;

        $password = password_hash($password, PASSWORD_DEFAULT ) ;

        $q = $this->conn->prepare("UPDATE `register` SET `password` = ? WHERE `register`.`userid` = ? "); 
        $q->bind_param("ss", $password , $dbuserid );

        if ( $q->execute() ) {
            return true ;
        }  
        else 
            return false ;
    }

    function search_user($userid)
    {
        $userid = prepareData($this->conn, $userid) ;

        $q = $this->conn->prepare("select * from register where userid = ?") ;
        $q->bind_param("s" , $userid );
        $q->execute() ;
        $result = $q->get_result();

        if( $result->num_rows > 0  )
        {
            return true ;
        }
            return false ;
    }


    function search_token($token)
    {
        $token = prepareData($this->conn, $token) ;

        $q = $this->conn->prepare("select * from `tokens` where `token_number` = ?") ;
        $q->bind_param("s" , $token );
        $q->execute() ;
        $result =  $q->get_result();

        if( $result->num_rows > 0 )
        {
            if ( $row = $result->fetch_assoc() ) {
                return $row['userid'] ;
            }  
        }
        return false ;
    }
}

?>