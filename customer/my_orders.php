<center>
    <!--  center Begin  -->

    <h1> Đơn hàng của bạn </h1>

    <p class="lead"> Tất cả đơn hàng được liệt kê</p>

    <p class="text-muted">

        Nếu bạn có thắc mắc, đừng ngại <a href="../contact.php">Liên hệ chúng tôi</a>. Chúng tôi sẽ trả lời sớm nhất có thể

    </p>

</center><!--  center Finish  -->


<hr>


<div class="table-responsive">
    <!--  table-responsive Begin  -->

    <table class="table table-bordered table-hover">
        <!--  table table-bordered table-hover Begin  -->

        <thead>
            <!--  thead Begin  -->

            <tr>
                <!--  tr Begin  -->

                <th> Mã Đơn Hàng: </th>
                <th> Tổng Tiền: </th>
                <th> Ngày đặt </th>
                <th> Tình Trạng: </th>
                <th> Hành Động</th>

            </tr><!--  tr Finish  -->

        </thead><!--  thead Finish  -->

        <tbody>
            <!--  tbody Begin  -->

            <?php

            $customer_session = $_SESSION['customer_email'];

            $get_customer = "select * from users where email='$customer_session'";

            $run_customer = mysqli_query($con, $get_customer);

            $row_customer = mysqli_fetch_array($run_customer);

            $customer_id = $row_customer['id'];

            $get_orders = "select * from bill where id_customer='$customer_id' ORDER BY id DESC";

            $run_orders = mysqli_query($con, $get_orders);

            $i = 0;

            while ($row_orders = mysqli_fetch_array($run_orders)) {

                $order_id = $row_orders['id'];

                $due_amount = $row_orders['total'];

                $order_date = substr($row_orders['date_order'], 0, 11);

                $order_status = $row_orders['status'];

                $url_payment = $row_orders['url_payment'];

                $i++;



            ?>

                <tr>
                    <!--  tr Begin  -->

                    <th> <?php echo "ORD$order_id"; ?> </th>
                    <td> <?php echo $due_amount; ?> </td>
                    <td> <?php $date = date_create($order_date);
                            echo date_format($date, 'd-m-Y');
                            ?></td>
                    </td>
                    <td> <?php
                            switch ($order_status) {
                                case 0:
                                    echo "<p style='color:blue;'>Đang Chờ Duyệt COD</p>";
                                    break;
                                case 1:
                                    echo "<p style='color:green;'>Đã Thanh Toán Online</p>";
                                    break;
                                case 2:
                                    echo "<p style='color:red;'>Đã Hủy Online</p>";
                                    break;
                                case 3:
                                    echo 'Đang Giao Hàng';
                                    break;
                                case 4:
                                    echo "<p style='color:orange;'>Hoàn Thành</p>";
                                    break;
                                case 5:
                                    echo "<p style='color:red;'>Đã Hủy</p>";
                                    break;
                            }
                            ?> </td>

                    <td>
                        <?php
                        switch ($order_status) {
                            case 0:
                            case 1:
                                echo 'Chờ xác thực';
                                break;
                            case 2:
                                echo '<a href="' . $url_payment . '" target="_blank" class="btn btn-primary btn-sm" disable> Thanh toán lại </a>';
                                break;
                            case 3:
                                echo '<a href="confirm.php?order_id=' . $order_id . '" class="btn btn-primary btn-sm" disable> Đã Nhận Hàng </a>';
                                break;
                            case 4:
                                echo 'Hoàn Thành';
                                break;
                            case 5:
                                echo 'Đã hủy bởi bạn';
                                break;
                        }
                        ?>
                    </td>

                </tr><!--  tr Finish  -->

            <?php } ?>

        </tbody><!--  tbody Finish  -->

    </table><!--  table table-bordered table-hover Finish  -->

</div><!--  table-responsive Finish  -->