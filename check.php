<?php
session_start();
if(!isset($_SESSION['session_id'])){
header("location: " . 'login.php?error=nosess');
}

include 'conn.php';

$q1 = "
        SELECT
            id
        FROM
            sessions
        WHERE
            session_id = '".$_SESSION['session_id']."'
        AND
            user_ip = '".$_SERVER['REMOTE_ADDR']."'
        AND
            user_id = '".$_SESSION['user_id']."'
        ";

            if(!$r1 = $Mysqli->query($q1))
        {
        
            echo 'Er is een fout opgetreden!. '. $Mysqli->error;
        
        }
        
        elseif($Mysqli->affected_rows == 0)
                {
                //sessie niet gevonden
                header("location: " . 'login.php?error=sess');
                }
                ?>