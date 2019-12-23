<div class="box">
    <!-- box Begin -->

    <div class="box-header">
        <!-- box-header Begin -->

        <center>
            <!-- center Begin -->

            <h1> Đăng nhập </h1>

            <!-- <p class="lead"> Already have our account..? </p>
          
          <p class="text-muted"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, maxime. Laudantium omnis, ullam, fuga officia provident error corporis consectetur aliquid corrupti recusandae minus ipsam quasi. Perspiciatis nemo, nostrum magni odit! </p>
           -->
        </center><!-- center Finish -->

    </div><!-- box-header Finish -->

    <form method="post" action="checkout.php">
        <!-- form Begin -->

        <div class="form-group">
            <!-- form-group Begin -->

            <label> Email </label>

            <input name="c_email" type="text" class="form-control" required>

        </div><!-- form-group Finish -->

        <div class="form-group">
            <!-- form-group Begin -->

            <label> Mật khẩu </label>

            <input name="c_pass" type="password" class="form-control" required>

        </div><!-- form-group Finish -->

        <div class="text-center">
            <!-- text-center Begin -->

            <button name="login" value="Login" class="btn btn-primary">

                <i class="fa fa-sign-in"></i> Đăng nhập

            </button>

        </div><!-- text-center Finish -->

    </form><!-- form Finish -->

    <center>
        <!-- center Begin -->

        <a href="customer_register.php">

            <h3> Chưa có tài khoản? Đăng ký ngay ở đây </h3>

        </a>

    </center><!-- center Finish -->

</div><!-- box Finish -->


<?php

if (isset($_POST['login'])) {

    $customer_email = $_POST['c_email'];

    $customer_pass = md5($_POST['c_pass']);



    $select_customer = "select * from users where email='$customer_email' AND password='$customer_pass'";

    $run_customer = mysqli_query($con, $select_customer);

    $check_customer = mysqli_num_rows($run_customer);

    if ($check_customer == 0) {

        echo "<script>alert('Bạn đã nhập sai mật khẩu hoặc email')</script>";

        exit();
    }

    $customer_id = mysqli_fetch_array($run_customer)['id'];

    $select_cart = "select * from bill where id_customer='$customer_id'";

    $run_cart = mysqli_query($con, $select_cart);

    $check_cart = mysqli_num_rows($run_cart);

    if ($check_customer == 1 and $check_cart == 0) {

        $_SESSION['customer_email'] = $customer_email;

        echo "<script>alert('Bạn đã đang nhập thành công')</script>";

        echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";
    } else {

        $_SESSION['customer_email'] = $customer_email;

        echo "<script>alert('Bạn đã đang nhập thành công')</script>";

        echo "<script>window.open('index.php','_self')</script>";
    }
}

?>