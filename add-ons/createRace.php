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
    echo 'error';

?>