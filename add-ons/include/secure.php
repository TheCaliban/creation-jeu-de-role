<?php

    session_start();

    if(!isset($_SESSION['login']) || $_SESSION['user'] == '')
    {
        header('Location: /');
        exit;
    }


?>