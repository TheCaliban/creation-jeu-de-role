<?php

	include('../connect.php');

	if((isset($_POST['id']) && isset($_POST['classe']) && isset($_POST['savRef']) && isset($_POST['savVig']) && isset($_POST['savVol']) && isset($_POST['dv']) && isset($_POST['modAtq']) && isset($_POST['ptsSkills'])) && !empty($_POST['id']) && !empty($_POST['ptsSkills']) && !empty($_POST['classe']) && !empty($_POST['modAtq'])) 
	{
		$q_insert_class = $bdd->prepare('INSERT INTO Class (`ID_Classe`, `Classe`, `Sauvegarde_Reflexe`, `Sauvegarde_Vigueur`, `Sauvegarde_Volonte`, `DV`, `Modif_attaque`, `Point_Competence`) 
					   VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
		$q_insert_class->execute(array(strip_tags(strtoupper($_POST['id'])), strip_tags(utf8_decode($_POST['classe'])), intval($_POST['savRef']), intval($_POST['savVig']), intval($_POST['savVol']), intval($_POST['dv']), intval($_POST['modAtq']), intval($_POST['ptsSkills'])));
		
		
		echo 'all ok';
		
	}
?>
