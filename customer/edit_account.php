<?php 

$customer_session = $_SESSION['customer_email'];

$get_customer = "select * from users where email='$customer_session'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['id'];

$customer_name = $row_customer['name'];

$customer_email = $row_customer['email'];

$customer_contact = $row_customer['phone'];

$customer_address = $row_customer['address'];

?>

<h1 align="center"> Chỉnh sửa tài khoản </h1>

<form action="" method="post" enctype="multipart/form-data"><!-- form Begin -->
    
    <div class="form-group"><!-- form-group Begin -->
        
        <label> Tên Của Bạn: </label>
        
        <input type="text" name="c_name" class="form-control" value="<?php echo $customer_name; ?>" required>
        
    </div><!-- form-group Finish -->
    
    <div class="form-group"><!-- form-group Begin -->
        
        <label> Email: </label>
        
        <input type="text" name="c_email" class="form-control" value="<?php echo $customer_email;?>" readonly required>
        
    </div><!-- form-group Finish -->
    
    
    <div class="form-group"><!-- form-group Begin -->
        
        <label> Số Điện Thoại: </label>
        
        <input type="text" name="c_contact" class="form-control" value="<?php echo $customer_contact; ?>" required>
        
    </div><!-- form-group Finish -->
    
    <div class="form-group"><!-- form-group Begin -->
        
        <label> Địa Chỉ: </label>
        
        <input type="text" name="c_address" class="form-control" value="<?php echo $customer_address; ?>" required>
        
    </div><!-- form-group Finish -->
    
    
    <div class="text-center"><!-- text-center Begin -->
        
        <button name="update" class="btn btn-primary"><!-- btn btn-primary Begin -->
            
            <i class="fa fa-user-md"></i> Cập Nhật
            
        </button><!-- btn btn-primary inish -->
        
    </div><!-- text-center Finish -->
    
</form><!-- form Finish -->

<?php 

if(isset($_POST['update'])){
    
    $update_id = $customer_id;
    
    $c_name = $_POST['c_name'];

    $c_address = $_POST['c_address'];
    
    $c_contact = $_POST['c_contact'];
    
    $update_customer = "update users set name='$c_name',address='$c_address',phone='$c_contact' where id='$update_id' ";
    
    $run_customer = mysqli_query($con,$update_customer);
    
    if($run_customer){
        
        echo "<script>alert('Cập Nhật Thành Công')</script>";
        
        // echo "<script>window.open('logout.php','_self')</script>";
        
    }
    
}

?>