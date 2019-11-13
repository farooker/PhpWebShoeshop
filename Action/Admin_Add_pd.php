<?php
require'connectDB.php';


 //upload images
  $ext = pathinfo(basename($_FILES['img']['name']), PATHINFO_EXTENSION);
  $new_image_name = 'img_'.uniqid().".".$ext;
  $image_path = "../img_product/";
  $upload_path = $image_path.$new_image_name;
   //upload true
  $success = move_uploaded_file($_FILES['img']['tmp_name'],$upload_path);
  if ($success==false){
  		echo "ไม่สามารถอัพโหลดรูปได้";
  		exit();
  }

$img=$new_image_name;

$sql = "INSERT INTO `product`(`product_name`,`product_price`, `product_img`, `product_brandID`, `product_categoryID`)
VALUES ('".$_POST['name']."','".$_POST['price']."','$img','".$_POST['brand']."','".$_POST['category']."')";

if (mysqli_query($con, $sql)) {
    header('Location: ../Admin/admin_home.php');
} else {
   echo "Error: " . $sql . "<br>" . mysqli_error($con);
}


?>