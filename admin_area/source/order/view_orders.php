<?php

if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

?>

    <div class="row">
        <!-- row 1 begin -->
        <div class="col-lg-12">
            <!-- col-lg-12 begin -->
            <ol class="breadcrumb">
                <!-- breadcrumb begin -->
                <li class="active">
                    <!-- active begin -->

                    <i class="fa fa-dashboard"></i> Dashboard / View Orders

                </li><!-- active finish -->
            </ol><!-- breadcrumb finish -->
        </div><!-- col-lg-12 finish -->
    </div><!-- row 1 finish -->

    <div class="row">
        <!-- row 2 begin -->
        <div class="col-lg-12">
            <!-- col-lg-12 begin -->
            <div class="panel panel-default">
                <!-- panel panel-default begin -->
                <div class="panel-heading">
                    <!-- panel-heading begin -->
                    <h3 class="panel-title">
                        <!-- panel-title begin -->

                        <i class="fa fa-tags"></i> View Orders

                    </h3><!-- panel-title finish -->
                </div><!-- panel-heading finish -->

                <div class="panel-body">
                    <!-- panel-body begin -->
                    <div class="table-responsive">
                        <!-- table-responsive begin -->
                        <table class="table table-striped table-bordered table-hover">
                            <!-- table table-striped table-bordered table-hover begin -->

                            <thead>
                                <!-- thead begin -->
                                <tr>
                                    <!-- tr begin -->
                                    <th> ID: </th>
                                    <th> Tên khách hàng: </th>
                                    <th> SĐT: </th>
                                    <th> Email khách: </th>
                                    <th> Ngày Đặt: </th>
                                    <th> Tổng Tiền: </th>
                                    <th> Status: </th>
                                    <th> Hành Động: </th>
                                </tr><!-- tr finish -->
                            </thead><!-- thead finish -->

                            <tbody>
                                <!-- tbody begin -->

                                <?php

                                $i = 0;

                                $get_orders = "select * from bill b JOIN users urs ON b.id_customer = urs.id ";

                                $run_orders = mysqli_query($con, $get_orders);

                                while ($row_order = mysqli_fetch_array($run_orders)) {

                                    $order_id = $row_order['id'];

                                    $c_id = $row_order['id_customer'];

                                    $order_status = $row_order['status'];

                                    $total = $row_order['total'];

                                    $customer_email = $row_order['email'];

                                    $sdt = $row_order['phone'];

                                    $dataOrder = $row_order['date_order'];

                                    $name = $row_order['name'];

                                    $i++;

                                ?>

                                    <tr>
                                        <!-- tr begin -->
                                        <td> <?php echo $i; ?> </td>
                                        <td> <?php echo $name; ?> </td>
                                        <td> <?php echo $sdt; ?></td>
                                        <td> <?php echo $customer_email; ?> </td>
                                        <td> <?php $date = date_create($dataOrder);
                                                echo date_format($date, 'd-m-Y');
                                                ?></td>
                                        <td> <?php echo $total; ?> </td>
                                        <td>
                                            <?php

                                            switch ($order_status) {
                                                case 0:
                                                    echo 'Đang Chờ Duyệt COD';
                                                    break;
                                                case 1:
                                                    echo 'Đã Thanh Toán Online';
                                                    break;
                                                case 2:
                                                    echo 'Đã Hủy Online';
                                                    break;
                                                case 3:
                                                    echo 'Đang Giao Hàng';
                                                    break;
                                                case 4:
                                                    echo 'Hoàn Thành';
                                                    break;
                                            }

                                            ?>
                                        </td>
                                        <td>
                                            <a href="index.php?delete_order=<?php echo $order_id; ?>">

                                                <i class="fa fa-trash-o"></i> Huỷ đơn hàng

                                            </a>
                                            <a href="index.php?delete_order=<?php echo $order_id; ?>" style="marginLeft: 10px" >

                                                <i class="fa fa-check"></i> Xác Thực

                                            </a>

                                        </td>
                                    </tr><!-- tr finish -->

                                <?php } ?>

                            </tbody><!-- tbody finish -->

                        </table><!-- table table-striped table-bordered table-hover finish -->
                    </div><!-- table-responsive finish -->
                </div><!-- panel-body finish -->

            </div><!-- panel panel-default finish -->
        </div><!-- col-lg-12 finish -->
    </div><!-- row 2 finish -->

<?php } ?>