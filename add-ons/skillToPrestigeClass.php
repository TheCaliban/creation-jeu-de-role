<?php

    require_once('../connect.php');

    if(isset($_POST['id_character']))
    {
        $q_select_skills = $bdd->prepare('SELECT ID_Competence, Competence, Carac_Competence FROM Skill WHERE ID_Competence IN (SELECT ID_Competence FROM SkillToPrestigeClass WHERE ID_Classe = ?)');   
        $q_select_skills->execute(array(strip_tags($_POST['id_character'])));
    
        echo '<ul>
                <li class="list-group-item bg-secondary">
                    <div class="row justify-content-around">
                        <div class="col-1">#</div>
                        <div class="col-6">Libellé</div>
                        <div class="col-1">Carac.
                    </div>
                </li>';
                
        if($data_skills = $q_select_skills->fetch())
        {

            echo '<li class="list-group-item">
                    <div class="row justify-content-around">
                        <div class="col-1">' .$data_skills['ID_Competence']. '</div>
                        <div class="col-6">' .$data_skills['Competence']. '</div>
                        <div class="col-1">
                            <strong>' .$data_skills['Carac_Competence']. '</strong>
                        </div>
                    </div>
                </li>';
                
            while($data_skills = $q_select_skills->fetch())
            {
                echo '<li class="list-group-item">
                                    <div class="row justify-content-around">
                                        <div class="col-1">' .$data_skills['ID_Competence']. '</div>
                                        <div class="col-6">' .$data_skills['Competence']. '</div>
                                        <div class="col-1">
                                            <strong>' .$data_skills['Carac_Competence']. '</strong>
                                        </div>
                                    </div>
                                </li>';
            }
            
        }
        else
        {
            echo '<li class="list-group-item">
                        <div class="row justify-content-around">
                            Aucune compétence
                        </div>
                    </li>';
        }

        echo '</ul>';
    }


?>
