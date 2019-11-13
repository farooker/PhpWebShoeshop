<?php
$servername = "localhost";
$username = "root";
$password = "";
$CHAR_SET = "charset=utf8";

try {
    $conn = new PDO("mysql:host=$servername;dbname=shoeshop;".$CHAR_SET,$username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET names utf8");
    // echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    // echo "Connection failed: " . $e->getMessage();
    }

?>
