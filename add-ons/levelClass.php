<?php
	include('../connect.php');

	if(isset($_POST['id']))
	{
		$id = intval($_POST['id']);
		
		$q_select_level_prestige_class = $bdd->prepare('SELECT MaxLevel FROM PrestigeClass WHERE ID_ClasseP = ?');
		
		$q_select_level_prestige_class->execute(array($id));
				
		if($id == -1)
		{
			echo '<option value="0">0</option>';
		}
		elseif($data_level = $q_select_level_prestige_class->fetch())
		{
			for($i = 1; $i < $data_level['MaxLevel'] + 1; $i++)
			{
				echo '<option value="' .$i. '">' .$i. '</option>';
			}
		}
		
		
	}


?>
