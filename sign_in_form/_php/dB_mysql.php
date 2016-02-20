<?php
  include_once 'config.php';

  class Dbmysql{

    private $servername = DB_HOST;
    private $username = DB_USER;
    private $password = DB_PASSWORD;
    private $dbname = DB_DATABASE;
    private $table_name = "User";
    private $conn;

    public function __construct(){
      $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
    }

    public function checkConnection(){
      if (!$this->conn){
        die("Connection Failed : " . mysqli_connect_error());
      }
    }

    public function insertData($first, $last, $id, $email, $pass, $dob, $gender){
      $this->checkConnection();
      //
      //I didn't use single quotes at first, so that got me into a lot of trouble
      $sql ="INSERT INTO user 
        (userID,userEmail,userFirstName,userLastName, userPass,userDob,userGender) 
        VALUES('$id', '$email', '$first', '$last', '$pass','$dob','$gender')";

      $result = mysqli_query($this->conn, $sql);
      mysqli_close($this->conn);
      return $result;
    }

    public function checkExist($id_or_email, $pass, $what_is_it){
      //Need to bring logic here
     $this->checkConnection();
       //if $what_is_it is 1, it is email, else it is id
     if ($what_is_it === 1)
        $sql =  "SELECT * FROM User WHERE userEmail='$id_or_email' AND userPass='$pass' LIMIT 1";
      else
        $sql =  "SELECT * FROM User WHERE userID='$id_or_email' AND userPass='$pass' LIMIT 1";

      $result = mysqli_query($this->conn, $sql);
      mysqli_close($this->conn);

      if(mysqli_fetch_array($result)) return 1;
      else return 0;

    } 

  }
?>
