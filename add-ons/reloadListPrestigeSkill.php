<?php

    require_once('../connect.php');

    if(isset($_POST['ID_Classe']))
    {
        $q_select_skills = $bdd->prepare('SELECT ID_Competence, Competence FROM Skill WHERE ID_Competence NOT IN (SELECT ID_Competence FROM SkillToPrestigeClass WHERE ID_Classe = ?)');
        $q_select_skills->execute(array(strip_tags($_POST['ID_Classe'])));
        
        while($data_skills = $q_select_skills->fetch())
        {
            echo utf8_encode('<div class="form-check">
                      <input class="form-check-input checkbox_list" type="checkbox" value="' .$data_skills['ID_Competence']. '" id="checkBox_' .$data_skills['ID_Competence']. '">
                      <label class="form-check-label" for="checkBox_' .$data_skills['ID_Competence']. '">'
                        .$data_skills['Competence'].
                      '</label>
                    </div>');
        }
        echo '<br/><br/><button class="btn btn-dark" id="addSkills" onClick="getCheckedCheckbox()">Ajouter des compétences</button>';
    }


?>
