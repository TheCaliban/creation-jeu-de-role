<?php

    require_once('../connect.php');

    if(isset($_POST['id']))
    {
        $id = strip_tags($_POST['id']);
        
        $q_select_skill = $bdd->prepare('SELECT Competence FROM Skill RIGHT JOIN SkillToClass ON SkillToClass.ID_Competence = Skill.ID_Competence WHERE ID_Classe = ?');
        
        $q_select_skill->execute(array($id));
        
        $arSkill = array();
        
        while($data_skill = $q_select_skill->fetch())
        {
            array_push($arSkill, $data_skill['Competence']);
        }
        
        echo json_encode($arSkill);
    }
    else
    {
        echo 'Missing argument';
    }
    exit;

?>