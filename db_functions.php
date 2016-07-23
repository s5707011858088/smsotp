<?php

class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
        include_once '/var/www/html/engine/db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {

    }

	public function getrad(){
  $link = mysqli_connect("localhost", "radius", "password", "radius");
	$result = mysqli_query($link,"SELECT * FROM radcheck");
	return $result;
	}

	public function getuserdot1x(){
    $link = mysqli_connect("localhost", "radius", "password", "radius");
		$result = mysqli_query($link,"SELECT * FROM `radacct` WHERE `acctstoptime` is NULL AND nasporttype = 'Wireless-802.11'");
		return $result;
	}
	public function getuserhotspot(){
    $link = mysqli_connect("localhost", "radius", "password", "radius");
		$result = mysqli_query($link,"SELECT * FROM `radacct` WHERE `acctstoptime` is NULL AND nasporttype = 'Ethernet'");
		return $result;
	}

	public function getuserpass(){
    $link = mysqli_connect("localhost", "radius", "password", "radius");
		$result = mysqli_query($link,"SELECT `username`,`value` FROM `radcheck` ");
		return $result;
	}

	public function updatepass($user,$pass){
    $link = mysqli_connect("localhost", "radius", "password", "radius");
		$result = mysqli_query($link,"UPDATE `radcheck` SET value='$pass' WHERE username='$user'");
	}

  public function getMobile($user){
    //$pass = md5($pass);
    $link = mysqli_connect("localhost", "radius", "password", "radius");
    $result = mysqli_query($link,"SELECT `username`,`mobilephone` FROM userinfo WHERE `username` = '$user'");
    $data = mysqli_fetch_array($result);
    return $data['mobilephone'];
  }
}

?>
