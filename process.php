<?php

require_once('connection.php');

$data = array();



if (isset($_POST['delete_me']))
{
	$id = intval($_POST['delete_me']);
	$query3 = "DELETE FROM notes 
	WHERE '{$id}' = id";
	mysqli_query($connection, $query3);

}

if (isset($_POST['note']))
{
	$query= "INSERT INTO notes(note, description, created_at, updated_at)
values('{$_POST['note']}', '{$_POST['description']}', NOW(), NOW())";

mysqli_query($connection, $query);
	
}

$query2 = "SELECT * FROM notes";
$notes = fetch_all($connection, $query2);
$data['html'] = "";

foreach ($notes as $note)
{ 

$data['html'] .= "<div class='container'>
	<div><p class='description'> {$note['description']} </p></div>
	<div class='note'> 
		{$note['note']}
	</div>
	<button class='delete'>Delete</button>
</div>";

};

echo json_encode($data);

//end of file