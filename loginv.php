<?php
session_start();
if( $_SERVER['REQUEST_METHOD'] == 'POST')        // Controle of er op de knop is gedrukt.
{
          
    if(!empty($_POST['gebruikersnaam']) AND !empty($_POST['password'])) // Controle of alles is ingevult.
    {
        include_once 'connect.php';            // Connectie met database.
        include_once 'uwx3g.php'; // Connectie salt page.

        $gebruikersnaam    = mysql_real_escape_string($_POST['gebruikersnaam']);  // Gevaren voor sql injectie weren dmv. mysql_real_.......
        $password        = sha1(salt($_POST['password']));  // Hash en Salting van pw.
        $sql = ("SELECT gebruikersnaam, password FROM gebruikers WHERE gebruikersnaam='". $gebruikersnaam . "' AND password='" . $password . "'"); // Selecteer user waar de gebruiker overeenkomt met ingevoerde pas
        $uitvoer = mysql_query($sql);
        
        $controle = mysql_num_rows($uitvoer); //Uitvoer van inlog
            if($controle != 0)
            {
                //VERDERE VERWERKING. (DIT is aanjou, bijv. sessie ofziets?
            }
            else
            {
                header('Refresh: 2; url=login.php');
                exit ('Verkeerde gebruikersnaam of wachtwoord.');        // Negatieve melding van ingevoerde gegevens.
            }            
    }
    else
    {
        header('Refresh: 2; url=login.php');
        exit ('U heeft een van de gegevens niet goed ingevuld.');        // Negatieve melding van ingevoerde gegevens.
    }  
}
else
{
    header('Refresh: 2; url=login.php'); // Negatief op de verwerk pagina gekomen, direct terug verwijzen met gepaste melding.
    exit ('U bent op de verkeerde pagina gekomen, u wordt doorverwezen.');
}
?>