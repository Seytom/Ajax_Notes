<?php

require_once('connection.php');

session_start();
$data = array();


if (isset($_POST['delete_me']))
{
	$id = intval($_POST['delete_me']);
	$query3 = "DELETE FROM notes 
	WHERE id ='{$id}'";
	mysqli_query($connection, $query3);
	//$_SESSION['counter'] += 1;	
}
else if (isset($_POST['action']) & $_POST['action'] == 'create')
{
	$query= "INSERT INTO notes (note, description, created_at, updated_at)
values('{$_POST['note']}', '{$_POST['description']}', NOW(), NOW())";

	mysqli_query($connection, $query);
	//$_SESSION['counter'] += 1;	
	$data['new_post']= "<div class='container'>
	 	<div><p class='description'> {$_POST['description']} </p></div>
	 	<form class='update' action='process2.php' method='post'>
				<textarea name='note'>{$_POST['note']} </textarea>
				<input type='submit' value='Update'>
				<input type='hidden' name='action' value='update'/>
				<input type='hidden' name='id' value='{$_POST['id']}'/>
			</form>

			<form class='delete' id='delete' action='process2.php' method='post'>
				<input type='hidden' name='delete_me' value='{$_POST['id']}'/>
				<button class='delete'>Delete</button>
			</form>
		</div>";
	
}
else if(isset($_POST['action']) & $_POST['action'] == 'update')
{
	//if ($_SESSION['counter']>0)
	var_dump($_POST);
	$query= "UPDATE notes SET note = '{$_POST['note']}' WHERE id = {$_POST['id']}";
	mysqli_query($connection, $query);
	//$_SESSION['counter'] += 1;	
}
	$query2 = "SELECT * FROM notes";
	$notes = fetch_all($connection, $query2);
	$data['html'] = "";


	foreach ($notes as $note)
	{ 

	$data['html'] .= "<div class='container'>
	 	<div><p class='description'>" . $note['description']  . "</p></div>
	 	<form class='form' action='process2.php' method='post'>
				<textarea name='note'>".$note['note'] . "</textarea>
				<input type='submit' value='Update'>
				<input type='hidden' name='action' value='update'/>
				<input type='hidden' name='id' value='" . $note['id'] ."'/>
			</form>

			<form class='delete' id='delete' action='process2.php' method='post'>
				<input type='hidden' name='delete_me' value='" . $note['id']. "'/>
				<button class='delete'>Delete</button>
			</form>
		</div>";
	}
	$data['html'] .="</div>";
	echo json_encode($data);
	$data = null;
	








