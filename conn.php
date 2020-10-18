<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

    $db['host']                 = 'localhost';
    $db['gebruikersnaam']         = 'root';
    $db['wachtwoord']             = '';
    $db['database']             = 'easydrive';
    
    $Mysqli = new mysqli($db['host'], $db['gebruikersnaam'], $db['wachtwoord'], $db['database']);
    
        if(mysqli_connect_errno())
        {
            echo 'Fout bij verbinding: '.$Mysqli->error;
        }
    
    ?>