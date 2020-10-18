<?php
session_start();

include 'conn.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $login_user = $Mysqli->real_escape_string($_POST['gebruikersnaam']);
        $login_pass = $Mysqli->real_escape_string(sha1($_POST['wachtwoord']));
        $user_ip = $_SERVER['REMOTE_ADDR'];
        srand ((double) microtime( )*1000000);
        $session_id = rand(1000,1000000);
 
        $q1 = "
        SELECT
            id,
            username,
            block
        FROM
            users
        WHERE
            username = '".$login_user."'  
        AND
            password = '".$login_pass."'
        ";

            if(!$r1 = $Mysqli->query($q1))
        {
        
            echo 'Er is een fout opgetreden!. '. $Mysqli->error;
        
        }
                                        
                                
                elseif($Mysqli->affected_rows == 1)
                {
    

                                while ($row = $r1->fetch_assoc ())
                                {
                                
                                        $_SESSION["username"] = $row['username'];
                                        $_SESSION['user_id'] = $row['id'];  
                                        $_SESSION['user_ip'] = $user_ip;
                                        $_SESSION['session_id'] = $session_id;
                                              
                                    if ($row['block'] == 1)
                                    {
                                        echo 'Je bent geblokkeerd, je kunt niet meer inloggen!';
                                    }
                                        else
                                        {
                                            //Inloggen gelukt!!
                                            header("location: " . 'index.php?msg=succes');
                                        }

                                
    
    
                    $q2 = "
                    INSERT INTO
                        sessions
                    (
                        user_id,
                        session_id,
                        user_ip
                    )
                    VALUES
                    (
                        '".$row['id']."',
                        '".$session_id."',
                        '".$user_ip."'
                    )
                    ";
                                }

                                    if (!$Mysqli->query ($q2) )
                                    {
                                    
                                        echo 'Er is een fout opgetreden!'. $Mysqli->error;
                                    
                                    }
                                



                }
                    else
                    {  
                        echo 'Gebruikersnaam of wachtwoord onjuist, probeer het opnieuw!';
                    }  
          
    }
        else
        {
            ?>
                <html>
                <head>
                <title>Login</title>
                </head>
                <body>
                <h2>Login</h2>
                
                <?php
                    if(isset($_GET['error']))
                    {
                        if($_GET['error'] == 'sess')
                        {
                            echo 'De sessie is ongeldig! Log aub opnieuw in!<p>';
                        }
                    }
                ?>
                    <form method='post'>  
                                <table>  
                                    <tr>  
                                        <td>Gebruikersnaam:</td>  
                                        <td><input type='text' name='gebruikersnaam'></td>  
                                    </tr>  
                                    <tr>  
                                        <td>Wachtwoord:</td>  
                                        <td><input type='password' name='wachtwoord'></td>  
                                    </tr>  
                                    <tr>  
                                        <td><input type='submit' name='submit' value='Login'></td>  
                                    </tr>  
                                </table>  
                    </form>
                      
                </body>
                </html>          
        <?php
        }  
        ?>