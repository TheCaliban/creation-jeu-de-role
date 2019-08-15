<?php

    require_once('../connect.php');

    if(isset($_POST['id_character']) && $_POST['predilection'])
    {
        $q_classe = $bdd->prepare('SELECT Classe, ID_Classe FROM Class WHERE ID_Classe = (SELECT ID_Classe_Predilection FROM Race WHERE ID_Race = ?)');
        $q_classe->execute(array(strip_tags($_POST['id_character'])));

        if($data_classe = $q_classe->fetch())
        {
            echo "Classe de prédilection: " .$data_classe['Classe'];
        }
        else
        {
            echo "Ne possède aucune classe de prédilection";
        }
        
        $q_classe->closeCursor();
    }

	if(isset($_POST['id']) && $_POST['level'])
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
        
        $q_select_level_prestige_class->closeCursor();
	}

    if(isset($_POST['id']) && isset($_POST['skill']))
    {
        $id = strip_tags($_POST['id']);
        
        $q_select_skill = $bdd->prepare('SELECT Competence FROM Skill RIGHT JOIN SkillToClass ON SkillToClass.ID_Competence = Skill.ID_Competence WHERE ID_Classe = ?');
        
        $q_select_skill->execute(array($id));
        
        $arSkill = array();
        
        if($q_select_skill->rowCount() > 0)
        {
            
            while($data_skill = $q_select_skill->fetch())
            {
                array_push($arSkill, $data_skill['Competence']);
            }
        }
        
        echo json_encode($arSkill);
        $q_select_skill->closeCursor();
        
    }

    if(isset($_POST['id']) && isset($_POST['stat']))
    {
        $id = intval($_POST['id']);
        
        $q_select_race = $bdd->prepare('SELECT StrenghtAdjustement AS SA, DexterityAdjustement AS DA, ConstitutionAdjustement AS CA, IntelligenceAdjustement AS IA, WisdomAdjustement AS WA, CharismaAdjustement AS Cha FROM Race WHERE ID_Race = ?');
        
        $q_select_race->execute(array($id));
        
        if($data_race = $q_select_race->fetch())
        {
            echo json_encode(array($data_race['SA'], $data_race['DA'], $data_race['CA'], $data_race['IA'], $data_race['WA'], $data_race['Cha']));
        }
        else
        {
            echo json_encode(array(0, 0, 0, 0, 0, 0));
        }
        
        $q_select_race->closeCursor();
    }
/*
    else
    {
        echo json_encode(array("Erreur", "Erreur", "Erreur", "Erreur", "Erreur", "Erreur"));
    }
*/
