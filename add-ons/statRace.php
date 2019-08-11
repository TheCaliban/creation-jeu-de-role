<?php

    include("../connect.php");

    if(isset($_POST['id']))
    {
        
        $id = $_POST['id'];
        
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
        
    }
    else
    {
        echo json_encode(array("Erreur", "Erreur", "Erreur", "Erreur", "Erreur", "Erreur"));
    }
    exit;

?>