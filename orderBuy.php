<?php
 session_start();

?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
     <link rel="stylesheet"  href="css/product.css">
   
      
  </head>
  
  <style>
     .container-fluid{
          margin-top:150px;
          
      }
 </style>
  <body>
<?php include'nav.php'; ?> 
<!-- content-->
<div class="container-fluid" style="">
        <div class="container">
       <div class="row">
          <div class="col-3">
           <ul class="list-group list-group-flush" id="list-tab" role="tablist">
            <li class="list-group-item"><a  href="profiles.php"  >ข้อมูลส่วนตัว</a></li>
            <li class="list-group-item"><a  href="orderBuy.php"  >รายการสั่งซื้อสินค้า</a></li>
              
         </ul>
        
          </div>
          <div class="col-9">
               <?php
               
                require 'Action/connectDB.php';
              
                     $sql = "SELECT * FROM orderbuy,payment_status WHERE orderbuy.Payment_ID=payment_status.Payment_ID AND  orderbuy.cus_id='".$_SESSION["UserID"]."'";
                        $result = mysqli_query($con, $sql);
                         while($row = mysqli_fetch_assoc($result)) { 
                              $orderID=$row['order_id'];
                              $paymentID=$row['Payment_ID'];  
               ?>
               
                <table class="table">
                      <thead>
                        <tr>
                          <th scope="col"><?php echo $row['order_Date']; ?></th>
                          <th scope="col">รายการสั่งซื้อ</th>
                          <th scope="col">จำนวน</th>
                          <th scope="col">ราคา/หน่วย</th>
                          <th scope="col" style="color: red;">฿<?php echo $row['order_totalprice']; ?></th>
                          <th scope="col"><?php 
                                if($paymentID == 1){
                                    echo '<a  href="payment.php?oderID='.$orderID.'" style="color: #008CBA;">'.$row['Payment_Name'].'</a>';
                                     
                                }
                              if($paymentID == 2){
                                  echo '<a style="color: Orange;">"'.$row['Payment_Name'].'"</a>';
                                     
                                }
                              if($paymentID == 3){
                                   
                                  echo '<a style="color: #4CAF50;">"'.$row['Payment_Name'].'"</a>';
                                     
                                }
                             
                              ?>
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>
                         <?php
                                $Detial = "SELECT `order_Detail_id`, product.product_name,product_price,`amount`, orderdtial.order_id FROM `orderdtial`,product,orderbuy WHERE product.product_id =orderdtial.product_id AND orderbuy.order_id=orderdtial.order_id AND orderdtial.order_id='$orderID'";
                                $data = mysqli_query($con, $Detial);
                                 while($order = mysqli_fetch_assoc($data)) { 
                          ?>
                        <tr>
                          <th>
                              <img src="img/123.jpg" alt="" style="width: 80px;height: 80px;">
                          </th>
                          <td><?php echo $order['product_name']; ?></td>
                          <td><a style="color: red;"><?php echo $order['amount']; ?></a></td>
                          <td><?php echo $order['product_price']; ?></td>
                           
                        </tr>
                         <?php
                             }
                          ?>
                      
                      </tbody>
                 </table>
                <?php
                  }
              ?>
                 
              
          </div>
        </div>
     
 </div>
</div>


 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>