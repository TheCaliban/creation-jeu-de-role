<?php

	require_once('../connect.php');
	
	if(isset($_POST['id_classe']) && isset($_POST['data']))
	{
		
		$q_insert_skills = $bdd->prepare('INSERT INTO SkillToClass (ID_Classe, ID_Competence) VALUES(?, ?)');
		
		$data = json_decode(stripslashes($_POST['data']));
		
		foreach($data as $d)
		{
			$q_insert_skills->execute(array($_POST['id_classe'], $d));
		}
		
		echo "Vos entrées ont bien été faites !";
	}