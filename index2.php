<?php
	require_once("connection.php");
	$query = "SELECT * FROM notes";
	$notes = fetch_all($connection, $query);
	session_start();
	//$_SESSION['counter']=0;
	
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ajax Notes 2.0</title>
	<link media="all" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/smoothness/jquery-ui.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="style2.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script type="text/javascript">

	$(document).ready(function(){
		
		$('#test_form').on('submit', function(){			
			var form = $(this);			
			$.post(
				form.attr('action'),
	 			form.serialize(),
	 			function(data){	 				
	 				$('#all_notes').append(data.new_post);					
 					// delete_note();		
	 			},
	 			"json"
	 		);
			event.preventDefault();
	 	});

	 	$(document).on('click','.delete', function(){				
			var form = $(this);
			event.preventDefault();
			$.post(
				form.attr('action'),
	 			form.serialize(),
	 			function(data){	 				
	 				form.parent().remove();		
	 			},
	 			"json"
	 		);			 
			
	 	});

	 	$(document).on('submit','.update', function(){			
			
			var form = $(this);	
					
			$.post(
				form.attr('action'),
	 			form.serialize(),
	 			function(data){	 	 						
	 				$('#all_notes').html(data['html']);		
	 			},
	 			"json"
	 		);			 
		return false;	
	 	});
	});
	</script>

</head>
<body>
	
<h1>My Posts 234</h1>

<div id="all_notes">
<?php

	foreach ($notes as $note)
	{ ?>
	<div class="container">
		<div><p class="description"><?= $note['description'] ?></p></div>

		<form class="update" action="process2.php" method="post">
			<textarea name="note"><?= $note['note'] ?></textarea>			
			<input type="hidden" name="action" value="update"/>
			<input type="hidden" name="id" value="<?= $note['id'] ?>"/>
			<input type="submit" value="Update">
		</form>

		<form class="delete" id="delete" action="process2.php" method="post">
			<input type="hidden" name="delete_me" value="<?= $note['id'] ?>">
			<button>Delete</button>
		</form>
	</div>
<?php 
	}
?>
</div>

<h2>Add a note: </h2>
<form id="test_form" action="process2.php" method="post">
	<input type="text" id="description" name="description" placeholder="Title"/>
	<input type="hidden" name="action" value="create"/>
	<input type="hidden" name="id" value="<?= $note['id'] ?>"/>
	<textarea id="note" name="note"></textarea>
	<input type="submit" value="Post It!" />
</form>

</body>
</html>

