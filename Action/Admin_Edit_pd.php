<?php
require'connectDB.php';


if(is_uploaded_file($_FILES['img'] ['tmp_name'])) {
    //delete รูปเก่า

  $sql_select = "SELECT product.product_img  FROM product WHERE product.product_id='".$_POST['id']."'";
  $result_img = mysqli_query($con, $sql_select);
  $row_img = mysqli_fetch_assoc($result_img);
  $img_product = $row_img['product_img'];
  unlink('../img_product/'.$img_product);

    //upload images
  $image_ext = pathinfo(basename($_FILES['img']['name']), PATHINFO_EXTENSION);
  $cage_image_name = 'img_'.uniqid().".".$image_ext;
  $image_path = "../img_product/";
  $image_upload_path = $image_path.$cage_image_name;
  $success = move_uploaded_file($_FILES['img']['tmp_name'],$image_upload_path);
  $sql_img = "UPDATE product SET product.product_img='$cage_image_name' WHERE product.product_id='".$_POST['id']."'";
   
  mysqli_query($con, $sql_img);

  if ($success==false){
      echo "ไม่สามารถอัพโหลดรูปได้";
      exit();
    }
  }


$sql = "UPDATE `product` SET 
`product_name`='".$_POST['name']."',
`product_price`='".$_POST['price']."',
`product_brandID`='".$_POST['brand']."',
`product_categoryID`='".$_POST['category']."'
WHERE  product.product_id='".$_POST['id']."'";

if (mysqli_query($con, $sql)) {
        header('Location: ../Admin/admin_home.php');
} else {
   echo "Error: " . $sql . "<br>" . mysqli_error($con);
}


?>