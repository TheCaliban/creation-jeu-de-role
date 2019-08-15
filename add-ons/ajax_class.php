<?php

	include('../connect.php');

    if((isset($_POST['id']) && isset($_POST['classe']) && isset($_POST['savRef']) && isset($_POST['savVig']) && isset($_POST['savVol']) && isset($_POST['dv']) && isset($_POST['modAtq']) && isset($_POST['ptsSkills'])) && !empty($_POST['id']) && !empty($_POST['ptsSkills']) && !empty($_POST['classe']) && !empty($_POST['modAtq'])) 
	{
		$q_insert_class = $bdd->prepare('INSERT INTO Class (`ID_Classe`, `Classe`, `Sauvegarde_Reflexe`, `Sauvegarde_Vigueur`, `Sauvegarde_Volonte`, `DV`, `Modif_attaque`, `Point_Competence`) 
					   VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
		$q_insert_class->execute(array(strip_tags(strtoupper($_POST['id'])), strip_tags(utf8_decode($_POST['classe'])), intval($_POST['savRef']), intval($_POST['savVig']), intval($_POST['savVol']), intval($_POST['dv']), intval($_POST['modAtq']), intval($_POST['ptsSkills'])));
		
        $q_insert_class->closeCursor();
		
		echo "Insert done";
		
	}

	if(isset($_POST['id_classe']) && isset($_POST['data']))
	{
		
		$q_insert_skills = $bdd->prepare('INSERT INTO SkillToClass (ID_Classe, ID_Competence) VALUES(?, ?)');
		
		$data = json_decode(stripslashes($_POST['data']));
		
		foreach($data as $d)
		{
			$q_insert_skills->execute(array($_POST['id_classe'], $d));
		}
		
        $q_insert_skills->closeCursor();
        
		echo "Vos entrées ont bien été faites !";
	}

    if(isset($_POST['id_character']))
    {
        $q_select_skills = $bdd->prepare('SELECT ID_Competence, Competence, Carac_Competence FROM Skill WHERE ID_Competence IN (SELECT ID_Competence FROM SkillToClass WHERE ID_Classe = ?)');   
        $q_select_skills->execute(array(strip_tags($_POST['id_character'])));
        
        echo '<br/><br/><br/>';
        
        echo '<ul class="list-group">
                <li class="list-group-item bg-secondary">
                    <div class="row justify-content-around">
                        <div class="col-1">#</div>
                        <div class="col-6">Libellé</div>
                        <div class="col-3 col-lg-1 col-md-1">Carac.
                    </div>
                </li>';
        
        
        if($data_skills = $q_select_skills->fetch())
        {

            echo '<li class="list-group-item">
                    <div class="row justify-content-around">
                        <div class="col-1">' .$data_skills['ID_Competence']. '</div>
                        <div class="col-6">' .$data_skills['Competence']. '</div>
                        <div class="col-3 col-lg-1 col-md-1">
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
                                        <div class="col-3 col-lg-1 col-md-1">
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

    if(isset($_POST['ID_Classe']))
    {
        $q_select_skills = $bdd->prepare('SELECT ID_Competence, Competence FROM Skill WHERE ID_Competence NOT IN (SELECT ID_Competence FROM SkillToClass WHERE ID_Classe = ?)');
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
	

