<?php
include 'Action/connectDB_pdo.php';
?>    


 <style>

 .imgRound {
    border-radius: 50%;
    width: 50px;
    height:50px;
    margin-top: 5px;
    margin-bottom: 5px;
}
 .fixed-top{

  background-color: #fff;

      
}
    .justify-content-end{
    border-bottom: 1px solid #ebebe0;
}
.navbar{
     border-bottom: 1px solid #ebebe0;
     
    
}
 ul{
    border-bottom: 1px solid #ebebe0;
}
 ul li a{
    font-family: 'Kanit', sans-serif;
    color: black;
}
a:hover{
    color: #ffd11a;
    
}
a{
     font-family: 'Kanit', sans-serif;
     color: black;
}
   
</style>

<?php
session_start();

if(isset($_SESSION['qty'])){
    $meQty = 0;
    foreach($_SESSION['qty'] as $meItem){
         $meQty += intval($meItem);
    }
}else{
    $meQty=0;
}
?>

<?php 
    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
 
if(isset($_SESSION["UserID"])) {
     
    try{
        //check email
        $sql = "SELECT * FROM `member` WHERE member.mem_id=?";
        $sth = $conn->prepare($sql);
        $cat = array($_SESSION["UserID"]);
        $sth->execute($cat);

        $row = $sth->fetch();
        $showUser = '  <img src="img/123.jpg" class="imgRound">';
        $showLogin = '<div class="dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$row['mem_name'].'</a>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                         <a class="dropdown-item" href="cart.php">ตะกร้าสินค้า<span class="badge badge-primary badge-pill">'.$meQty.'</span></a>
                         <a class="dropdown-item" href="profiles.php">ข้อมูลส่วนตัว</a>
                         <a class="dropdown-item" href="orderBuy.php">รายการสั่งซื้อ</a>
                         <a class="dropdown-item" href="payment.php">ชำระเงิน</a>  
                         <a class="dropdown-item" href="Action/logout.php">ออกจากระบบ</a>
                          </div>
                    </div>';
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
        // echo '<script>alert("บันทึกข้อมูลไม่สำเร็จ!!! :(");window.location="../form.php";</script>';
    }
    

}else{  $showUser = '<a class="nav-link" href="#"  data-toggle="modal" data-target="#Login">เข้าสู่ระบบ</a>';
        $showLogin ='<a class="nav-link " href="#" data-toggle="modal" data-target="#Register">สมัครสมาชิก</a>';
}
    

?>       

<div class="fixed-top">
   <ul class="nav justify-content-end">
       
          <li class="nav-item">
             <?php echo $showUser; ?>
          </li>
          <li class="nav-item">
            <?php echo $showLogin; ?>
          </li>
        
 </ul>
    <nav class="navbar navbar-light bg-light ">
         
          <div class="container">
               <a class="navbar-brand" href="#">
                    <img src="img/2-stopy-logo.png" width="160" height="50" class="d-inline-block align-top" alt="">
                  </a>
                
                         <nav class="nav nav-pills nav-justified">
                              <a class="nav-link" href="promotion.php">โปรโมชั่น</a>
                              <a class="nav-link" href="content.php">บทความ</a>
                       
                             <a class="nav-link" href="product.php">สินค้าทั้งหมด</a>
                           
                             <a class="nav-link" href="#">บุรษ</a>
                         
                             <a class="nav-link" href="#">สตรี</a>
                       
                             
                         </nav>
                         <div>
                        
                        </div>
                
          </div>
       
    </nav>
 </div>    

    
<!-- model Login-->
    <div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="container">
                     <h3 style="text-align: center;">ยินดีตอนรับเข้าสู่ระบบ</h3>
                     <form action="Action/chackLogin.php" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <input type="email" class="form-control" placeholder="Enter email"  name="username">
                          </div>
                          <div class="form-group">
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                          </div>
                          <button type="submit" class="btn btn-dark btn-block">ล็อกอิน</button>
                          <button type="button" class="btn btn-primary btn-block">Facebook</button>
                     </form>
                          
                         
                </div>
          </div>
          <div class="modal-footer">
           
          </div>
        </div>
      </div>
    </div>
    
    <!-- model Login-->
    <div class="modal fade" id="Register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="container">
                  
                     <form action="Action/chackLogin.php" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <input type="email" class="form-control" placeholder="Enter email"  name="username">
                          </div>
                          <div class="form-group">
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                          </div>
                          <button type="submit" class="btn btn-dark btn-block">ล็อกอิน</button>
                          <button type="button" class="btn btn-primary btn-block">Facebook</button>
                     </form>
                          
                         
                </div>
          </div>
          <div class="modal-footer">
           
          </div>
        </div>
      </div>
    </div>



