<?php
 session_start(); 
 require("connectDB.php");


 if(is_uploaded_file($_FILES['img'] ['tmp_name'])) {
    //delete รูปเก่า

 

    //upload images
  $image_ext = pathinfo(basename($_FILES['img']['name']), PATHINFO_EXTENSION);
  $cage_image_name = 'img_'.uniqid().".".$image_ext;
  $image_path = "../img_user/";
  $image_upload_path = $image_path.$cage_image_name;
  $success = move_uploaded_file($_FILES['img']['tmp_name'],$image_upload_path);
  $sql_img = "UPDATE `member` SET  `mem_img`='$cage_image_name'  WHERE member.mem_id='".$_SESSION['UserID']."'";
  mysqli_query($con, $sql_img);

  if ($success==false){
      echo "ไม่สามารถอัพโหลดรูปได้";
      exit();
    }
  }

     $sql = "UPDATE `member` SET 
     `mem_name`='".$_POST['name']."',
     `mem_username`='". $_POST['username']."',
     `mem_password`='".$_POST['password']."',
     `mem_tel`='".$_POST['tel']."',
     `mem_address`='".$_POST['address']."'
     WHERE member.mem_id='".$_SESSION['UserID']."'";

    if (mysqli_query($con, $sql)) {
          header('Location: ../profiles.php');
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
?>