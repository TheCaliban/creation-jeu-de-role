<?php

    include('../connect.php');

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

    exit;

?>  
