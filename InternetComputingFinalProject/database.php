<?php
    $dsn = 'mysql:host=localhost;dbname=notcanvas';
    $username = "canvas_manager";//database username
    $password = "notcanvas";//database password
    $db = new PDO($dsn, $username, $password);

    try { 
        $db = new PDO($dsn, $username, $password); 
    } catch (PDOException $e) { 
        $error_message = $e->getMessage(); 
        include('database_error.php'); 
        exit(); 
    } 
?>