<div class="box"><!-- box Begin -->
   
   <?php 
    
    $session_email = $_SESSION['customer_email'];
    
    $select_customer = "select * from users where email='$session_email'";
    
    $run_customer = mysqli_query($con,$select_customer);
    
    $row_customer = mysqli_fetch_array($run_customer);
    
    $customer_id = $row_customer['id'];
    
    ?>
    
    <h1 class="text-center">Lựa chọn thanh toán</h1>  
    
     <p class="lead text-center"><!-- lead text-center Begin -->
         
         <a href="order.php?c_id=<?php echo $customer_id ?>"> Thanh toán CASH ON DELIVERY (COD) </a>
         
     </p><!-- lead text-center Finish -->
     
     <center><!-- center Begin -->
         
        <p class="lead"><!-- lead Begin -->
            
            <a href="#">
                
                Thanh Toán Online
                
                <!-- <img class="img-responsive" src="images/paypall_img.png" alt="img-paypall"> -->
                
            </a>
            
        </p> <!-- lead Finish -->
         
     </center><!-- center Finish -->
    
</div><!-- box Finish -->