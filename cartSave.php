<?php

 
session_start();
$formid = isset($_SESSION['formid']) ? $_SESSION['formid'] : "";
if ($formid != $_POST['formid']) {
	echo "E00001!! SESSION ERROR RETRY AGAINT.";
} else {
	unset($_SESSION['formid']);
	if ($_POST) {
		require 'Action/connectDB.php';
             $sql = "SELECT MAX(orderbuy.order_id) AS MaxID FROM `orderbuy`";
             $result = $con->query($sql);
             $row = $result->fetch_assoc();
             $ID=$row['MaxID'];

              $newID='';
              $date=date("Y-m-d H:i:s");
                     if($ID==null){
                         $newID = 1;
                      }
                     else{
                         $newID=$ID+1;

                     }      
             
        $totalprice=$_POST['totalprice'];      
        
		$sql = "INSERT INTO `orderbuy`(`order_id`, `order_Date`, `order_totalprice`, `cus_id`, `Payment_ID`) VALUES 
        ('$newID','$date','$totalprice','".$_SESSION['UserID']."','1')";  

        $meQeury =mysqli_query($con, $sql);
            
        
		if ($meQeury) {
			for ($i = 0; $i < count($_POST['qty']); $i++) {
				$order_quantity =($_POST['qty'][$i]);
				$product_id = ($_POST['product_id'][$i]);
				$lineSql = "INSERT INTO `orderdtial`(`product_id`, `amount`, `order_id`) 
                VALUES ('$product_id','$order_quantity','$newID') ";
				mysqli_query($con, $lineSql);
                   
			}
			
			unset($_SESSION['cart']);
			unset($_SESSION['qty']);
			header('location:product.php');
        
		}else{
			
			//header('location:index.php?a=orderfail');
		}
        
	}
}

?>