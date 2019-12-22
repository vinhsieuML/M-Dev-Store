<?php

session_start();

$active = 'Cart';

include("includes/db.php");
include("functions/functions.php");

?>

<?php

if (isset($_GET['pro_id'])) {
    $product_id = $_GET['pro_id'];

    $get_product = "SELECT p.id, p.id_type ,p.description,p.id_hang ,p.name,p.price,GROUP_CONCAT(img.link) as link FROM product p JOIN images img on p.id = img.id_product where p.id='$product_id' GROUP BY p.id ";

    $run_product = mysqli_query($con, $get_product);

    $row_products = mysqli_fetch_array($run_product);

    $p_cat_id = $row_products['id_type'];

    $pro_title = $row_products['name'];

    $pro_price = $row_products['price'];


    $pro_desc = $row_products['description'];
    

    $get_link = "SELECT p.id, p.id_hang ,p.name,p.price,GROUP_CONCAT(img.link) as link FROM product p JOIN images img on p.id = img.id_product WHERE p.id='$product_id' GROUP BY p.id ";
    $run_link = mysqli_query($con, $get_link);
    $row_link = mysqli_fetch_array($run_link);
    


    $pro_link = $row_link['link'];



    

    $get_p_cat = "select * from product_type where id='$p_cat_id'";

    $run_p_cat = mysqli_query($con, $get_p_cat);

    $row_p_cat = mysqli_fetch_array($run_p_cat);

    $p_cat_title = $row_p_cat['name'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SH Shop</title>
    <link rel="stylesheet" href="styles/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>

    <div id="top">
        <!-- Top Begin -->

        <div class="container">
            <!-- container Begin -->

            <div class="col-md-6 offer">
                <!-- col-md-6 offer Begin -->

                <a href="#" class="btn btn-success btn-sm">

                    <?php

                    if (!isset($_SESSION['customer_email'])) {
                        echo "Welcome: Guest";
                    } else {
                        echo "Welcome: " . $_SESSION['customer_email'] . "";
                    }

                    ?>

                </a>
                <a href="checkout.php"><?php items(); ?> Items In Your Cart | Total Price: <?php total_price(); ?> </a>

            </div><!-- col-md-6 offer Finish -->

            <div class="col-md-6">
                <!-- col-md-6 Begin -->

                <ul class="menu">
                    <!-- cmenu Begin -->

                    <li>
                        <a href="customer_register.php">Đăng ký</a>
                    </li>
                    <li>
                        <a href="checkout.php">My Account</a>
                    </li>
                    <li>
                        <a href="cart.php">Giỏ hàng</a>
                    </li>
                    <li>
                        <a href="checkout.php">

                            <?php

                            if (!isset($_SESSION['customer_email'])) {
                                echo "<a href='checkout.php'> Login </a>";
                            } else {
                                echo " <a href='logout.php'> Log Out </a> ";
                            }

                            ?>

                        </a>
                    </li>

                </ul><!-- menu Finish -->

            </div><!-- col-md-6 Finish -->

        </div><!-- container Finish -->

    </div><!-- Top Finish -->

    <div id="navbar" class="navbar navbar-default">
        <!-- navbar navbar-default Begin -->

        <div class="container">
            <!-- container Begin -->

            <div class="navbar-header">
                <!-- navbar-header Begin -->

                <a href="index.php" class="navbar-brand home">
                    <!-- navbar-brand home Begin -->

                    <img src="images/logo2.png" alt="M-dev-Store Logo" class="hidden-xs">
                   <img src="images/logo-res.png" alt="M-dev-Store Logo Mobile" class="visible-xs">
                   
                </a><!-- navbar-brand home Finish -->

                <button class="navbar-toggle" data-toggle="collapse" data-target="#navigation">

                    <span class="sr-only">Toggle Navigation</span>

                    <i class="fa fa-align-justify"></i>

                </button>

                <button class="navbar-toggle" data-toggle="collapse" data-target="#search">

                    <span class="sr-only">Toggle Search</span>

                    <i class="fa fa-search"></i>

                </button>

            </div><!-- navbar-header Finish -->

            <div class="navbar-collapse collapse" id="navigation">
                <!-- navbar-collapse collapse Begin -->

                <div class="padding-nav">
                    <!-- padding-nav Begin -->

                    <ul class="nav navbar-nav left">
                        <!-- nav navbar-nav left Begin -->

                        <li class="<?php if ($active == 'Home') {
                                echo "active";
                            } ?>">
                            <a href="index.php">Trang chủ</a>
                        </li>
                        <li class="<?php if ($active == 'Shop') {
                                echo "active";
                            } ?>">
                            <a href="shop.php">Cửa hàng</a>
                        </li>
                        
                        <li class="<?php if ($active == 'Contact') {
                                echo "active";
                            } ?>">
                            <a href="contact.php">Liên hệ</a>
                        </li>

                    </ul><!-- nav navbar-nav left Finish -->

                </div><!-- padding-nav Finish -->

                <a href="cart.php" class="btn navbar-btn btn-primary right">
                    <!-- btn navbar-btn btn-primary Begin -->

                    <i class="fa fa-shopping-cart"></i>

                    <span><?php items(); ?> Items In Your Cart</span>

                </a><!-- btn navbar-btn btn-primary Finish -->

                <div class="navbar-collapse collapse right">
                    <!-- navbar-collapse collapse right Begin -->

                    <button class="btn btn-primary navbar-btn" type="button" data-toggle="collapse" data-target="#search">
                        <!-- btn btn-primary navbar-btn Begin -->

                        <span class="sr-only">Toggle Search</span>

                        <i class="fa fa-search"></i>

                    </button><!-- btn btn-primary navbar-btn Finish -->

                </div><!-- navbar-collapse collapse right Finish -->

                <div class="collapse clearfix" id="search">
                    <!-- collapse clearfix Begin -->

                    <form method="get" action="results.php" class="navbar-form">
                        <!-- navbar-form Begin -->

                        <div class="input-group">
                            <!-- input-group Begin -->

                            <input type="text" class="form-control" placeholder="Search" name="user_query" required>

                            <span class="input-group-btn">
                                <!-- input-group-btn Begin -->

                                <button type="submit" name="search" value="Search" class="btn btn-primary">
                                    <!-- btn btn-primary Begin -->

                                    <i class="fa fa-search"></i>

                                </button><!-- btn btn-primary Finish -->

                            </span><!-- input-group-btn Finish -->

                        </div><!-- input-group Finish -->

                    </form><!-- navbar-form Finish -->

                </div><!-- collapse clearfix Finish -->

            </div><!-- navbar-collapse collapse Finish -->

        </div><!-- container Finish -->

    </div><!-- navbar navbar-default Finish -->

    <div id="content">
        <!-- #content Begin -->
        <div class="container">
            <!-- container Begin -->
            <div class="col-md-12">
                <!-- col-md-12 Begin -->

                <ul class="breadcrumb">
                    <!-- breadcrumb Begin -->
                    <li>
                        <a href="index.php">Trang chủ</a>
                    </li>
                    <li>
                        <a href="shop.php">Cửa hàng</a>
                    </li>

                    <li>
                        <a href="shop.php?p_cat=<?php echo $p_cat_id; ?>"><?php echo $p_cat_title; ?></a>
                    </li>
                    <li> <?php echo $pro_title; ?> </li>
                </ul><!-- breadcrumb Finish -->

            </div><!-- col-md-12 Finish -->

            <div class="col-md-12">
                <!-- col-md-12 Begin -->
                <div id="productMain" class="row">
                    <!-- row Begin -->
                    <div class="col-sm-6">
                        <!-- col-sm-6 Begin -->
                        <div id="mainImage">
                            <!-- #mainImage Begin -->
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- carousel slide Begin -->
                                <ol class="carousel-indicators">
                                    <!-- carousel-indicators Begin -->
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                    <li data-target="#myCarousel" data-slide-to="2"></li>
                                </ol><!-- carousel-indicators Finish -->

                                <div class="carousel-inner">
                                    <?php
                                            foreach (preg_split("/\,/", $pro_link) as $key=>$value) {
                                                if ($key==0) {
                                                    echo "
                                                <div class='item active'>
                                                    <center><img class='img-responsive' src='admin_area/product_images/$value' alt='Product 3-a'></center>
                                                </div>";
                                                } else {
                                                    echo "
                                            <div class='item'>
                                                <center><img class='img-responsive' src='admin_area/product_images/$value' alt='Product 3-a'></center>
                                            </div>";
                                                }
                                            }

                                    ?>
                                
                                </div>

                                <a href="#myCarousel" class="left carousel-control" data-slide="prev">
                                    <!-- left carousel-control Begin -->
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                </a><!-- left carousel-control Finish -->

                                <a href="#myCarousel" class="right carousel-control" data-slide="next">
                                    <!-- right carousel-control Begin -->
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                </a><!-- right carousel-control Finish -->

                            </div><!-- carousel slide Finish -->
                        </div><!-- mainImage Finish -->


                    </div><!-- col-sm-6 Finish -->

                    <div class="col-sm-6">
                        <!-- col-sm-6 Begin -->
                        <div class="box">
                            <h1 class="text-center"> <?php echo $pro_title; ?> </h1>

                            <?php add_cart(); ?>

                            <form action="details.php?add_cart= <?php echo $product_id; ?>" class="form-horizontal" method="post">
                                <!--form-horizontal Begin-->
                                <div class="form-group">
                                    <!-- form-group Begin-->
                                    <label for="" class="col-md-5 control-label">Số lượng </label>

                                    <div class="col-md-7">
                                        <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                                        <input type="number" id="number" value="1" name='product_qty' readonly />
                                        <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
                                        <script>
                                            function increaseValue() {
                                                var value = parseInt(document.getElementById('number').value, 10);
                                                value = isNaN(value) ? 0 : value;
                                                value++;
                                                document.getElementById('number').value = value;
                                            }

                                            function decreaseValue() {
                                                var value = parseInt(document.getElementById('number').value, 10);
                                                value = isNaN(value) ? 0 : value;
                                                value < 2 ? value = 2 : '';
                                                value--;
                                                document.getElementById('number').value = value;
                                            }
                                        </script>
                                        <!-- <input class="form-control"  type="number" id="number" value="1" min="1" oninput="this.value = Math.abs(this.value)" disable /> -->
                                        <!-- <select name="product_qty" id="" class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select> -->


                                    </div>

                                </div> <!-- form-group Finish-->
                                <br>

                                <div class="form-group">
                                    <!-- form-group Begin-->
                                    <label class="col-md-5 control-label">Chọn size</label>

                                    <div class="col-md-7">
                                        
                                


                                <?php
                                  $get_link = "SELECT * from size s JOIN size_detail dt on dt.id_size = s.id where s.id_type = $p_cat_id and dt.number>0 and dt.id_product = $product_id";

                             
                                  $run_link = mysqli_query($con, $get_link);
                                 

                                ?>

                                <select name="product_size" class="setw">      
                                <?php
                                while ( $row_link = mysqli_fetch_array($run_link)) {
                                echo "<option >".$row_link['name']."</option>";
                                }
                                ?>        
                                </select>



                                      
                                    </div>
                                </div> <!-- form-group Finish-->
                                <hr>
                                <p class="price"> <?php echo  number_format($pro_price , 0, ',', '.');  ?> VNĐ</p>

                                <p class="text-center button"><button class="btn btn-primary i fa fa-shopping-cart"><strong> Thêm vào giỏ </strong></button></p>

                            </form>
                            <!--form-horizontal Finish-->
                        </div>

                        <div class="row" id="thumbs">
                            <!-- row Begin -->

                            <?php
                                            foreach (preg_split("/\,/", $pro_link) as $key=>$value) {
                                                echo "
                                                <div class='col-xs-4'>
                                                <a data-target='#myCarousel' data-slide-to='$key' href='#' class='thumbs'>
                                                    <img src='admin_area/product_images/$value' alt='' class='img-responsive'>
                                                </a>
                                                </div>
                                                ";
                                            }
                                          

                            ?>

                           



                        </div> <!-- row Begin -->
                    </div> <!-- col-sm-6 Finish -->


                </div><!-- row Finish -->

                <div class="box" id="details">
                    <!-- box Begin -->

                    <h4> <font size="6">Chi tiết sản phẩm</font> </h4>

                    <p>

                        <?php echo $pro_desc; ?>

                    </p>


                    <hr>

                </div><!-- box Finish -->

                <div id="row same-heigh-row">
                    <!-- #row same-heigh-row Begin -->
                    <div class="col-md-3 col-sm-6">
                        <!-- col-md-3 col-sm-6 Begin -->
                        <div class="box same-height headline">
                            <!-- box same-height headline Begin -->
                            <h3 class="text-center">Sản phẩm <br> bạn có <br> thể thích</h3>
                        </div><!-- box same-height headline Finish -->
                    </div><!-- col-md-3 col-sm-6 Finish -->

                    <?php

                    $get_products = "select * from product order by rand() LIMIT 0,3";
                    $get_products = "SELECT p.id, p.name,p.price,GROUP_CONCAT(img.link) as link FROM product p JOIN images img on p.id = img.id_product GROUP BY p.id order by rand() LIMIT 0,3";
                    

                    $run_products = mysqli_query($con, $get_products);

                    while ($row_products = mysqli_fetch_array($run_products)) {
                        $pro_id = $row_products['id'];

                        $pro_title = $row_products['name'];

                        $pro_price = $row_products['price'];
                        $pro_price_f = number_format($pro_price , 0, ',', '.');

                     
                        $pro_link =preg_split("/\,/", $row_products['link'])[0];

                        

                       
                       

                        echo "
                    
                    <div class='col-md-3 col-sm-6 center-responsive'>
                    
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
            
                                        <i class='fa fa-shopping-cart'></i> Thêm vào giỏ
            
                                    </a>
                                
                                </p>
                            
                            </div>
            
                            
                        
                        </div>
                    
                    </div>
                    
                    ";
                    }

                    ?>

                </div><!-- #row same-heigh-row Finish -->

            </div><!-- col-md-12 Finish -->

        </div><!-- container Finish -->
    </div><!-- #content Finish -->

    <?php

    include("includes/footer.php");

    ?>

    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>


</body>

</html>