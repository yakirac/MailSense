<?php

ini_set('display_errors', 1);

include 'dbparams.php';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to MySQL server');

mysql_select_db($dbname);

$query = "SELECT cell FROM mailboxes WHERE box = '123'";
$result = mysql_query($query);

if(!$result)
{
	die("Invalid query: " . mysql_error() . "<br/>Query: " . $query);
}

//echo $result;
echo mysql_num_rows($result);


?>
