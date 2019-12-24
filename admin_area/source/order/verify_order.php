<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<?php 

    if(isset($_GET['verify_order'])){
        
        $verify_id = $_GET['verify_order'];
        
        $delete_order = "UPDATE  bill SET status = '3' where id='$verify_id'";
        
        $run_delete = mysqli_query($con,$delete_order);
        
        if($run_delete){
            
            echo "<script>alert('Xác nhận thành công hay giao hàng cho bên vận chuyển')</script>";
            
            echo "<script>window.open('index.php?view_orders','_self')</script>";
            
        }
        
    }

?>

<?php } ?>