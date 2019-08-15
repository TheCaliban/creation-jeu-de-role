<?php

    include('../connect.php');

    if(isset($_POST['id']))
    {
        
        $q_delete_race = $bdd->prepare('DELETE FROM Race WHERE ID_Race = ?');
        
        $q_delete_race->execute(array(strip_tags(explode("-", $_POST['id'])[0])));
        
        $q_delete_race->closeCursor();
        
        echo "all is ok";
        exit;
    }
    
    echo "error";
    exit;

?>