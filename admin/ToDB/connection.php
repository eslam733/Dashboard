<?php

    $dsn = "mysql:host=localhost;dbname=shop";
    $user = "root";
    $pass = "";
    $option = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );
    $con = null;
    try{
        $con = new PDO($dsn, $user, $pass, $option);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e)
    {
        echo "DB Not Found";
    }

    // Check If UserID exsit
    function ifIDExDB($Id)
    {
        global $con;
        try{
            $stmt = $con->prepare("select UserID from users where UserID = ?");
            $stmt->execute(array($Id));
            if($stmt->rowCount()) return 1;
            else return 0;
        }catch(PDOException $e)
        {
            return 2;
        }
    }
    
    // Check If Username exsit
    function ifUserExDB($Username)
    {
        global $con;
        try{
            $stmt = $con->prepare("select Username from users where Username = ?");
            $stmt->execute(array($Username));
            if($stmt->rowCount()) return 1;
            else return 0;
        }catch(PDOException $e)
        {
            return 2;
        }
    }

    // get overview about total member & member & pendding & item & comments
    function overview()
    {
        global $con;
        try{
            $stmt = $con->prepare("select COUNT(Username) from users where GroupID = 0 AND Regstatus = 1");
            $stmt->execute();
            $active = $stmt->fetchColumn();
            
            $stmt = $con->prepare("select COUNT(Username) from users where GroupID = 0 AND Regstatus = 0");
            $stmt->execute();
            $pendding = $stmt->fetchColumn();
            
            return [$active, $pendding, 0, 0];
        }catch(PDOException $e)
        {
            return 2;
        }
    };

    //genrial query (lastest)
    function genrialQ($selectiom, $table, $order, $limit = 5)
    {
        global $con;
        try{
            $stmt = $con->prepare("select $selectiom from $table where GroupID = 0 ORDER BY $order LIMIT $limit");
            $stmt->execute();
            $data = $stmt->fetchAll();

            return $data;
        }catch(PDOException $e)
        {
            return "Error With Connection";
        }
    }
?>