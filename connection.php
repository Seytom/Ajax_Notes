<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_DATABASE', 'ajax_notes');

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);

if(mysqli_connect_errno())
{
	echo "error connecting to database:<br>";
	echo mysqli_connect_errno();
}

function fetch_all($connection, $query)
{
	$data = array();
	$result = mysqli_query($connection, $query);	
	while($row = mysqli_fetch_assoc($result))
	{
		$data[] = $row;
	}

	return $data;
}

//fetch the first record obtained from the query
function fetch_record($connection, $query)
{
	$result = mysqli_query($connection, $query);
	return mysqli_fetch_assoc($result);
}

?>