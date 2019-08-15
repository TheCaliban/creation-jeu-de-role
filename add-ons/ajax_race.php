<?php

	include('../connect.php');

    if(isset($_POST['idRace']) && isset($_POST['race']) && isset($_POST['strenght']) && isset($_POST['dexterity']) && isset($_POST['constitution']) && isset($_POST['intelligence']) && isset($_POST['wisdom']) && isset($_POST['charisma']) && isset($_POST['level']) && isset($_POST['classe']) && isset($_POST['size']))
    {
        if($_POST['idRace'] == "" || strlen($_POST['idRace']) < 4 || $_POST['race'] == "")
        {
            echo "error idRace null or < 4";
            exit;
        }
        
        $class = ($_POST['classe'] == 'none') ? null : strip_tags($_POST['classe']);
        $id = strip_tags(strtoupper($_POST['idRace']));
        
        $q_insert_new_race = $bdd->prepare('INSERT INTO Race(ID_Race, Race, StrenghtAdjustement, DexterityAdjustement, ConstitutionAdjustement, IntelligenceAdjustement, WisdomAdjustement, CharismaAdjustement, LevelAdjustement, ID_Classe_Predilection, Size) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        
        $q_insert_new_race->execute(array(strip_tags($_POST['idRace']), strip_tags($_POST['race']), intval($_POST['strenght']), intval($_POST['dexterity']), intval($_POST['constitution']), intval($_POST['intelligence']), intval($_POST['wisdom']), intval($_POST['charisma']), intval($_POST['level']), $class, strip_tags($_POST['size'])));
        
        $q_insert_new_race->closeCursor();
        
        echo "all ok !";
        exit;
    }

    if(isset($_POST['id']) && isset($_POST['delete']))
    {
        $q_delete_race = $bdd->prepare('DELETE FROM Race WHERE ID_Race = ?');
        
        $q_delete_race->execute(array(strip_tags(explode("-", $_POST['id'])[0])));
        
        $q_delete_race->closeCursor();
        
        echo "Remove done";
    }

    if (isset($_POST['reload']))
    {
        try
        {
            $q_select_race = $bdd->query('SELECT ID_Race, Race, StrenghtAdjustement AS SA, DexterityAdjustement AS DA, ConstitutionAdjustement AS CA, IntelligenceAdjustement AS IA, WisdomAdjustement AS WA, CharismaAdjustement AS ChA, LevelAdjustement AS LA, ID_Classe_Predilection AS IDCP, Size FROM Race');


            $array_of_arrays = array();

            while($data_race = $q_select_race->fetch())
            {
                $idcp = ($data_race['IDCP'] != null) ? $data_race['IDCP'] : "none";

                array_push($array_of_arrays, array("id" => $data_race['ID_Race'],
                                                   "race" => $data_race['Race'],
                                                   "strenght" => $data_race['SA'],
                                                   "dexterity" => $data_race['DA'],
                                                   "constitution" => $data_race['CA'],
                                                   "intelligence" => $data_race['IA'],
                                                   "wisdom" => $data_race['WA'],
                                                   "charisma" => $data_race['ChA'],
                                                   "level" => $data_race['LA'],
                                                   "classe" => $idcp,
                                                   "size" => $data_race['Size']));
            }

            echo json_encode($array_of_arrays);

            $q_select_race->closeCursor();
        }
        catch(Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }
