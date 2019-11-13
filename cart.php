<?php
session_start();
require 'Action/connectDB.php';
 
$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if (isset($_SESSION['qty']))
{
    $meQty = 0;
    foreach ($_SESSION['qty'] as $meItem)
    {
        $meQty += intval($meItem);
    }
} else
{
    $meQty = 0;
}
if (isset($_SESSION['cart']) and $itemCount > 0)
{
    $itemIds = "";
    foreach ($_SESSION['cart'] as $itemId)
    {
        $itemIds = $itemIds . $itemId . ",";
    }
    $inputItems = rtrim($itemIds, ",");
    $meSql = "SELECT * FROM `product` WHERE product.product_id in ({$inputItems})";
    $meQuery = mysqli_query($con,$meSql);
    $meCount = mysqli_num_rows($meQuery);
} else
{
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

    </head>
    
        <style>
            #container{
                margin-top: 100px;
            }
        </style>
    <body>
       <?php include'nav.php'; ?>
        <div class="container" id="container">

			<a><h3>ตะกร้าสินค้า</h3></a>
            <!-- Main component for a primary marketing message or call to action -->
            <?php
            if ($action == 'removed')
            {
                echo "<div class=\"alert alert-warning\">ลบสินค้าเรียบร้อยแล้ว</div>";
            }
 
            if ($meCount == 0)
            {
                echo "<div class=\"alert alert-warning\">ไม่มีสินค้าอยู่ในตะกร้า</div>";
            } else
                
                
            {
                ?>
                
                <form action="Action/order.php" method="post" name="fromupdate">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>รหัสสินค้า</th>
                                <th>ชื่อสินค้า</th>
                                <th>จำนวน</th>
                                <th>ราคาต่อหน่วย</th>
                                <th>จำนวนเงิน</th>
                                <th>&nbsp;</th>
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
                                    <td><img src="images/<?php echo $meResult['product_name']; ?>" border="0"></td>
                                    <td><?php echo $meResult['product_id']; ?></td>
                                    <td><?php echo $meResult['product_name']; ?></td>
                                    <td>
                                        <input type="text" name="qty[<?php echo $num; ?>]" value="<?php echo $_SESSION['qty'][$key]; ?>" class="form-control" style="text-align: center;">
                                        <input type="hidden" name="arr_key_<?php echo $num; ?>" value="<?php echo $key; ?>">
                                    </td>
                                    <td><?php echo number_format($meResult['product_price'],2); ?></td>
                                    <td><?php echo number_format(($meResult['product_price'] * $_SESSION['qty'][$key]),2); ?></td>
                                    <td>
                                        <a class="btn btn-outline-danger" href="Action/removecart.php?itemId=<?php echo $meResult['product_id']; ?>" role="button">
                                            ลบทิ้ง</a>
                                    </td>
                                </tr>
                                <?php
                                $num++;
                            }
                            ?>
                            <tr>
                                <td colspan="8" style="text-align: right;">
                                    <h4>จำนวนเงินรวมทั้งหมด <?php echo number_format($total_price,2); ?> บาท</h4>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" style="text-align: right;">
                                    <button type="submit" class="btn btn-outline-info">คำนวณราคาสินค้าใหม่</button>
                                    <a href="#"  class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal">สังซื้อสินค้า</a>
                                </td>
                                <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                ยืนยันการสั่งซื้อ !
                                              </div>
                                              <div class="modal-footer">
                                                 <a href="cartConfirm.php"  class="btn btn-outline-info">บันทึกการซื้อสินค้า</a>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <?php
            }
            ?>
 
        </div> <!-- /container -->
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>
