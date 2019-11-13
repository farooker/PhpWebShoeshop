<?php
session_start();
require 'Action/connectDB.php';
 
$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$_SESSION['formid'] = sha1('itoffside.com' . microtime());

if (isset($_SESSION['cart']) and $itemCount > 0) {
	$itemIds = "";
	foreach ($_SESSION['cart'] as $itemId) {
		$itemIds = $itemIds . $itemId . ",";
	}
	$inputItems = rtrim($itemIds, ",");
	$meSql = "SELECT * FROM `product` WHERE product.product_id in ({$inputItems})";
	$meQuery = mysqli_query($con,$meSql);
	$meCount = mysqli_num_rows($meQuery);
} else {
	$meCount = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>itoffside.com shopping cart</title>
 
        <!-- Bootstrap -->
              <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
             <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
             <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
 
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <style>
        #container{
            margin-top: 100px;
        }
    </style>
    <body>
       
     <?php
         include'nav.php';
        ?>
        <div class="container" id="container">

            <form action="cartSave.php" method="post" name="formupdate" role="form" id="formupdate" onsubmit="JavaScript:return updateSubmit();">
              <div class="row">
                  <div class="col-8">
                       <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>รหัสสินค้า</th>
                                <th>ชื่อสินค้า</th>
                                <th>จำนวน</th>
                                <th>ราคาต่อหน่วย</th>
                                <th>จำนวนเงิน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_price = 0;
                            $num = 0;
                            while ($meResult = mysqli_fetch_assoc($meQuery))
                            {
                                $key = array_search($meResult['product_id'], $_SESSION['cart']);
                                $total_price = $total_price + ($meResult['product_price'] * $_SESSION['qty'][$key]);
                                ?>
                                <tr>
                                    <td><?php echo $meResult['product_id']; ?></td>
                                    <td><?php echo $meResult['product_name']; ?></td>
                                    <td>
                                    	<?php echo $_SESSION['qty'][$key]; ?>
                                    	<input type="hidden" name="qty[]" value="<?php echo $_SESSION['qty'][$key]; ?>" />
                                    	<input type="hidden" name="product_id[]" value="<?php echo $meResult['product_id']; ?>" />
                                    	<input  type="hidden" name="product_price[]" value="<?php echo $meResult['product_price']; ?>" />
                                    </td>
                                    <td><?php echo number_format($meResult['product_price'], 2); ?></td>
                                    <td><?php echo number_format(($meResult['product_price'] * $_SESSION['qty'][$key]), 2); ?></td>
                                </tr>
                                <?php
								$num++;
								}
                            ?>
                            <tr>
                                <td colspan="8" style="text-align: right;">
                                    <input  type="hidden" name="product_price[]" value="<?php echo $meResult['product_price']; ?>" />
                                    <h4>จำนวนเงินรวมทั้งหมด <?php echo number_format($total_price, 2); ?> บาท</h4>
                                    <input  type="hidden" name="totalprice" value="<?php echo number_format($total_price); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" style="text-align: right;">
                                	<input type="hidden" name="formid" value="<?php echo $_SESSION['formid']; ?>"/>
                                	<a href="cart.php"  class="btn btn-outline-danger">ย้อนกลับ</a>
                                    <button type="submit" class="btn btn-outline-info">บันทึกการสั่งซื้อสินค้า</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                  <div class="col-4">
                                     <?php
                        $sql = "SELECT * FROM `member` WHERE  member.mem_id='".$_SESSION['UserID']."'";
                        $result = $con->query($sql);
                        $row = $result->fetch_assoc()
               ?>
          
 
                
                	<div class="form-group">
    					<label for="exampleInputEmail1">ชื่อ-นามสกุล</label>
    					<input type="text" class="form-control" id="order_fullname" placeholder="ใส่ชื่อนามสกุล" style="" name="name" 
    				 value="<?php echo $row['mem_name']  ?>" disabled>
  					</div>
                	<div class="form-group">
    					<label for="exampleInputAddress">ที่อยู่</label>
    					<textarea class="form-control" rows="3" style="" name="order_address" id="address" disabled> <?php echo $row['mem_address']  ?>"</textarea>
  					</div>
                	<div class="form-group">
    					<label for="exampleInputPhone">เบอร์โทรศัพท์</label>
    					<input type="text" class="form-control" id="order_phone" placeholder="ใส่เบอร์โทรศัพท์ที่สามารถติดต่อได้" style="" name="phone"
    					 value="<?php echo $row['mem_tel']  ?>" disabled
    					>
  					</div>
                  </div>
              </div>        
         </form>
           
 
        </div> <!-- /container -->
 
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>
