<?php

    require_once('../connect.php');

    session_start();

    if(isset($_POST['user']) && isset($_POST['pass']))
    {
        $user = strip_tags($_POST['user']);
        $pass = sha1(strip_tags($_POST['pass']));
        
        
        $q_verif_pass = $bdd->prepare('SELECT COUNT(*) FROM user WHERE username = ? AND password = ?');
        
        $q_verif_pass->execute(array($user, $pass));
        
        if($q_verif_pass->fetch()[0] == 1)
        {
            $_SESSION['login'] = true;
            $_SESSION['user'] = $user;
            echo 'Connected';
        }
        else
        {
            echo 'Wrong arguments';
        }
        exit;
        
        
    }
    else
    {
        echo 'Missing argument';
    }
    exit;