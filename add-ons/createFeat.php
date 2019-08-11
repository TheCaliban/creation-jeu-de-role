<?php
	
	include('../connect.php');
	
	if(isset($_POST['id']) && isset($_POST['type']) && isset($_POST['level']) && isset($_POST['label']) && isset($_POST['description']) && isset($_POST['wt']) && isset($_POST['mtc']) && isset($_POST['mtnc']))
	{
		$id = intval($_POST['id']);
		$type = strip_tags($_POST['type']);
		$level = intval($_POST['level']);
		$label = strip_tags($_POST['label']);
		$description = strip_tags($_POST['description']);
		$wt = intval($_POST['wt']);
		$mtc = intval($_POST['mtc']);
		$mtnc = intval($_POST['mtnc']);
		
		$q_insert_feat = $bdd->prepare('INSERT INTO Feat(ID_Feat, FeatType, SpellLevel, Feat, Description, WarriorTaken, MultipleTakeCumulative, MultipleTakeNonCumulative) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
		
		$q_insert_feat->execute(array($id, $type, $level, $label, $description, $wt, $mtc, $mtnc));
		
		$q_insert_feat->closeCursor();
		
		echo "all is ok";
		exit;
	}
	exit;


?>
