<?php
ini_set('display_errors', 1);
include 'dbparams.php';

//$term = $_GET['mail'];
//$mail = json_decode($term, true);
$boxn = $_GET['box'];
$havemail = $_GET['havemail'];
$gtid = 888456781;

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to MySQL server');

mysql_select_db($dbname);

	// get the mailbox info that matches the box number sent in

	$query = "SELECT * FROM mailboxes WHERE box='$boxn'";
	//$query = "SELECT * FROM mailboxes";
	

	$result = mysql_query($query);
	if(!$result)
	{
		die("Invalid query: " . mysql_error() . "<br/>Query: " . $query);
	}


	
	$row = mysql_fetch_array($result);
		
	if((strcmp($havemail, "yes") == 0) && (strcmp($row['havemail'], "yes") == 0)){
			
	}
	else if((strcmp($havemail, "no") == 0) && (strcmp($row['havemail'], "yes") == 0)){
		$timestamp = date('Y\-m\-j\ h\:i\:s');
		$nquery = "UPDATE mailboxes SET havemail = 'no', timestamp = '$timestamp' WHERE box = '$boxn'";
		$qresult = mysql_query($nquery);
		if(!$qresult)
		{
			die("Invalid query: " . mysql_error() . "<br/>Query: " . $nquery);
		}
		echo ($qresult . "<br/>");
		echo ($timestamp . "<br/>");

		$uresult = mysql_query($query);
		while($urow = mysql_fetch_array($uresult)){
		//echo $row['box'];
		echo $urow['box'] . " " . $urow['gtid'] . " " . $urow['havemail'];
		}


	}
	else if((strcmp($havemail, "no") == 0) && (strcmp($row['havemail'], "no") == 0)){
	
	}
	else if((strcmp($havemail, "yes") == 0) && (strcmp($row['havemail'], "no") == 0)){
		$timestamp = date('Y\-m\-j\ h\:i\:s');
		$nquery = "UPDATE mailboxes SET havemail = 'yes', timestamp = '$timestamp' WHERE box = '$boxn'";
		$qresult = mysql_query($nquery);
		if(!$qresult)
		{
			die("Invalid query: " . mysql_error() . "<br/>Query: " . $nquery);
		}
				
		$email = $row['email'];
		//echo "Email = " . $email;
		$gquery = "SELECT * FROM notifications WHERE Email_Address ='$email'";
		$gresult = mysql_query($gquery); 
		if(!$gresult)
		{
			die("Invalid query: " . mysql_error() . "<br/>Query: " . $nquery);
		}

		
		$nrow = mysql_fetch_array($gresult);

		if($nrow['Text_On'] == "1"){
			//Will be changed to check notifications table instead of mailboxes table
			if($nrow['Carrier'] == "att"){
				$number = $nrow['Cell_Number']."@mms.att.net";
			}
			if($nrow['Carrier'] == "verizon"){
				$number = $nrow['Cell_Number']."@vtext.com";
			}
			if($nrow['Carrier'] == "tmobile"){
				$number = $nrow['Cell_Number']."@tmomail.net";
			}
			if($nrow['Carrier'] == "sprint"){
				$number = $nrow['Cell_Number']."@messaging.sprintpcs.com";
			}
			
			$message = "You just received mail in your mailbox. Box: " . $row['box'] . "Combination: " . $row['combo'];

			mail("$number", "SMS", "$message"); 
		}
		if($nrow['Email_On'] == "1"){
			$to = $nrow['Email_Address']."@gatech.edu";
			$subject = "You have mail";
			$txt = "You just received mail in your mailbox. Box: " . $row['box'] . " Combination: " . $row['combo'];
			$headers = "From: mailsense@gatech.edu";

			mail($to,$subject,$txt,$headers);
		}
		
		echo ($qresult . "<br/>");
		echo ($timestamp . "<br/>");

		$uresult = mysql_query($query);

		while($urow = mysql_fetch_array($uresult)){
		//echo $row['box'];
		echo $urow['box'] . " " . $urow['gtid'] . " " . $urow['havemail'];
		}

	}
	
?>
