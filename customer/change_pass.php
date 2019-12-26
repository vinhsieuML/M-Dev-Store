<h1 align="center"> Đổi Mật Khẩu </h1>


<form action="" method="post"><!-- form Begin -->
    
    <div class="form-group"><!-- form-group Begin -->
        
        <label> Mật Khẩu Cũ: </label>
        
        <input type="text" name="old_pass" class="form-control" required>
        
    </div><!-- form-group Finish -->
    
    <div class="form-group"><!-- form-group Begin -->
        
        <label> Mật Khẩu Mới: </label>
        
        <input type="password" name="new_pass" class="form-control" required>
        
    </div><!-- form-group Finish -->
    
    <div class="form-group"><!-- form-group Begin -->
        
        <label> Nhập lại mật khẩu mới: </label>
        
        <input type="password" name="new_pass_again" class="form-control" required>
        
    </div><!-- form-group Finish -->
    
    <div class="text-center"><!-- text-center Begin -->
        
        <button type="submit" name="submit" class="btn btn-primary"><!-- btn btn-primary Begin -->
            
            <i class="fa fa-user-md"></i> Cập Nhật
            
        </button><!-- btn btn-primary inish -->
        
    </div><!-- text-center Finish -->
    
</form><!-- form Finish -->


<?php 

if(isset($_POST['submit'])){
    
    $c_email = $_SESSION['customer_email'];
    
    $c_old_pass = md5($_POST['old_pass']);
    
    $c_new_pass = $_POST['new_pass'];
    
    $c_new_pass_again = $_POST['new_pass_again'];
    
    $sel_c_old_pass = "select * from users where email='$c_email' and password = '$c_old_pass'";
    
    $run_c_old_pass = mysqli_query($con,$sel_c_old_pass);
    
    $check_c_old_pass = mysqli_fetch_array($run_c_old_pass);
    
    if($check_c_old_pass==0){
        
        echo "<script>alert('Mật khẩu cũ không đúng vui lòng thử lại')</script>";
        
        exit();
        
    }
    
    if($c_new_pass!=$c_new_pass_again){
        
        echo "<script>alert('Mật khẩu mới không trùng khớp')</script>";
        
        exit();
        
    }
    $c_new_pass = md5($c_new_pass);
    $update_c_pass = "update users set password='$c_new_pass' where email='$c_email'";
    
    $run_c_pass = mysqli_query($con,$update_c_pass);
    
    if($run_c_pass){
        
        echo "<script>alert('Thay đổi thành công, vui lòng đăng nhập lại)</script>";
        
        echo "<script>window.open('logout.php','_self')</script>";
        
    }
    
}

?>