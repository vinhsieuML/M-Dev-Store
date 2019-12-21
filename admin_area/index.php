<?php 

    session_start();
    include("includes/db.php");
    include("../functions/functions.php");
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{
        
        $admin_session = $_SESSION['admin_email'];
        
        $get_admin = "select * from admin where email='$admin_session'";
        
        $run_admin = mysqli_query($con,$get_admin);
        
        $row_admin = mysqli_fetch_array($run_admin);
        
        $admin_id = $row_admin['admin_id'];
        
        $admin_name = $row_admin['admin_name'];
        
        $admin_email = $row_admin['admin_email'];
        
        $admin_image = $row_admin['admin_image'];
        
        $admin_country = $row_admin['admin_country'];
        
        $admin_about = $row_admin['admin_about'];
        
        $admin_contact = $row_admin['admin_contact'];
        
        $admin_job = $row_admin['admin_job'];
        
        $get_products = "select * from product";
        
        $run_products = mysqli_query($con,$get_products);
        
        $count_products = mysqli_num_rows($run_products);
        
        $get_customers = "select * from users";
        
        $run_customers = mysqli_query($con,$get_customers);
        
        $count_customers = mysqli_num_rows($run_customers);
        
        $get_p_categories = "select * from product_type";
        
        $run_p_categories = mysqli_query($con,$get_p_categories);
        
        $count_p_categories = mysqli_num_rows($run_p_categories);
        
        $get_pending_orders = "select * from bill where status = 0";
        
        $run_pending_orders = mysqli_query($con,$get_pending_orders);
        
        $count_pending_orders = mysqli_num_rows($run_pending_orders);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>M-Dev Store Admin Area</title>
    <link rel="stylesheet" href="css/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>

    <div id="wrapper"><!-- #wrapper begin -->
       
       <?php include("includes/sidebar.php"); ?>
       
        <div id="page-wrapper"><!-- #page-wrapper begin -->
            <div class="container-fluid"><!-- container-fluid begin -->
                
                <?php
                
                    if(isset($_GET['dashboard'])){
                        
                        include("dashboard.php");
                        
                }   if(isset($_GET['insert_product'])){
                        
                        include("./source/product/insert_product.php");
                        
                }   if(isset($_GET['view_products'])){
                        
                        include("./source/product/view_products.php");
                        
                }   if(isset($_GET['delete_product'])){
                        
                        include("./source/product/delete_product.php");
                        
                }   if(isset($_GET['edit_product'])){
                        
                        include("./source/product/edit_product.php");
                        
                }   if(isset($_GET['insert_p_cat'])){
                        
                        include("./source/Product_type/insert_p_cat.php");
                        
                }   if(isset($_GET['view_p_cats'])){
                        
                        include("./source/Product_type/view_p_cats.php");
                        
                }   if(isset($_GET['delete_p_cat'])){
                        
                        include("./source/Product_type/delete_p_cat.php");
                        
                }   if(isset($_GET['edit_p_cat'])){
                        
                        include("./source/Product_type/edit_p_cat.php");
                        
                }   if(isset($_GET['insert_size'])){
                        
                        include("./source/size/insert_size.php");
                        
                }   if(isset($_GET['view_size'])){
                        
                        include("./source/size/view_size.php");
                        
                }   if(isset($_GET['edit_size'])){
                        
                        include("./source/size/edit_size.php");
                        
                }   if(isset($_GET['delete_size'])){
                        
                        include("./source/size/delete_size.php");
                        
                }   if(isset($_GET['insert_slide'])){
                        
                        include("./source/slider/insert_slide.php");
                        
                }   if(isset($_GET['view_slides'])){
                        
                        include("./source/slider/view_slides.php");
                        
                }   if(isset($_GET['delete_slide'])){
                        
                        include("./source/slider/delete_slide.php");
                        
                }   if(isset($_GET['edit_slide'])){
                        
                        include("./source/slider/edit_slide.php");
                        
                }   if(isset($_GET['insert_box'])){
                        
                        include("./source/box/insert_box.php");
                        
                }   if(isset($_GET['view_boxes'])){
                        
                        include("./source/box/view_boxes.php");
                        
                }   if(isset($_GET['delete_box'])){
                        
                        include("./source/box/delete_box.php");
                        
                }   if(isset($_GET['edit_box'])){
                        
                        include("./source/box/edit_box.php");
                        
                }   if(isset($_GET['view_customers'])){
                        
                        include("./source/customer/view_customers.php");
                        
                }   if(isset($_GET['delete_customer'])){
                        
                        include("./source/customer/delete_customer.php");
                        
                }   if(isset($_GET['view_orders'])){
                        
                        include("./source/order/view_orders.php");
                        
                }   if(isset($_GET['delete_order'])){
                        
                        include("./source/order/delete_order.php");
                        
                }   if(isset($_GET['view_payments'])){
                        
                        include("view_payments.php");
                        
                }   if(isset($_GET['delete_payment'])){
                        
                        include("delete_payment.php");
                        
                }   if(isset($_GET['view_users'])){
                        
                        include("./source/admin/view_users.php");
                        
                }   if(isset($_GET['delete_user'])){
                        
                        include("./source/admin/delete_user.php");
                        
                }   if(isset($_GET['insert_user'])){
                        
                        include("./source/admin/insert_user.php");
                        
                }   if(isset($_GET['user_profile'])){
                        
                        include("./source/admin/user_profile.php");
                        
                }   if(isset($_GET['insert_terms'])){
                        
                        include("./source/term/insert_terms.php");
                        
                }   if(isset($_GET['view_terms'])){
                        
                        include("./source/term/view_terms.php");
                        
                }   if(isset($_GET['delete_term'])){
                        
                        include("./source/term/delete_term.php");
                        
                }   if(isset($_GET['edit_term'])){
                        
                        include("./source/term/edit_term.php");
                        
                }   if(isset($_GET['edit_css'])){
                        
                        include("edit_css.php");
                        
                }   if(isset($_GET['insert_manufacturer'])){
                        
                        include("./source/hang/insert_manufacturer.php");
                        
                }   if(isset($_GET['view_manufacturers'])){
                        
                        include("./source/hang/view_manufacturers.php");
                        
                }   if(isset($_GET['delete_manufacturer'])){
                        
                        include("./source/hang/delete_manufacturer.php");
                        
                }   if(isset($_GET['edit_manufacturer'])){
                        
                        include("./source/hang/edit_manufacturer.php");
                        
                }   if(isset($_GET['insert_coupon'])){
                        
                        include("./source/coupon/insert_coupon.php");
                        
                }   if(isset($_GET['view_coupons'])){
                        
                        include("./source/coupon/view_coupons.php");
                        
                }   if(isset($_GET['delete_coupon'])){
                        
                        include("./source/coupon/delete_coupon.php");
                        
                }   if(isset($_GET['edit_coupon'])){
                        
                        include("./source/coupon/edit_coupon.php");
                        
                }
        
                ?>
                
            </div><!-- container-fluid finish -->
        </div><!-- #page-wrapper finish -->
    </div><!-- wrapper finish -->

<script src="js/bootstrap-337.min.js"></script>       
</body>
</html>


<?php } ?>