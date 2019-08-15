<?php

	require_once('../connect.php');
	
	if(isset($_POST['id_classe']) && isset($_POST['data']))
	{
		
		$q_insert_skills = $bdd->prepare('INSERT INTO SkillToPrestigeClass (ID_Classe, ID_Competence) VALUES(?, ?)');
		
		$data = json_decode(stripslashes($_POST['data']));
		
		foreach($data as $d)
		{
			$q_insert_skills->execute(array($_POST['id_classe'], $d));
		}
		
		echo "Vos entrées ont bien été faites !";
	}

	if(isset($_POST['id']) && isset($_POST['classe']))
	{
		$q_insert_class = $bdd->prepare('INSERT INTO PrestigeClass (`ID_ClasseP`, `ClasseP`) VALUES (?, ?)');
		$q_insert_class->execute(array(strip_tags(strtoupper($_POST['id'])), strip_tags($_POST['classe'])));
		
		
		echo 'all ok';
		
	}

    if(isset($_POST['ID_Classe']))
    {
        $q_select_skills = $bdd->prepare('SELECT ID_Competence, Competence FROM Skill WHERE ID_Competence NOT IN (SELECT ID_Competence FROM SkillToPrestigeClass WHERE ID_Classe = ?)');
        $q_select_skills->execute(array(strip_tags($_POST['ID_Classe'])));
        
        while($data_skills = $q_select_skills->fetch())
        {
            echo '<div class="form-check">
                      <input class="form-check-input checkbox_list" type="checkbox" value="' .$data_skills['ID_Competence']. '" id="checkBox_' .$data_skills['ID_Competence']. '">
                      <label class="form-check-label" for="checkBox_' .$data_skills['ID_Competence']. '">'
                        .$data_skills['Competence'].
                      '</label>
                    </div>';
        }
        echo '<br/><br/><button class="btn btn-dark" id="addSkills" onClick="getCheckedCheckbox()">Ajouter des compétences</button>';
    }

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
