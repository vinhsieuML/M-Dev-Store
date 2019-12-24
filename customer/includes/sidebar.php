<div class="panel panel-default sidebar-menu">
    <!--  panel panel-default sidebar-menu Begin  -->

    <div class="panel-heading">
        <!--  panel-heading  Begin  -->

        <?php

        if (!isset($_SESSION['customer_email'])) {
        } else {
            $customer_session = $_SESSION['customer_email'];


            $get_customer = "select * from users where email='$customer_session'";

            $run_customer = mysqli_query($con, $get_customer);

            $row_customer = mysqli_fetch_array($run_customer);

            // $customer_image = $row_customer['customer_image'];

            $customer_name = $row_customer['name'];
            echo "
                <br/>
                
                <h3 class='panel-title' align='center'>
                
                    Tên: $customer_name
                
                </h3>
            
            ";
        }

        ?>

    </div><!--  panel-heading Finish  -->

    <div class="panel-body">
        <!--  panel-body Begin  -->

        <ul class="nav-pills nav-stacked nav">
            <!--  nav-pills nav-stacked nav Begin  -->

            <li class="<?php if (isset($_GET['my_orders'])) {
                            echo "active";
                        } ?>">

                <a href="my_account.php?my_orders">

                    <i class="fa fa-list"></i> Đơn hàng của tôi

                </a>

            </li>
            

            <li class="<?php if (isset($_GET['edit_account'])) {
                            echo "active";
                        } ?>">

                <a href="my_account.php?edit_account">

                    <i class="fa fa-pencil"></i> Chỉnh sửa tài khoản

                </a>

            </li>

            <li class="<?php if (isset($_GET['change_pass'])) {
                            echo "active";
                        } ?>">

                <a href="my_account.php?change_pass">

                    <i class="fa fa-user"></i> Đổi mật khẩu

                </a>

            </li>

            <li class="<?php if (isset($_GET['delete_account'])) {
                            echo "active";
                        } ?>">

                <a href="my_account.php?delete_account">

                    <i class="fa fa-trash-o"></i> Xóa tài khoản

                </a>

            </li>

            <li>

                <a href="logout.php">

                    <i class="fa fa-sign-out"></i> Đăng xuất

                </a>

            </li>

        </ul><!--  nav-pills nav-stacked nav Begin  -->

    </div><!--  panel-body Finish  -->

</div><!--  panel panel-default sidebar-menu Finish  -->