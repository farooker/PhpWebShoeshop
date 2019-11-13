<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
     
   
      
  </head>
  
  <style>
     .container-fluid{
          margin-top:150px;
      }
      .rounded {
          width: 400px;
          height: 300px;
      }
      .img-thumbnail{
           width: 200px;
          height: 200px;
      }
      .price{
          margin-top: 150px;
         color: red;
      }
      
      /*ปุ่มชำระเงิน*/
      .checkout-form > button {
              font-family: 'Kanit', sans-serif;
              display: inline-block;
              padding: 1em;
              border: 0;
               background-color: white;
              color: black;
              border: 2px solid #555555;
              outline: none;
              border-radius: 1px;
              width: 100%;
            }
      .checkout-form > button:hover {
             background-color: #555555;
             color: white
            }
      
      
     .ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
           
        }

        .li {
            float: left;
        }

       .li a {
            display: block;
            text-align: center;
            padding: 14px 16px;
           
            
         
        }
    .rounded{
          width: 60px;
          height: 50px;
      }
      

        
 </style>
  <body>
<?php include'nav.php'; ?> 
<!-- content-->
<div class="container-fluid" style="">
       
        <div class="container"> 
            <br>
            <a><h5>การชำระเงิน</h5></a> 
            <hr>
         
          <div class="row">
               <div class="col-9">
                   <div class="container">
                       <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ชื่อ-นามสกุล</label>
                                    <input type="text" class="form-control" id="order_fullname" placeholder="ใส่ชื่อนามสกุล" style="" name="name" 
                                 value="<?php echo $row['mem_name']  ?>" disabled>
                                
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPhone">เบอร์โทรศัพท์</label>
                                    <input type="text" class="form-control" id="order_phone" placeholder="ใส่เบอร์โทรศัพท์ที่สามารถติดต่อได้" style="" name="phone"
                                     value="<?php echo $row['mem_tel']  ?>" disabled
                                    >
                                </div>
                                
                            </div>
                            <div class="col">
                               
                                <div class="form-group">
                                    <label for="exampleInputAddress">ที่อยู่</label>
                                    <textarea class="form-control" rows="3" style="" name="order_address" id="address" disabled> <?php echo $row['mem_address']  ?>"</textarea>
                                </div>
                                
                            </div>
                       </div>
                   </div>
        
                <hr>
                 <?php
                            include 'Action/connectDB.php';
                            $id=$_GET['oderID'];                   
                            $order = "SELECT * FROM `orderbuy` WHERE orderbuy.order_id ='$id'";
                            $result = mysqli_query($con,$order);
                            $row_order = mysqli_fetch_assoc($result);
                          ?>
                           
                    <ul  class="ul">
                      <li  class="li"><a><h5>รายการสั่งซื้อ</h5></a></li>
                      <li   class="li" ><a><h5>#<?php echo $row_order['order_id'] ?></h5></a></li>
                      <li  class="li"  id="totalprice" style="float:right;margin-right:50px;"><a><h5>ราคารวม ฿<?php echo $row_order['order_totalprice'] ?></h5></a></li>
                    </ul>
                
                
                <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">ชื่อสินค้า</th>
                          <th scope="col">จำนวน</th>
                          <th scope="col">ราคา/หน่วย</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $order_detial = "SELECT orderdtial.product_id, `product_name`, `product_amount`, `product_price`, `product_img`,orderdtial.amount FROM `product`,orderdtial,orderbuy WHERE orderbuy.order_id=orderdtial.order_id AND product.product_id=orderdtial.product_id AND orderbuy.order_id='$id'";
                          $data = mysqli_query($con,$order_detial);
                           while($row_detial = mysqli_fetch_assoc($data)) {
                          ?>
                        <tr>
                            <th scope="row"><img src="../shopping/img_product/<?php echo $row_detial['product_img']; ?>" class="rounded float-left" alt="..."></th>
                            <td><h6 style="white-space: nowrap; 
                                                 width: 150px; 
                                                overflow: hidden;
                                                text-overflow: ellipsis;"><?php echo $row_detial['product_name']; ?></h6></td>
                             <td><?php echo $row_detial['amount']; ?></td>
                             <td><?php echo $row_detial['product_price']; ?></td>
                        </tr>
                     <?php
                           }
                    ?>
                      </tbody>
                    </table>  
         
               </div>
               <div class="col-3"> 
                   <br>     
                    <div class="card text-center">
                              <div class="card-header">
                                <a>ชำระเงิน</a>
                              </div>
                              
                              <div class="row">
                                    <div class="card-body">
                                          <?php

                                              $number=$row_order['order_totalprice']*100;
                                              ?>

                                       <form class="checkout-form" name="checkoutForm" method="POST" action="Action/payment/Credit_Cards.php">
                                        <input type="hidden" name="description" value="<?php echo $number ;?>" />
                                             <script type="text/javascript" src="https://cdn.omise.co/omise.js"
                                                      data-key="pkey_test_5d7lyhsv0dn5o72optj"
                                                      data-amount="<?= $number ?>"
                                                      data-currency="THB"
                                                      data-default-payment-method="credit_card">
                                              </script>
                                                                                       <!--
                                                <script type="text/javascript" src="https://cdn.omise.co/card.js"
                                                      data-key="pkey_test_5d7lyhsv0dn5o72optj"
                                                      data-image="https://cdn-images-1.medium.com/max/1200/1*04-1NGmLRPaeffr9dJG-7Q.jpeg"
                                                      data-frame-label="ชื่อ user Merchant site name"
                                                      data-button-label="ชำเงินผ่านบัตรเครดิต"
                                                      data-submit-label="Submit"
                                                      data-other-payment-methods="internet_banking, bill_payment_tesco_lotus, alipay, credit_card"
                                                      data-amount="<?= $number ?>"
                                                      data-currency="thb"
                                                      >
                                                </script>
                                           -->

                                     </form> 
                                     </div>
                              </div>
                              <div class="row">
                                 <div class="container">
                                   <div id="paypal-button"></div>
                                 </div>
                                
                                <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                                 <?php
                                  echo '<script>
                                 
                                      paypal.Button.render({
                                        // Configure environment
                                        env: "sandbox",
                                        client: {
                                          sandbox: "AY1PS0kgZPpP8xuQHwwPPtIbG05dYXwAyNvnwkmeLQml5VnOU8ko6wVn724X-TboHMuL5DGT3hssk2TJ",

                                        },
                                        // Customize button (optional)
                                        locale: "en_US",
                                        style: {
                                          size: "small",
                                          color: "gold",
                                          shape: "pill",
                                        },
                                        // Set up a payment
                                        payment: function(data, actions) {
                                          return actions.payment.create({
                                            transactions: [{
                                              amount: {
                                                total: "'.$row_order['order_totalprice'].'",
                                                currency: "USD"
                                              }
                                            }]
                                          });
                                        },
                                        // Execute the payment
                                        onAuthorize: function(data, actions) {
                                          return actions.payment.execute().then(function() {
                                            // Show a confirmation message to the buyer
                                            window.alert("Thank you .ชำระเงินเรียบร้อย!");
                                          });
                                        }
                                      }, "#paypal-button");

                                    </script>';
                                  
                                  
                                  ?>                  
                        </div>  
                         
                    </div>  
                                
                              
                         
               </div>
          </div> 
        


          
           
             <!-- <form name="checkoutForm" method="POST" action="Action/payment/Credit_Cards.php">
                <input type="hidden" name="description" value="Product order ฿100.25" />
                        <script type="text/javascript" src="https://cdn.omise.co/card.js"
                              data-key="pkey_test_5d7lyhsv0dn5o72optj"
                              data-image="https://cdn-images-1.medium.com/max/1200/1*04-1NGmLRPaeffr9dJG-7Q.jpeg"
                              data-frame-label="ชื่อ user Merchant site name"
                              data-button-label="Pay now"
                              data-submit-label="Submit"
                              data-amount="10025"
                              data-currency="thb"
                              >
                        </script>
                
             </form> -->
             
             
             
        </div>
    </div>


     <!-- Omise -->
    <script src="https://cdn.omise.co/omise.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>