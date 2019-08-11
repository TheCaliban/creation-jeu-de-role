<?php

	include('../connect.php');

	if(isset($_POST['featType']))
	{
		$q_select_feat = $bdd->prepare('SELECT max(ID_Feat) as MAXI FROM Feat WHERE FeatType = ?');
		
		$q_select_feat->execute(array(strip_tags($_POST['featType'])));
		
		
		if($data_feat = $q_select_feat->fetch())
		{
			echo $data_feat['MAXI'];
		}
		
		
		$q_select_feat->closeCursor();
	}


?>
