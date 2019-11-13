<?php
require'connectDB.php';

/*

         $sql_select = "SELECT  product.product_img  FROM `product` WHERE product.product_id='".$_GET['id']."'";
          $result_img = mysqli_query($con, $sql_select);
          $row_img = mysqli_fetch_assoc($result_img);
          $img_old = $row_img['product_img '];
          unlink('../img_product/'.$img_old);
*/
                $sql = "DELETE FROM `product` WHERE product.product_id='".$_GET['id']."'";

                if (mysqli_query($con, $sql)) {

                    header('Location: ../Admin/admin_home.php');
                } else {
                   echo "Error: " . $sql . "<br>" . mysqli_error($con);
                }


?>