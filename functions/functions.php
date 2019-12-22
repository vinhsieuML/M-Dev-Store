<?php 

$db = mysqli_connect("localhost","root","","db_app");



function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }

/// begin getRealIpUser functions ///

function checkUpload($file){
    if(isset($file)){
        $errors= array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
         
        $expensions= array("jpeg","jpg","png");
         
        if(in_array($file_ext,$expensions)=== false){
           $errors[]="Chỉ hỗ trợ upload file JPEG hoặc PNG.";
        }
         
        if($file_size > 2097152) {
           $errors[]='Kích thước file không được lớn hơn 2MB';
        }
         
        if(empty($errors)==true) {
           move_uploaded_file($file_tmp,"images/".$file_name);
           echo "Success";
        }else{
           print_r($errors);
        }
     }
}


function getRealIpUser(){
    
    switch(true){
            
            case(!empty($_SERVER['HTTP_X_REAL_IP'])) : 
                console_log($_SERVER['HTTP_X_REAL_IP']);
                return $_SERVER['HTTP_X_REAL_IP'];
            case(!empty($_SERVER['HTTP_CLIENT_IP'])) : 
                console_log($_SERVER['HTTP_CLIENT_IP']);
                return $_SERVER['HTTP_CLIENT_IP'];
            case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : 
                console_log($_SERVER['HTTP_X_FORWARDED_FOR']);
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            
            default : return $_SERVER['REMOTE_ADDR'];
            
    }
    
}

/// finish getRealIpUser functions ///

/// begin add_cart functions ///

function add_cart(){
    
    global $db;
    
    if(isset($_GET['add_cart'])){
        
        $ip_add = getRealIpUser();
        
        $p_id = $_GET['add_cart'];
        
        $product_qty = $_POST['product_qty'];
        
        $product_size = $_POST['product_size'];
        
        $check_product = "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
        
        $run_check = mysqli_query($db,$check_product);
        
        if(mysqli_num_rows($run_check)>0){
            
            echo "<script>alert('This product has already added in cart')</script>";
            echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
            
        }else{

            $get_price ="select * from products where product_id='$p_id'";

            $run_price = mysqli_query($db,$get_price);

            $row_price = mysqli_fetch_array($run_price);

            $pro_price = $row_price['product_price'];

            $pro_sale = $row_price['product_sale'];

            $pro_label = $row_price['product_label'];

            if($pro_label == "sale"){

                $product_price = $pro_sale;

            }else{

                $product_price = $pro_price;

            }
            
            $query = "insert into cart (p_id,ip_add,qty,p_price,size) values ('$p_id','$ip_add','$product_qty','$product_price','$product_size')";
            
            $run_query = mysqli_query($db,$query);
            
            echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
            
        }
        
    }
    
}

/// finish add_cart functions ///

/// begin getPro functions ///

