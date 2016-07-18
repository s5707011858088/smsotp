<?php

class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
        include_once '/var/www/engine/db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {

    }

	public function getrad(){
	$result = mysql_query("SELECT * FROM radcheck");
	return $result;
	}

	public function getuserdot1x(){
		$result = mysql_query("SELECT * FROM `radacct` WHERE `acctstoptime` is NULL AND nasporttype = 'Wireless-802.11'");
		return $result;
	}
	public function getuserhotspot(){
		$result = mysql_query("SELECT * FROM `radacct` WHERE `acctstoptime` is NULL AND nasporttype = 'Ethernet'");
		return $result;
	}

	public function getuserpass(){
		$result = mysql_query("SELECT `username`,`value` FROM `radcheck` ");
		return $result;
	}

	public function updatepass($user,$pass){
		$result = mysql_query("UPDATE `radcheck` SET value='$pass' WHERE username='$user'");
	}

  public function getMobile($user){
    //$pass = md5($pass);
    $result = mysql_query("SELECT username,mobilephone FROM userinfo WHERE `username` = $user");
    if (mysql_num_rows($result) > 0) {
        $data = mysql_fetch_array($result);
        $return $data['mobilephone'];
    } else {
        return false;
    }

}

?>
