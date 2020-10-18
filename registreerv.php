<?php

//Defineer functie
function error($link)
{
header('Refresh: 3; url=' . $link.php . '');
}

if($_SERVER['REQUEST_METHOD'] == 'POST') // Controle of er op de knop is geklikt.
{
    include_once 'connect.php'; // Connectie db.

    if(!empty($_POST['gebruikersnaam']) AND !empty($_POST['password']) AND !empty($_POST['passwordc']) AND !empty($_POST['mail'])) // Controle op invoeren
    {
        if(($_POST['password']) == ($_POST['passwordc'])) // Controle of controle pw overeenkomt met echte pw.
        {
            
            include_once 'uwx3g.php';            // Connectie met salt page.
            $gebruikersnaam    = mysql_real_escape_string($_POST['gebruikersnaam']); //Data veilig maken voor sql injectie d.m.v. mysql_real.....
            $password        = sha1(salt($_POST['password'])); //sha1 hash van pass. Inclusief salt.
            $mail            = mysql_real_escape_string($_POST['mail']);
            $sql = ("SELECT gebruikersnaam FROM gebruikers WHERE gebruikersnaam='". $gebruikersnaam . "'"); // Controle op gebruikersnaam, zo ja een 1 else en 0 (zie controle bij de volgende if)
            $uitvoer = mysql_query($sql);        //($row = mysql_fetch_assoc($get))
            
            $controle = mysql_num_rows($uitvoer);
                
            if($controle == 0) // Als uitvoer is 0 registreren.
            {
                mysql_query("INSERT INTO gebruikers (id, gebruikersnaam, password, mail, datum) VALUES ('','" . $gebruikersnaam . "', '" . $password . "', '" . $mail . "', '" . now() . "')"); // Gebruiker in db plaatsen.
                header('Refresh: 4; url=login.php');
                exit ('U bent succesvol aangemeld, u kunt nu inloggen.');
            }
            else
            {
                header('Refresh: 2; url=registreren.php');
                exit ('Verkeerde gebruikersnaam of wachtwoord.');        // Negatieve melding van ingevoerde gegevens.
            }    
        }
        else
        {
            error(registreren.php);
            exit ('De ingevoerde gegevens kloppen niet, u heeft het controle wachtwoord verkeerd ingevuld.');  // Negatieve melding van ingevoerde gegevens.
        }
    }
    else
    {
        error(registreren.php);
        exit ('De ingevoerde gegevens kloppen niet, niet alles is ingevuld.');  // Negatieve melding van ingevoerde gegevens.
    }
    
    

}
else
{
    error(registreren.php);
    exit ('U bent op de verkeerde pagina gekomen, U wordt doorverwezen.');
}

?>