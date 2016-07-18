<?php
error_reporting(E_ALL ^ E_NOTICE);
include_once '/var/www/engine/db_functions.php';
include_once '/var/www/engine/sms.php';
/*
$to = "sitita_charuraks@hotmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: sitita_charuraks@hotmail.com" . "\r\n" .
"CC: somebodyelse@example.com";

mail($to,$subject,$txt,$headers);
*/

$userpass = originaluserpass();


while(true){
$userdot1x = checkuserdot1x();
	for($i=0; $i<$userpass[3][3]; $i++){
		foreach($userdot1x as $user){
			if($user==$userpass[0][$i] && $userpass[2][$i]==0){
				genuser($user);
				$userpass[2][$i] = 1;
			}
		}
	}

$userhotspot = checkuserhotspot();
	for($i=0; $i<$userpass[3][3]; $i++){
		foreach($userhotspot as $user){
			if($user==$userpass[0][$i] && $userpass[2][$i]==1){
				turnbackuser($user,$userpass[1][$i]);
				print "TurnbackUser Hotspot "+$user;
				$userpass[2][$i] = 0;
			}
		}
	}

	sleep(5);
}


function genuser($user){
	$db = new DB_Functions();
	$pass = randomPassword();
	$mobile = $db->getMobile($user);
	sendsms($mobile,$pass);
	$res = $db->updatepass($user,$pass);

}

function turnbackuser($user,$pass){
	$db = new DB_Functions();
	$res = $db->updatepass($user,$pass);
}


/*foreach($userpass[1] as $a){
	print $a;
}*/
//print(randomPassword());

function checkuserdot1x(){
	print "checkuserdot1x Function ====================";
	$db = new DB_Functions();
	$res = $db->getuserdot1x();
	$username;
	$count = 0;
	while($fetch = mysql_fetch_array($res)){
		print $username[$count] = $fetch[3];
		$count++;
	}
	return $username;
}

function checkuserhotspot(){
	print "checkuserhotspot Function ====================";
	$db = new DB_Functions();
	$res = $db->getuserhotspot();
	$username;
	$count = 0;
	while($fetch = mysql_fetch_array($res)){
		print $username[$count] = $fetch[3];
		$count++;
	}
	return $username;
}

function originaluserpass(){
	print "originaluserpass Function ====================";
	$db = new DB_Functions();
	$res = $db->getuserpass();
	//$userpass;
	$count = 0;
	while($fetch = mysql_fetch_array($res)) {
		 $userpass[0][$count] = $fetch[0];
		 $userpass[1][$count] = $fetch[1];
		 $userpass[2][$count] = 0;
		 $userpass[3][3] = $count;
		$count++;
	}

	return $userpass;
}

function randomPassword() {
	print "randomPassword Function ====================";
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function sendsms($mobile,$pass){
	$sms = new thsms();

	$sms->username   = 'username';
	$sms->password   = 'password';

	$a = $sms->getCredit();
	var_dump( $a);

	$b = $sms->send( '0000', $mobile, $pass);
	var_dump( $b);
}

?>
