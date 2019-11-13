
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
         .center {
                width: 50%;
                position: absolute;
                top: 50%;
                left: 40%;
                transform: translate(-30%, -50%);

              font-family: 'Kanit', sans-serif;
               color: wheat;
                text-align: center;
            }
</style>
  <body>
 <?php include'nav.php'; ?>
<!-- content-->
 
  <div class="fromBG">
   <img src="img/123.jpg" class="img-fluid"  style=" width: 100%;"> 
     <div class="center">
        
        <h1>ร้านขายร้องเท้า SHOES SHOP</h1>
        <br>
         <form>
              <div class="input-group">
                  <input type="text" class="form-control" placeholder="ค้นหาข้อมูลสินค้า" aria-label="Recipient's username with two button addons" aria-describedby="button-addon4">
                  <div class="input-group-append" id="button-addon4">
                    <button class="btn btn-warning" type="button">ค้นหา</button>
                  </div>
                </div>
         </form>
         
     </div>
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>