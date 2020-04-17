<?php

// set title all sites have title var or set default


function set_title()
{
    global $title_page;
    if(isset($title_page))
    {
        echo $title_page;
    }else{
        echo "Default";
    }
}

// check data is not empty

function vailtation($user, $full, $email, $pass = "..")
{
    $err = ["true"];
    if($user == "" || strlen($user) > 20)
    {
       $err[0] = false;
       array_push($err ,'UserName Incorrect');
    }
    if($email == "" || !strpos($email, "@") || !strpos($email, ".") || strlen($email) > 30)
    {
       $err[0] = false;
       array_push($err ,'incorrect email');
    }
    if($full == "" || strlen($full) > 20)
    {
       $err[0] = false;
       array_push($err ,'FUll Name Incorrect');
    }
    if($pass != ".." && ($pass == "" || strlen($pass) > 20 || strlen($pass) < 8))
    {
        $err[0] = false;
        array_push($err ,'incorrect password');
    }

    return $err;
}

