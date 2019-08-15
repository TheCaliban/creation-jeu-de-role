<?php

	include('../connect.php');

    if(isset($_POST['ID_Feat']) && isset($_POST['featType']))
	{
		$id = intval($_POST['ID_Feat']);
		$type = strip_tags($_POST['featType']);
		
		$q_select_feat = $bdd->prepare('SELECT ID_Feat, FeatType, SpellLevel, Feat, Description, WarriorTaken, MultipleTakeCumulative, MultipleTakeNonCumulative 
					   FROM Feat WHERE ID_Feat = ? AND FeatType = ?');
					   
		$q_select_feat->execute(array($id, $type));
		
		if($data_feat = $q_select_feat->fetch())
		{
			$wa = ($data_feat['WarriorTaken'] == 0) ? 'Faux' : 'Vrai';
			$mtc = ($data_feat['MultipleTakeCumulative'] == 0) ? 'Faux' : 'Vrai';
			$mtnc = ($data_feat['MultipleTakeNonCumulative'] == 0) ? 'Faux' : 'Vrai';
			$spellLevel = ($data_feat['SpellLevel'] == null) ? "" : "<br/>Niveau du sort: " .$data_feat['SpellLevel']. "<br/>";
			
			echo '<span>'.$data_feat['ID_Feat'].' - '.$data_feat['FeatType'].'</span><br/><span>'.$spellLevel.'</span><br/><span>'.$data_feat['Feat'].'</span><br/><span>' .$data_feat['Description']. '</span><br/><br/><span>WT: ' .$wa	. '<br/>MTC: ' .$mtc. '<br/>MTNC: ' .$mtnc. '</span>';
		}
		else
		{
			echo 'Aucune entrée trouvée !';
		}
        
        $q_select_feat->closeCursor();
	}

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
		
		echo "Insert done";
	}

	if(isset($_POST['featType']) && isset($_POST['reload']))
	{
		$q_select_feat = $bdd->prepare('SELECT max(ID_Feat) as MAXI FROM Feat WHERE FeatType = ?');	
		$q_select_feat->execute(array(strip_tags($_POST['featType'])));

		if($data_feat = $q_select_feat->fetch())
		{
			echo $data_feat['MAXI'];
		}
		
		$q_select_feat->closeCursor();
	}

