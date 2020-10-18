<?php

function salt($pass, $salt="7dy23kl6yw4bd9x0k3", $str="")
{
    $pass = str_replace(" ", "", $pass);
    $pass = strrev($pass);

    $arr[0] = strlen($pass);
    $arr[1] = strlen($salt);
    
    while($arr[0] > $arr[1] + 1)
    {
        $salt = $salt.$salt;
        $arr[1] = strlen($salt);
    }

    $split_len = floor(max($arr) / (min($arr) - 1));
    
    $salt = explode(" ", chunk_split($salt, $split_len, " "));
    array_pop($salt);
    $salt = array_reverse($salt);
    
    $j = $arr[0] > count($salt) ? $arr[0] : count($salt);
    
    for($i=0; $i<$j; $i++)
    {
        if(isset($pass{$i}))    $str .= $pass{$i};
        if(isset($salt[$i]))    $str .= $salt[$i];
    }
    
    return $str;
}
?>