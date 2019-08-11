<?php

	include('../connect.php');

	if(isset($_POST['id']) && isset($_POST['classe']))
	{
		$q_insert_class = $bdd->prepare('INSERT INTO PrestigeClass (`ID_ClasseP`, `ClasseP`) VALUES (?, ?)');
		$q_insert_class->execute(array(strip_tags(strtoupper($_POST['id'])), strip_tags($_POST['classe'])));
		
		
		echo 'all ok';
		
	}