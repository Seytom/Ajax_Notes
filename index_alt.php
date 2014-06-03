<?php
	require_once("connection.php");
	$query = "SELECT * FROM notes";
	$notes = fetch_all($connection, $query);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ajax Notes</title>
	<link media="all" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/smoothness/jquery-ui.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script type="text/javascript">

	function delete_note(){
		$('.delete').click(function(){
				
				
				alert("It works!");

				
			});
	}

	$(document).ready(function(){

		delete_note();
		 	
		$('#test_form').submit(function(){
			var note= $('#note').val();
			var description= $('#description').val();

			
			
	 		$.post(
	 			$(this).attr('action'),
	 			$(this).serialize(),
	 			function(data){
	 				if(data.status=="success")
 					{
 						$('#notes').append("<div><p class='description'>"+description+"</p></div><div class='note'>"+note+"</div><button class='delete' value = 'delete'>delete</button>");
 						delete_note();
 						// <button value = 'delete'>delete</button>
							// 				<div><p class='description'>"+description+"</p></div>

 					}
	 						
	
	 			},
	 			"json"
	 		);
			return false;
	 	});
	});

	</script>

	


</head>
<body>
	
<h1>My Posts</h1>

<div id="notes">
<?php
	foreach ($notes as $note)
	{ ?>
	<div class="container">
		<div><p class="description"><?= $note['description'] ?></p></div>
		<div class="note"> 

			
			<?= $note['note'] ?>
		</div>
		<button class="delete">Delete</button>
	</div>
<?php 
	}
?>
</div>

<h2>Add a note: </h2>
<form id="test_form" action="process.php" method="post">
	<input type="text" id="description" name="description" value="Description"/>
	<textarea id="note" name="note"></textarea>
	<input type="submit" value="Post It!" />
</form>

</body>
</html>
