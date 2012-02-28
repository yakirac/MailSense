<?php

include 'dbparams.php';

$uname = $_GET['uname'];

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to MySQL server');

mysql_select_db($dbname);

	// get the mailbox info that matches the box number sent in

	$nquery = "SELECT * FROM notifications WHERE Email_Address='$uname'";
	$mquery = "SELECT * FROM mailboxes WHERE email='$uname'";

	

	$nresult = mysql_query($nquery);
	$mresult = mysql_query($mquery);
	
	if(!$nresult && !$mresult)
	{
		die("Invalid query: " . mysql_error() . "<br/>Query: " . $query);
	}
	
	if(mysql_num_rows($nresult) == 0 && mysql_num_rows($mresult) == 0){
		$json["exists"] = "no";
		echo json_encode($json);
	}
	if(mysql_num_rows($nresult) > 0 && mysql_num_rows($mresult) > 0){
		$mrow = mysql_fetch_array($mresult);
		$nrow = mysql_fetch_array($nresult);
		//echo "Email reminders = " . $nrow['Email_Reminders'];
		$data = array("exist"=>yes,"boxn"=>$mrow['box'], "combo"=>$mrow['combo'], "notify"=>$nrow['Notify_On'], 
					"email"=>$nrow['Email_On'], "eremind"=>$nrow['Email_Reminders'], "text"=>$nrow['Text_On'], 
					"tremind"=>$nrow['Text_Reminders'], "carrier"=>$nrow['Carrier'], "fb"=>$nrow['Facebook_On'], 
					"fbremind"=>$nrow['Facebook_Reminders']);
		//$ages = array("Peter"=>32, "Quagmire"=>30, "Joe"=>34);
		$json["exists"] = $data;
		echo json_encode($json);
	}


?>