<?php

$servername = "localhost";
$username = "root";
$password = "";
$CHAR_SET = "charset=utf8";

try {
    $conn = new PDO("mysql:host=$servername;dbname=shoesshop;".$CHAR_SET,$username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET names utf8");
  
        $name=$_POST['name'];
        $price=$_POST['price'];
        $brand=$_POST['brand'];
        $category=$_POST['category'];

        $sql="INSERT INTO `product`(`product_name`, `product_price`, `product_brandID`, `product_categoryID`) 
        VALUES ('$name','$price','$brand','$category')";
        $stmt = $conn->prepare($sql);


        echo "New record created successfully";

    
    }
catch(PDOException $e)
    {
    // echo "Connection failed: " . $e->getMessage();
    }





 ?>
