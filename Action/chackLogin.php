<?php
session_start(); 

if(isset($_POST['username'])) 
{
	require("connectDB_pdo.php");
	//exit(0);
	try 
	{
		
		// check email
		$sql = "SELECT * FROM `member` WHERE  mem_username=? AND mem_password=?";
		$stmt = $conn->prepare($sql);
		$cat = array($_POST['username'],$_POST['password']);
		$stmt->execute($cat);

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!$row)
		{

			echo "<script>";
			echo "alert(\" user หรือ  password ไม่ถูกต้อง\");"; 
			echo "window.history.back()";
			echo "</script>";

		}
		
		else
		{

			$_SESSION["UserID"] = $row["mem_id"];      
			$_SESSION["UserStatus"] = $row["mem_status"];
			

			if($_SESSION["UserStatus"]=="ADMIN"){ //ถ้าเป็น admin ให้กระโดดไปหน้า admin_page.php

				 header('Location: ../Admin/admin_home.php');
			}
			
			if($_SESSION["UserStatus"]=="MEMBER"){  //ถ้าเป็น member ให้เปลี่ยนเป็นชื่อ member ที่หน้า navbar.php แทน
			
				header('Location: ' . $_SERVER['HTTP_REFERER']); //. $_SERVER['HTTP_REFERER']
			}
			
		}
	
	}

	catch(PDOException $e)
	{
		echo 'error '.$sql . "<br>" . $e->getMessage();
	   
	}
	
	$conn = null;
	

}
else
{
	echo "<script>";
	echo "alert(\" ผิดพลาด\");"; 
	echo "window.history.back()";
	echo "</script>";
	
}

?>
	