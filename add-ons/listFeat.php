<?php
	
	include('../connect.php');
	
	if(isset($_POST['ID_Feat']) && isset($_POST['FeatType']))
	{
		$id = intval($_POST['ID_Feat']);
		$type = strip_tags($_POST['FeatType']);
		
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
	}
	
	echo 'No id_feat, feattype';