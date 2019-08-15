<?php
    
    include('../connect.php');

    if(isset($_POST['ID_Race']) && isset($_POST['Race']) && isset($_POST['SA']) && isset($_POST['DA']) && isset($_POST['CA']) && isset($_POST['IA']) && isset($_POST['WA']) && isset($_POST['ChA']) && isset($_POST['LA']) && isset($_POST['IDCP']) && isset($_POST['Size']))
    {
        
        $idcp = ($_POST['IDCP'] != "" && $_POST['IDCP'] != null) ? strip_tags($_POST['IDCP']) : null;
        $size = strip_tags(($_POST['Size']));
        
        $q_update_race = $bdd->prepare('UPDATE Race SET StrenghtAdjustement = ?, DexterityAdjustement = ?, ConstitutionAdjustement = ?, IntelligenceAdjustement = ?, WisdomAdjustement = ?, CharismaAdjustement = ?, LevelAdjustement = ?, ID_Classe_Predilection = ?, Size = ? WHERE ID_Race = ?');
        
        $q_update_race->execute(array(intval($_POST['SA']), intval($_POST['DA']), intval($_POST['CA']), intval($_POST['IA']), intval($_POST['WA']), intval($_POST['ChA']), intval($_POST['LA']), $idcp, $size, strip_tags($_POST['ID_Race'])));
        
        $q_update_race->closeCursor();
        
        echo 'all is ok';
        exit;
        
    }
    echo "rate";
    exit;

?>