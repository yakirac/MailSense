<?php

include 'dbparams.php';

//$term = $_GET['mail'];
//$mail = json_decode($term, true);
$cell = $_GET['cell'];
$email = $_GET['email'];
$ermind = $_GET['ereminders'];
$trmind = $_GET['treminders'];
$carrier = $_GET['carrier'];
$gtid = 888456781;

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to MySQL server');

mysql_select_db($dbname);

	// get the mailbox info that matches the box number sent in

	//$query = "SELECT * FROM mailboxes WHERE box='$boxn'";
	if(empty($cell) && empty($trmind) && empty($carrier)){
		$query = "UPDATE notifications SET Email_Reminders = '$ermind' WHERE Email_Address = '$email'";
		//$mquery = "UPDATE mailboxes SET email = '$email' WHERE GTID = '$gtid'";

	}
	if(empty($cell) && empty($trmind)){
		$query = "UPDATE notifications SET Carrier = '$carrier' WHERE Email_Address = '$email'";

	}
	if(empty($cell)){
			$query = "UPDATE notifications SET Text_Reminders = '$trmind', Carrier = '$carrier' WHERE Email_Address = '$email'";

	}else{
		$query = "UPDATE notifications SET Cell_Number = '$cell', Text_Reminders = '$trmind', Carrier = '$carrier' WHERE Email_Address = '$email'";
	}

	//$query = "SELECT * FROM mailboxes";
	

	$result = mysql_query($query);
	if(!$result)
	{
		die("Invalid query: " . mysql_error() . "<br/>Query: " . $query);
	}

?>