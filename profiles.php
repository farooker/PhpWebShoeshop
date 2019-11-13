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
            <div class="tab-content" id="nav-tabContent">
               
                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                  <div class="container">
                        <?php
                        require("Action/connectDB.php");
                                 $sql = "SELECT * FROM `member` WHERE member.mem_id='".$_SESSION['UserID']."'";
                                 $result = $con->query($sql);
                                 $data = $result->fetch_assoc();
                                  
                                
                         ?>
                         <div class="row">
                        
                             
                                    <div class="col-lg-4 col-sm-6 text-center mb-4">
                                      <img class="rounded-circle img-fluid d-block mx-auto" src="img_user/<?php echo $data['mem_img'];  ?>" alt="">
                                      <h3><?php echo $data['mem_name'];  ?></h3>
                                      <h6><?php echo $data['mem_username'];  ?></h6>   
                                      <h6><?php echo $data['mem_password'];  ?></h6>  
                                        
                                    </div>
                              
                               <div class="col">
                                    <p><?php echo $data['mem_address'];  ?></p>
                                    <p><?php echo $data['mem_tel'];  ?></p>
     
                               </div>
                                   
                        </div> 
                        <div class="row">
                            <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target=".bd-example-modal-lg">
                      แก้ไข
                    </button>

                    <!-- Modal -->
                              <form action="Action/userEditprofiles.php" method="post" enctype="multipart/form-data">
                               <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body"> 
                                               <div class="container">
                                                    <div class="row">
                                                         <div class="col-lg-4 col-sm-6 text-center mb-4">
                                                             <img class="rounded-circle img-fluid d-block mx-auto" src="img/ec2d4e7a25c2c1b35b7cf1fdf4356ebf.jpg" alt="" id="preview" >
                                                             
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
   <div class="custom-file">
      <input type="file" class="custom-file-input" id="customFileLang"  onchange="previewFile()" lang="es" name="img">
      <label class="custom-file-label" for="customFileLang"></label>
  </div>                                                       
  <div class="form-group">
    <label for="exampleFormControlInput1">ชื่อ</label>
    <input type="text" class="form-control" value="<?php echo $data['mem_name'];  ?>"  name="name">
  </div>
                                                             <div class="form-group">
    <label for="exampleFormControlInput1">username</label>
    <input type="text" class="form-control"  value="<?php echo $data['mem_username'];  ?>"  name="username">
  </div>
                                                             <div class="form-group">
    <label for="exampleFormControlInput1">password</label>
    <input type="text" class="form-control" value="<?php echo $data['mem_password'];  ?>"  name="password">
  </div>  

                                                            </div>

                                                       <div class="col">
                                                            <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">ที่อยู่</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="address"><?php echo $data['mem_address'];  ?></textarea>
                                                          </div>
                                                            <label for="inputEmail4">เบอร์โทร</label>
                                                             <input type="text" class="form-control"  value="<?php echo $data['mem_tel'];  ?> " name="tel">
                                                    
                                                       </div>

                                                   </div>
                                               </div>
                                          </div>
                                          <div class="modal-footer">
                                         
                                            <button type="submit" class="btn btn-primary">บันทึก</button>
                                          </div>
                                        </div>
                                  </div>
                                </div>
                                
                            </form>
                     </div>
                   </div>
                  </div>
                
            </div>
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