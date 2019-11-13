<?php

include'../Action/connectDB_pdo.php';
 
  try {
    
     
       $sql="SELECT * FROM `product`";
       $sth = $conn->prepare($sql);
        $sth->execute();
         $arr=array();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $arr[]=$row;
        }
       echo json_encode($arr);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

 ?>
