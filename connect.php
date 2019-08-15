<?php

    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=jdr;charset=utf8', 'website', '5QBBo7X3Z6KFSMJp',  array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

?>