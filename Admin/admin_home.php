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
          width: 60px;
          height: 50px;
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
                  <a class="list-group-item list-group-item-action " id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">สินค้า</a>
                  <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Profile</a>
                  <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Messages</a>
                  <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Settings</a>
                </div>
              </div>
              <div class="col-9">
               <div class="row">
                  <div class="col">
                           <form class="form-inline" name="searchform" id="searchform">
                                 <div class="form-group">
                                 <input type="text" name="itemname" id="itemname" class="form-control" placeholder="ข้อความ คำค้นหา!" autocomplete="off">
                                 </div>
                                 <button type="button" class="btn btn-outline-dark" id="btnSearch">
                                 <span class="glyphicon glyphicon-search"></span>
                                    ค้นหา
                                 </button>
                            </form>
                  </div>
                  <div class="col">
                        <button type="button" class="btn btn-outline-dark" id="btnSearch" data-toggle="modal"
                         data-target=".bd-example-modal-lg">เพิ่มข้อมูลสินค้า</button>
                  </div>
               </div>
               <div class="row">
                    <div class="tab-content" id="nav-tabContent">
                   <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#shoes1" role="tab" aria-controls="home" aria-selected="true">สินค้าทั้งหมด</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#shoes2" role="tab" aria-controls="profile" aria-selected="false">รองเท้าประเภทวิ่ง</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#shoes3" role="tab" aria-controls="contact" aria-selected="false">รองเท้ากีฬาประเภทคอร์ท</a>
                      </li>
                       <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#shoes4" role="tab" aria-controls="contact" aria-selected="false">รองเท้ากีฬาประเภทสนาม</a>
                      </li>
                       <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#shoes5" role="tab" aria-controls="contact" aria-selected="false">รองเท้าเดินเที่ยว</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="shoes1" role="tabpanel" aria-labelledby="home-tab">
                         <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">ชื่อสินค้า</th>
                                  <th scope="col">ยี่ห้อ</th>
                                  <th scope="col">ราคาสินค้า</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                               <?php
                                  try {
                                        $sql="SELECT `product_id`, `product_name`, `product_amount`, `product_price`, `product_img`,brand.brand, `product_categoryID` FROM `product`,brand WHERE product.product_brandID=brand.brand_id ";
                                        $stmt = $conn->prepare($sql); 
                                        $stmt->execute();

                                       while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                               
                                      ?>
                                    <tr>
                                      <th scope="row"><img src="../img_product/<?php echo $row['product_img']; ?>" class="rounded float-left" alt="..."></th>
                                      <td><h6 style="white-space: nowrap; 
                                                 width: 150px; 
                                                overflow: hidden;
                                                text-overflow: ellipsis;"><?php echo $row['product_name']; ?></h6></td>
                                      <td><?php echo $row['brand']; ?></td>
                                      <td><?php echo $row['product_price']; ?></td>
                                      <td>
                                      <a href="admin_productDetail.php?itemID=<?php echo $row['product_id']; ?>"  class="btn btn-outline-info">รายละเอียด</a>
                                      </td>
                                    </tr>
                                <?php
                                        }
                                    }
                                    catch(PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }
                                ?>
                              </tbody>
                            </table>
                      
                      </div>
                      <div class="tab-pane fade" id="shoes2" role="tabpanel" aria-labelledby="profile-tab">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">ชื่อสินค้า</th>
                                  <th scope="col">ยี่ห้อ</th>
                                  <th scope="col">ราคาสินค้า</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                               <?php
                                  try {
                                        $sql="SELECT `product_id`, `product_name`, `product_amount`, `product_price`, `product_img`,brand.brand, category.category FROM `product`,brand,category WHERE product.product_brandID=brand.brand_id AND product.product_categoryID=category.category_id AND category.category_id='2'";
                                        $stmt = $conn->prepare($sql); 
                                        $stmt->execute();

                                       while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                               
                                      ?>
                                    <tr>
                                      <th scope="row"><img src="../img_product/<?php echo $row['product_img']; ?>" class="rounded float-left" alt="..."></th>
                                      <td><h6 style="white-space: nowrap; 
                                                 width: 150px; 
                                                overflow: hidden;
                                                text-overflow: ellipsis;"><?php echo $row['product_name']; ?></h6></td>
                                      <td><?php echo $row['brand']; ?></td>
                                      <td><?php echo $row['product_price']; ?></td>
                                      <td>
                                      <a href="admin_productDetail.php?itemID=<?php echo $row['product_id']; ?>"  class="btn btn-outline-info">รายละเอียด</a>
                                      </td>
                                    </tr>
                                <?php
                                        }
                                    }
                                    catch(PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }
                                ?>
                              </tbody>
                            </table>
                          
                      </div>
                      <div class="tab-pane fade" id="shoes3" role="tabpanel" aria-labelledby="contact-tab">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">ชื่อสินค้า</th>
                                  <th scope="col">ยี่ห้อ</th>
                                  <th scope="col">ราคาสินค้า</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                               <?php
                                  try {
                                        $sql="SELECT `product_id`, `product_name`, `product_amount`, `product_price`, `product_img`,brand.brand, category.category FROM `product`,brand,category WHERE product.product_brandID=brand.brand_id AND product.product_categoryID=category.category_id AND category.category_id='3'";
                                        $stmt = $conn->prepare($sql); 
                                        $stmt->execute();

                                       while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                               
                                      ?>
                                    <tr>
                                      <th scope="row"><img src="../img_product/<?php echo $row['product_img']; ?>" class="rounded float-left" alt="..."></th>
                                      <td><h6 style="white-space: nowrap; 
                                                 width: 150px; 
                                                overflow: hidden;
                                                text-overflow: ellipsis;"><?php echo $row['product_name']; ?></h6></td>
                                      <td><?php echo $row['brand']; ?></td>
                                      <td><?php echo $row['product_price']; ?></td>
                                      <td>
                                      <a href="admin_productDetail.php?itemID=<?php echo $row['product_id']; ?>"  class="btn btn-outline-info">รายละเอียด</a>
                                      </td>
                                    </tr>
                                <?php
                                        }
                                    }
                                    catch(PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }
                                ?>
                              </tbody>
                            </table>
                      </div>
                      <div class="tab-pane fade" id="shoes4" role="tabpanel" aria-labelledby="contact-tab">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">ชื่อสินค้า</th>
                                  <th scope="col">ยี่ห้อ</th>
                                  <th scope="col">ราคาสินค้า</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                               <?php
                                  try {
                                        $sql="SELECT `product_id`, `product_name`, `product_amount`, `product_price`, `product_img`,brand.brand, category.category FROM `product`,brand,category WHERE product.product_brandID=brand.brand_id AND product.product_categoryID=category.category_id AND category.category_id='4'";
                                        $stmt = $conn->prepare($sql); 
                                        $stmt->execute();

                                       while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                               
                                      ?>
                                    <tr>
                                      <th scope="row"><img src="../img_product/<?php echo $row['product_img']; ?>" class="rounded float-left" alt="..."></th>
                                      <td><h6 style="white-space: nowrap; 
                                                 width: 150px; 
                                                overflow: hidden;
                                                text-overflow: ellipsis;"><?php echo $row['product_name']; ?></h6></td>
                                      <td><?php echo $row['brand']; ?></td>
                                      <td><?php echo $row['product_price']; ?></td>
                                      <td>
                                      <a href="admin_productDetail.php?itemID=<?php echo $row['product_id']; ?>"  class="btn btn-outline-info">รายละเอียด</a>
                                      </td>
                                    </tr>
                                <?php
                                        }
                                    }
                                    catch(PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }
                                ?>
                              </tbody>
                            </table>
                      </div>
                      <div class="tab-pane fade" id="shoes5" role="tabpanel" aria-labelledby="contact-tab">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">ชื่อสินค้า</th>
                                  <th scope="col">ยี่ห้อ</th>
                                  <th scope="col">ราคาสินค้า</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                               <?php
                                  try {
                                        $sql="SELECT `product_id`, `product_name`, `product_amount`, `product_price`, `product_img`,brand.brand, category.category FROM `product`,brand,category WHERE product.product_brandID=brand.brand_id AND product.product_categoryID=category.category_id AND category.category_id='1'";
                                        $stmt = $conn->prepare($sql); 
                                        $stmt->execute();

                                       while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                               
                                      ?>
                                    <tr>
                                      <th scope="row"><img src="../img/blackHome.jpg" class="rounded float-left" alt="..."></th>
                                      <td><h6 style="white-space: nowrap; 
                                                 width: 150px; 
                                                overflow: hidden;
                                                text-overflow: ellipsis;"><?php echo $row['product_name']; ?></h6></td>
                                      <td><?php echo $row['brand']; ?></td>
                                      <td><?php echo $row['product_price']; ?></td>
                                      <td>
                                      <a href="admin_productDetail.php?itemID=<?php echo $row['product_id']; ?>"  class="btn btn-outline-info">รายละเอียด</a>
                                      </td>
                                    </tr>
                                <?php
                                        }
                                    }
                                    catch(PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }
                                ?>
                              </tbody>
                            </table>
                        </div>
                    </div>
                  
                  
                   </div>
                  <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">2</div>
                  <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">3</div>
                  <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">4</div>
                </div>
               </div>
                
              </div>
        </div>

    </div>
  <form action="../Action/Admin_Add_pd.php" id="frmInsert" method="post" enctype="multipart/form-data">
       <!-- เพิ่มข้อมุลสินค้า -->  
     <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
      
     
        <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">เพิ่มข้อมูลสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    
                    <div class="container">
                               <div class="row">
                         <div class="col">
                             <div class="text-center">
                                 <img src="../img/6809514-shoes.jpg" class="rounded"  style=" width: 300px;height: 300px;" alt="..." id="preview">
                                <br>
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
                                <input type="text" class="form-control" id="name"  name="name" >
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="inputCity">ราคาสินค้า</label>
                                  <input type="text" class="form-control" id="price" name="price">
                                </div>
                                
                              </div>    
                           </div>
                        </div>
                     </div>
                
              </div>
              <div class="modal-footer">
             
                <button type="submit" id="btnInsertSave"  class="btn btn-outline-success">บันทึกข้อมูล</button>
                
              </div>
            </div>
        
      </div>
    </div> 
 </form>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>