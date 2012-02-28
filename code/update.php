<?php
header("#mainon");

ini_set('display_errors', 1);

include 'dbparams.php';
$gtid = 888456781;
$uname = $_GET['name'];
$box = $_GET['boxn'];
$combo = $_GET['combo'];
$switchon = $_GET['radio-flip'];
$emailon = $_GET['radio-email'];
$texton = $_GET['radio-cell'];
$fbon = $_GET['radio-fb'];
$fbrmind = $_GET['fbreminders'];

echo "switchon = " . $switchon;
//echo " emailon = " . $emailon;
//echo " texton = " . $texton;
echo " name = " . $uname;
echo " box = " . $box;
echo " combo = " . $combo;

if($switchon== "")
{
	$switchon = "NULL";
}

//$fp = fopen($filename, 'w');
//fwrite($fp, $post);
//fclose($fp);

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to MySQL server');

mysql_select_db($dbname);

$nquery = "SELECT Email_Address FROM notifications WHERE Email_Address='$uname'";
$mquery = "SELECT email FROM mailboxes WHERE email='$uname'";
$nresult = mysql_query($nquery);
$mresult = mysql_query($mquery);

if(!$nresult || !$mresult)
{
	die("Invalid query: " . mysql_error() . "<br/>Query: " . $query);
}

if(mysql_num_rows($nresult) > 0 && mysql_num_rows($mresult) > 0)
{
	if($switchon == "1" || $switchon == "0"){
		$query = "UPDATE notifications SET Notify_On='$switchon' WHERE Email_Address='$uname'";
		//echo $query;
		$result = mysql_query($query);
		//echo("updated: ". mysql_num_rows($result) . "row");
	
		//echo "Notifyon = " . $switchon;

		if(!$result)
		{
			die("Invalid query: " . mysql_error() . "<br/>Query: " . $query);
		}
	}
	if($emailon == "1" || $emailon == "0"){
		$query = "UPDATE notifications SET Email_On='$emailon' WHERE Email_Address='$uname'";
		//echo $query;
		$result = mysql_query($query);
		//echo("updated: ". mysql_num_rows($result) . "row");
	
		//echo "Emailon = " . $emailon;

		if(!$result)
		{
			die("Invalid query: " . mysql_error() . "<br/>Query: " . $query);
		}
	}
	if($texton == "1" || $texton == "0"){
		$query = "UPDATE notifications SET Text_On='$texton' WHERE Email_Address='$uname'";
		$result = mysql_query($query);
		//echo("updated: ". mysql_num_rows($result) . "row");

		//echo "Texton = " . $texton;	

		if(!$result)
		{
			die("Invalid query: " . mysql_error() . "<br/>Query: " . $query);
		}

	}	
	if($fbon == "1" || $fbon == "0"){
		$query = "UPDATE notifications SET Facebook_On='$fbon', Facebook_Reminders = '$fbrmind' WHERE Email_Address='$uname'";
		$result = mysql_query($query);
		//echo("updated: ". mysql_num_rows($result) . "row");

		//echo "FBon = " . $fbon;	

		if(!$result)
		{
			die("Invalid query: " . mysql_error() . "<br/>Query: " . $query);
		}

	}	
}
else
{
	$nquery = "INSERT INTO notifications (Email_Address, Notify_On) VALUES ('$uname', '$switchon')";
	$mquery = "INSERT INTO mailboxes (email, box, combo) VALUES ('$uname', '$box', '$combo')";
	$nresult = mysql_query($nquery);
	$mresult = mysql_query($mquery);

	//echo("inserted: ". mysql_num_rows($result) . "row");
	
	if(!$nresult || !$mresult)
	{
		die("Invalid query: " . mysql_error() . "<br/>Query: " . $query);
	}
}


/*else
{
	$query = "INSERT INTO notifications (GTID, Notify_On) VALUES ('$gtid', '$switchon')";
	$result = mysql_query($query);
}

if(!$result)
{
	die("Invalid query: " . mysql_error() . "<br/>Query: " . $query);
} */

//if(!$result)
//{
// $query2 = "INSERT INTO notifications (GTID, Notify_On) VALUES ('$gtid', '$switchon')";
// $result2 = mysql_query($query2);
//	if(!$result2)
//	{
//		die("Invalid query: " . mysql_error() . "<br/>Query: " . $query2);
//	} 
//}

?>
