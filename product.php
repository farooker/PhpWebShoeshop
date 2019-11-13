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
             <?php
               
                    try {

                         $sql = "SELECT * FROM `category`";

                            $query = $conn->query($sql);
                            $arr=array();
                            while($row = $query->fetch()) {
                                  echo '<li class="list-group-item"><a  href="product.php?cat='.$row['category_id'].'" 
                                  role="tab" >'.$row['category'].'</a></li>';
                            }
                       

                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
             ?>
              
         </ul>
        
          </div>
          <div class="col-9">
            <div class="tab-content" id="nav-tabContent">
               
                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                  <div class="container">
                         <div class="row">
                                           
                         <?php
               
                                  try {
                                      
                                           $catID='';
                                           if(isset($_GET['cat'])){
                                               $catID=$_GET['cat'];
                                           }else{
                                             $catID='1';  
                                           }
                                      
                                         $sql = "SELECT `product_id`, `product_name`, `product_amount`, `product_price`, `product_img`,brand.brand, category.category
FROM `product`,brand,category WHERE product.product_brandID =brand.brand_id AND product.product_categoryID=category.category_id
AND product.product_categoryID='$catID'";
                                        
                                            $query = $conn->query($sql);
                                            $arr=array();
                                            while($row = $query->fetch()) {
                                                
                                                ?>
                                                <div class="col-md-4">
                                                <div class="card">
                                              <img class="card-img-top" src="img/6809514-shoes.jpg" alt="Card image cap">
                                              <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <h6 class="card-title" style=" white-space: nowrap; 
                                                        width: 200px; 
                                                        overflow: hidden;
                                                        text-overflow: ellipsis;" ><?php echo $row['product_name'] ;?> </h6>
                                                </li>
                                                <li class="list-group-item">
                                                      <div class="row">
                                                              <div class="col">
                                                              <a class="card-link">฿<?php echo $row['product_price'] ;?> </a>
                                                              </div>
                                                              <div class="col">
                                                              <a href="product_detial.php?id=<?php echo $row['product_id'] ;?>" class="card-link">รายละเอียด</a> 
                                                             </div> 
                                                      </div>  
                                                </li>
                                              </ul>
                                              </div>
                                            </div>
                                                
                                    <?php            
                                            }


                                    }
                                    catch(PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }
                             ?>               
            
                      </div> 
                   </div>
                  </div>
                
            </div>
          </div>
        </div>
     
 </div >
</div>


 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>