<?php
include '../Action/connectDB_pdo.php';

session_start();
if(isset($_SESSION["UserID"])) {
     
    try{
        //check email
        $sql = "SELECT * FROM `member` WHERE member.mem_id=?";
        $sth = $conn->prepare($sql);
        $cat = array($_SESSION["UserID"]);
        $sth->execute($cat);

        $row = $sth->fetch();

    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
        // echo '<script>alert("บันทึกข้อมูลไม่สำเร็จ!!! :(");window.location="../form.php";</script>';
    }
}
?>


<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    
  </head>
  <style> 
    
    .imgRound {
            border-radius: 50%;
            width: 50px;
            height:50px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        a:hover{
            color: #ffd11a;

        }
        a{
             font-family: 'Kanit', sans-serif;
             color: black;
        }
    #row{
         margin-top: 100px;
    }
      .rounded{
          width: 300px;
          height: 300px;
      }
</style>

  <body>

<!-- content-->
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand">Navbar</a>
  <form class="form-inline">
                   <img src="../img/123.jpg" class="imgRound">
                   <div class="dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $row['mem_name']; ?></a>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> 
                             <a class="dropdown-item" href="../Action/logout.php">ออกจากระบบ</a>
                          </div>
                </div>
  </form>
</nav>
    <div class="container"  id="">
         <div class="row">
              <div class="col-3">
                <div class="list-group list-group-flush" id="list-tab" role="tablist">
                  <a class="list-group-item list-group-item-action " id="list-home-list" href="admin_home.php" >สินค้า</a>
             
                </div>
              </div>
              <div class="col-9">
                 <div class="container">
                    <?php
                      
                      try {
                            
                            $id=$_GET['itemID'];
                            $stmt= $conn->prepare("SELECT `product_id`, `product_name`, `product_amount`, `product_price`, `product_img`, `product_brandID`, `product_categoryID`, brand.brand, category.category FROM `product`,brand,category WHERE product.product_brandID=brand.brand_id AND product.product_categoryID=category.category_id AND product.product_id='$id'");
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                          
                            $catID=$row['product_categoryID'];
                            $brandID=$row['product_brandID'];
                
                     ?>
                    
                     <div class="row">
                         <div class="col">
                             <div class="text-center">
                                 <img src="../img_product/<?php echo $row['product_img'] ?>" class="rounded" alt="...">
                             </div>
                         </div>
                         <div class="col">
                             <form>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="inputEmail4">ยี่ห้อสินค้า</label>
                                   <input type="text" class="form-control" id="inputAddress" value="<?php echo $row['brand'] ?>"  disabled>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="inputPassword4">ประเภทสินค้า</label>
                                   <input type="text" class="form-control" id="inputAddress" value="<?php echo $row['category'] ?>" disabled>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputAddress">ชื่อสินค้า</label>
                                <input type="text" class="form-control" id="inputAddress"  value="<?php echo $row['product_name'] ?>" disabled>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="inputCity">ราคาสินค้า</label>
                                  <input type="text" class="form-control" id="inputCity" value="<?php echo $row['product_price'] ?>" disabled>
                                </div>
                                
                              </div>
                              <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target=".bd-example-modal-lg">แก้ไขข้อมูลสินค้า</button>
                              <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal">ลบข้อมูลสินค้า</button>
                            </form>
                         </div>
                     </div>
                     <?php
                     
                         }
                        catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                     
                     ?>
                     
                 </div>
              </div>
        </div>

    </div>   
 
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
   
       <form action="../Action/Admin_Edit_pd.php" method="post" enctype="multipart/form-data">
        <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขข้อมูลสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    
                    <div class="container">
                      <div class="row">
                          <div class="col">
                             <div class="text-center">
                                 <input type="hidden" name="id"  value="<?php echo $row['product_id'] ?>" >
                                 <img src="../img_product/<?php echo $row['product_img'] ?>" class="rounded" alt="..." id="preview">
                                  <br>
                                  
                                 <div class="custom-file">
                                  <input type="file" class="custom-file-input"  onchange="previewFile()" id="customFile" name="img">
                                  <label class="custom-file-label" for="customFile">เลือกภาพ</label>
                                </div>
                             </div>
                                  <script>
                                                     function previewFile() {
                                                          var preview = document.querySelector('#preview');
                                                          var file    = document.querySelector('input[type=file]').files[0];
                                                          var reader  = new FileReader();

                                                          reader.addEventListener("load", function () {
                                                            preview.src = reader.result;
                                                          }, false);

                                                          if (file) {
                                                            reader.readAsDataURL(file);
                                                          }
                                                        }
                                                             
                                                             </script>
                         </div>
                         <div class="col">
                            
                              <div class="form-row">
                                   <div class="form-group col-md-6">
                                  <label for="inputEmail4">ยี่ห้อสินค้า</label>
                                   <select class="form-control" name="brand" id="brand">
                                     <?php
                                            
    
                                          try {
                                                $sql="SELECT * FROM `brand`";
                                                $stmt = $conn->prepare($sql); 
                                                $stmt->execute();

                                               while($brand = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                                   echo '<option value='.$brand['brand_id'].'>'.$brand['brand'].'</option>';

                                                }
                                            }
                                            catch(PDOException $e) {
                                                echo "Error: " . $e->getMessage();
                                            }
                                      ?>
                                      
                                       
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="inputPassword4">ประเภทสินค้า</label>
                                   <select class="form-control" name="category" id="category">
                                           <option>ว่าง</option>
                                     <?php
                                          try {
                                                $sql="SELECT * FROM `category`";
                                                $stmt = $conn->prepare($sql); 
                                                $stmt->execute();

                                               while($category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    
                                                  
                                                  
                                                
                                                    echo '<option value='.$category['category_id'].'>'.$category['category'].'</option>';
                                                       
                                                
                                                  
                                                   
                                                
                                                }
                                            }
                                            catch(PDOException $e) {
                                                echo "Error: " . $e->getMessage();
                                            }
                                      ?>
                                    </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputAddress">ชื่อสินค้า</label>
                                <input type="text" class="form-control" id="inputAddress" name="name"  value="<?php echo $row['product_name'] ?>" >
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="inputCity">ราคาสินค้า</label>
                                  <input type="text" class="form-control" id="inputCity" name="price" value="<?php echo $row['product_price'] ?>" >
                                </div>
                                
                              </div>
                                
                         </div>
                     </div>
                    </div>
                
              </div>
              <div class="modal-footer">
             
                <button type="submit" class="btn btn-outline-success">บันทึกข้อมูล</button>
              </div>
            </div>
            </form>
      </div>
    </div> 
    
     <!-- ยืนยันข้อมูล -->
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
            ยืนยันการลบข้อมูล!!!!
          </div>
          <div class="modal-footer">
              <a href="../Action/Admin_delete_pd.php?id=<?php echo $row['product_id']; ?>"><button type="button" class="btn btn-primary">ยืนยัน</button></a>
            
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