<?php 
    session_start();
    include('../includes/db.php');
    if(!isset($_SESSION['customer_email'])){
        
        echo "<script>window.open('../checkout.php','_self')</script>";
        
    }else{

?>

<?php 

    if(isset($_GET['order_id'])){
        
        $id = $_GET['order_id'];
        
        $delete_order = "UPDATE bill SET status = '4' where id='$id'";
        
        $run_delete = mysqli_query($con,$delete_order);
        
        if($run_delete){
            
            echo "<script>alert('Đã nhận thành công đơn hàng')</script>";
            
            echo "<script>window.open('my_account.php?my_orders','_self')</script>";
            
        }
        
    }

?>

<?php } ?>