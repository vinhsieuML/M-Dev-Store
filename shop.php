<?php 

    $active='Shop';
    include("includes/header.php");

?>
   
   <div id="content"><!-- #content Begin -->
       <div class="container"><!-- container Begin -->
           <div class="col-md-12"><!-- col-md-12 Begin -->
               
               <ul class="breadcrumb"><!-- breadcrumb Begin -->
                   <li>
                       <a href="index.php">Trang chủ</a>
                   </li>
                   <li>
                       Cửa hàng
                   </li>
               </ul><!-- breadcrumb Finish -->
               
           </div><!-- col-md-12 Finish -->
           
           <div class="col-md-3"><!-- col-md-3 Begin -->
   
   <?php 
    
    include("includes/sidebar.php");
    
    ?> 
               
           </div><!-- col-md-3 Finish -->
           
           <div class="col-md-9"><!-- col-md-9 Begin -->

           <?php
                    if(!isset($_GET['p_cat'])){
                        if (!isset($_GET['cat'])) {
                            echo "

                <div class='box'> <!-- box Begin -->

                    <h1>Cửa hàng</h1>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio explicabo, tenetur alias ratione voluptates saepe inventore labore aliquam velit sed eos modi aliquid autem ipsum hic, unde, necessitatibus at. Ex?
                    </p>
                </div> <!-- box Finish -->
                ";
                        }
                    }
                ?>
               
               <div class="row"> <!-- row Begin  (product class eff)--> 
                <?php 
                   
                   if (!isset($_GET['p_cat'])) {
                       if (!isset($_GET['cat'])) {
                           $per_page=6;
                        
                           if (isset($_GET['page'])) {
                               $page = $_GET['page'];
                           } else {
                               $page=1;
                           }
                       
                           $start_from = ($page-1) * $per_page;
                        
                           $get_products = "SELECT p.id, p.id_hang ,p.name,p.price,GROUP_CONCAT(img.link) as link FROM product p JOIN images img on p.id = img.id_product GROUP BY p.id order by 1 DESC LIMIT $start_from,$per_page";
                        
                           $run_products = mysqli_query($con, $get_products);
                        
                           while ($row_products=mysqli_fetch_array($run_products)) {
                               $pro_id = $row_products['id'];
        
                               $pro_title = $row_products['name'];
        
                               $pro_price = $row_products['price'];

                               $pro_price_f = number_format($pro_price, 0, ',', '.');

               
        
                               $pro_link =preg_split("/\,/", $row_products['link'])[0];
        
           
                               $manufacturer_id = $row_products['id_hang'];
                           
                               echo "
                           
                               <div class='col-md-4 col-sm-6 center-responsive'>
                               
                                   <div class='product eff'>
                                   
                                       <a href='details.php?pro_id=$pro_id'>
                                       
                                           <img class='img-responsive' src='admin_area/product_images/$pro_link'>
                                       
                                       </a>
                                       
                                       <div class='text'>
                                       
                                           <h3 class='pad_h'>
                                           
                                               <a href='details.php?pro_id=$pro_id'> $pro_title </a>
                                           
                                           </h3>
                                       
                                           <p class='price'>

                                               $pro_price_f VNĐ

                                           </p>

                                           <p class='buttons'>

                                               <a class='btn btn-default' href='details.php?pro_id=$pro_id'>

                                                   Xem

                                               </a>

                                               <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>

                                                   <i class='fa fa-shopping-cart'></i> Thêm vào giỏ hàng

                                               </a>

                                           </p>
                                       
                                       </div>
                                   
                                   </div>
                               
                               </div>
                           
                           ";
                           }
                       }
                   }
                   
                ?>
                </div> <!-- row Finish -->
               
               <center>
                    <ul class="pagination"> <!-- pagination Begin -->
                        <?php
                            $query = "select * from product";
                            $result = mysqli_query($con,$query);
                            $total_records = mysqli_num_rows($result);
                            $total_pages = ceil($total_records/6);

                            echo "
                                <li>
                                    <a href='shop.php?page=1'> ".'Trang đầu'." </a>
                                <li>
                            ";

                            for($i=1;$i<=$total_pages;$i++)
                            {
                                echo "
                                <li>
                                    <a href='shop.php?page=".$i."'> ".$i." </a>
                                <li>
                                ";
                            };
                            
                            echo "
                                <li>
                                    <a href='shop.php?page=$total_pages'> ".'Trang cuối'." </a>
                                <li>
                            ";




                            
                        
                        ?>
                    </ul> <!-- pagination Finish -->
                </center>

                <?php 

                    getpcatpro(); 

                    gethang();
                    
                ?>
               
           </div><!-- col-md-9 Finish -->

           <div id="wait" style="position:absolute;top:40%;left:45%;padding: 200px 100px 100px 100px;"></div>
           
       </div><!-- container Finish -->
   </div><!-- #content Finish -->
   
   <?php 
    
    include("includes/footer.php");
    
    ?>
    
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
   
    
    
</body>
</html>