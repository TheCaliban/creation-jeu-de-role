<?php

require_once('../connect.php');

if(isset($_POST['id_character']))
{
	$q_classe = $bdd->prepare('SELECT Classe, ID_Classe FROM Class WHERE ID_Classe = (SELECT ID_Classe_Predilection FROM Race WHERE ID_Race = ?)');
    $q_classe->execute(array(strip_tags($_POST['id_character'])));
    
    if($data_classe = $q_classe->fetch())
    {
        echo "Classe de prédilection: " .$data_classe['Classe'];
    }
    else
    {
        echo "Ne possède aucune classe de prédilection";
    }
}