function getPro(){
    
    global $db;
    
    $get_products = "SELECT p.id, p.name,p.price,GROUP_CONCAT(img.link) as link FROM product p JOIN images img on p.id = img.id_product GROUP BY p.id order by 1 DESC LIMIT 0,8";
    
    $run_products = mysqli_query($db,$get_products);
    
    while($row_products=mysqli_fetch_array($run_products)){
        
        $pro_id = $row_products['id'];
        
        $pro_title = $row_products['name'];
        
        $pro_price = $row_products['price'];

        $pro_price_f = number_format($pro_price , 0, ',', '.');

        // $pro_sale_price = $row_products['product_sale'];
        
        $pro_link =preg_split("/\,/", $row_products['link'])[0];
        
      
        
        echo "
        
        <div class='col-md-4 col-sm-6 single'>
        
            <div class='product eff'>
            
                <a href='details.php?pro_id=$pro_id'>
                
                    <img class='img-responsive' src='admin_area/product_images/$pro_link'>
                
                </a>
                
                <div class='text'>

               
                
                    <h3 class='pad_h'>
            
                        <a href='details.php?pro_id=$pro_id'>

                            $pro_title

                        </a>
                    
                    </h3>
                    
                    <p class='price'>
                    
                    $pro_price_f VNĐ
                    
                    </p>
                    
                    <p class='button'>
                    
                        <a class='btn btn-default' href='details.php?pro_id=$pro_id'>

                            Chi tiết

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

/// finish getPro functions ///

/// begin getPCats functions ///

function getPCats(){
    
    global $db;
    
    $get_p_cats = "select * from product_type";
    
    $run_p_cats = mysqli_query($db,$get_p_cats);
    
    while($row_p_cats=mysqli_fetch_array($run_p_cats)){
        
        $p_cat_id = $row_p_cats['id'];
        
        $p_cat_title = $row_p_cats['name'];
        
        echo "
        
            <li class='mar_bot'>
            
                <a href='shop.php?p_cat=$p_cat_id'> $p_cat_title </a>
            
            </li>
        
        ";
        
    }
    
}
    
/// finish getPCats functions ///

/// begin getCats functions ///

function getCats(){
    
    global $db;
    
    $get_cats = "select * from hang";
    
    $run_cats = mysqli_query($db,$get_cats);
    
    while($row_cats=mysqli_fetch_array($run_cats)){
        
        $cat_id = $row_cats['id'];
        
        $cat_title = $row_cats['name'];
        
        echo "
        
            <li class='mar_bot'>
                
                <a href='shop.php?cat=$cat_id'> $cat_title </a>
            
            </li>
        
        ";
        
    }
    
}

function gethang(){

    global $db;

    if(isset($_GET['cat'])){

        $cat_id = $_GET['cat'];

        $get_cat = "select * from hang where id='$cat_id' ";

        $run_cat = mysqli_query($db,$get_cat);

        $row_cat = mysqli_fetch_array($run_cat);

        $cat_title = $row_cat['name'];

        

        $get_cat = "SELECT p.id, p.id_hang ,p.name,p.price,GROUP_CONCAT(img.link) as link FROM product p JOIN images img on p.id = img.id_product where id_hang='$cat_id' GROUP BY p.id LIMIT 0,6";

        $run_products = mysqli_query($db,$get_cat);

        $count = mysqli_num_rows($run_products);

        if($count==0){
            echo "
                <div class='box'>

                    <h1> Không có sản phẩm nào </h1>
                    
                </div>
            
            ";

        } else{

            echo"
            <div class='box'>

            <h1> $cat_title </h1>

            
            
            </div>
            ";
        }

        while($row_products=mysqli_fetch_array($run_products)){

            $pro_id = $row_products['id'];

            $pro_title = $row_products['name'];
    
            $pro_price = $row_products['price'];
            $pro_price_f = number_format($pro_price, 0, ',', '.');

    
            $pro_link =preg_split("/\,/", $row_products['link'])[0];
        

            echo "
            
            <div class='col-md-4 col-sm-6 center-responsive'>
                
            <div class='product eff'>
                <a href='details.php?pro_id=$pro_id'>
                    <img class='img-responsive' src='admin_area/product_images/$pro_link'>
                </a>

                <div class='text'>
                    <h3 class='pad_h'>
                        <a href='details.php?pro_id=$pro_id' class='pro_title_size'>
                            $pro_title
                        </a>
                    </h3>

                    <p class='price'>
                        <strong>  $pro_price_f VNĐ </strong>
                    </p>

                    <p class='button'>
                        <a class='btn btn-default' href='details.php?pro_id=$pro_id'>
                            Chi tiết
                        </a>

                        <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>
                            <i class='fa fa-shoping-cart'></i> Thêm vào giỏ hàng
                        </a>
                    </p>
                </div>

            </div>

        </div>

            ";
        }

    }

}


function getpcatpro(){
    global $db;
    if(isset($_GET['p_cat'])){
        $p_cat_id = $_GET['p_cat'];

        $get_p_cat = "select * from product_type where id='$p_cat_id'";

        $run_p_cat = mysqli_query($db,$get_p_cat);

        $row_p_cat = mysqli_fetch_array($run_p_cat);

        $p_cat_title = $row_p_cat['name'];

        $cat_id = $row_p_cat['id'];


        $get_products = "SELECT p.id, p.id_hang ,p.name,p.price,GROUP_CONCAT(img.link) as link FROM product p JOIN images img on p.id = img.id_product where id_type='$cat_id' GROUP BY p.id LIMIT 0,6";

        $run_products = mysqli_query($db,$get_products);

        $count = mysqli_num_rows($run_products);

        if($count==0)
        {
            echo"
                <div class='box'>

                    <h1> Không có sản phẩm nào </h1>

                </div>
            ";
        }else{
            
            echo"
                <div class='box'>

                    <h1> $p_cat_title </h1>

                   

                </div>
            ";

        }
        
        while($row_products=mysqli_fetch_array($run_products)){

            $pro_id = $row_products['id'];

            $pro_title = $row_products['name'];
    
            $pro_price = $row_products['price'];
            $pro_price_f = number_format($pro_price, 0, ',', '.');

    
            $pro_link =preg_split("/\,/", $row_products['link'])[0];
        

            echo "
            
            <div class='col-md-4 col-sm-6 center-responsive'>
                
            <div class='product eff'>
                <a href='details.php?pro_id=$pro_id'>
                    <img class='img-responsive' src='admin_area/product_images/$pro_link'>
                </a>

                <div class='text'>
                    <h3 class='pad_h'>
                        <a href='details.php?pro_id=$pro_id' class='pro_title_size'>
                            $pro_title
                        </a>
                    </h3>

                    <p class='price'>
                        <strong>  $pro_price_f VNĐ </strong>
                    </p>

                    <p class='button'>
                        <a class='btn btn-default' href='details.php?pro_id=$pro_id'>
                            Chi tiết
                        </a>

                        <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>
                            <i class='fa fa-shoping-cart'></i> Thêm vào giỏ hàng
                        </a>
                    </p>
                </div>

            </div>

        </div>

            ";
        }
    }
}
    
/// finish getCats functions ///

/// finish getRealIpUser functions ///

function items(){
    
    global $db;
    
    $ip_add = getRealIpUser();
    
    $get_items = "select * from cart where ip_add='$ip_add'";
    
    $run_items = mysqli_query($db,$get_items);
    
    $count_items = mysqli_num_rows($run_items);
    
    echo $count_items;
    
}

/// finish getRealIpUser functions ///

/// begin total_price functions ///

function total_price(){
    
    global $db;
    
    $ip_add = getRealIpUser();
    
    $total = 0;
    
    $select_cart = "select * from cart where ip_add='$ip_add'";
    
    $run_cart = mysqli_query($db,$select_cart);
    
    while($record=mysqli_fetch_array($run_cart)){
        
        $pro_id = $record['p_id'];
        
        $pro_qty = $record['qty'];
            
        $sub_total = $record['p_price']*$pro_qty;
            
        $total += $sub_total;
        
    }
    
    echo "$" . $total;
    
}

/// finish total_price functions ///

/// Begin getProducts(); functions ///

function getProducts(){

    global $db;
    $aWhere = array();

    if(!isset($_GET['p_cat'])){
    if (!isset($_GET['cat'])) {
        $per_page=6;

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page=1;
        }

        $start_from = ($page-1) * $per_page;
        $sLimit = " order by 1 DESC LIMIT $start_from,$per_page";
        
        $get_products = "SELECT p.id, p.id_hang ,p.name,p.price,GROUP_CONCAT(img.link) as link FROM product p JOIN images img on p.id = img.id_product GROUP BY p.id".$sLimit;
        $run_products = mysqli_query($db, $get_products);
        while ($row_products=mysqli_fetch_array($run_products)) {
            $pro_id = $row_products['id'];
        
            $pro_title = $row_products['name'];
        
            $pro_price = $row_products['price'];

            $pro_price_f = number_format($pro_price, 0, ',', '.');

            // $pro_sale_price = $row_products['product_sale'];
        
            $pro_link =preg_split("/\,/", $row_products['link'])[0];
        
            // $pro_label = $row_products['product_label'];
        
            $manufacturer_id = $row_products['id_hang'];

            $get_manufacturer = "select * from hang where id='$manufacturer_id'";

            $run_manufacturer = mysqli_query($db, $get_manufacturer);

            $row_manufacturer = mysqli_fetch_array($run_manufacturer);

            $manufacturer_title = $row_manufacturer['name'];

        

        
            echo "
        
        <div class='col-md-4 col-sm-6 center-responsive'>
        
            <div class='product eff'>
            
                <a href='details.php?pro_id=$pro_id'>
                
                    <img class='img-responsive' src='admin_area/product_images/$pro_link'>
                
                </a>
                
                <div class='text'>

               
                
                    <h3 class='pad_h'>
            
                        <a href='details.php?pro_id=$pro_id'>

                            $pro_title

                        </a>
                    
                    </h3>
                    
                    <p class='price'>
                        $pro_price_f VNĐ
                    </p>
                    
                    <p class='button'>
                    
                        <a class='btn btn-default' href='details.php?pro_id=$pro_id'>

                            Chi tiết

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

}



/// finish getProducts(); functions ///

/// begin getPaginator(); functions ///



/// finish getPaginator(); functions ///

?>