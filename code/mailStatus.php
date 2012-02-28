<?php

include 'dbparams.php';

$uname = $_GET['uname'];

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to MySQL server');

mysql_select_db($dbname);

	// get the mailbox info that matches the box number sent in

	$mquery = "SELECT * FROM mailboxes WHERE email='$uname'";

	

	$mresult = mysql_query($mquery);
	
	if(!$mresult)
	{
		die("Invalid query: " . mysql_error() . "<br/>Query: " . $query);
	}
	
	if(mysql_num_rows($mresult) > 0){
		$mrow = mysql_fetch_array($mresult);
		$data = array("havemail"=>$mrow['havemail'],"timestamp"=>$mrow['timestamp']);
		//echo "havemail = " . $mrow['havemail'];
		//echo "timestamp = " . $mrow['timestamp'];
		//$ages = array("Peter"=>32, "Quagmire"=>30, "Joe"=>34);
		$json["mail"] = $data;
		echo json_encode($json);
	}


?>