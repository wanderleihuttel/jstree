<?php
    
    // PDO Connection
    try{
        $host = "192.168.1.90";
        $port = "3306";
        $username = "root";
        $password = "";
        $dbname = "intranet";
        
        $dsn = "mysql:dbname=${dbname};host=${host};port=${port};charset=utf8;";
        
        $options = array (
            PDO::ATTR_CASE => PDO::CASE_LOWER,
            PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        $pdo = new PDO($dsn, $username, $password,$options);

    } catch(PDOException $e){
        echo $e->getMessage();
    }
