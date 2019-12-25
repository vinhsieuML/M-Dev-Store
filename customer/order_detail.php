<center>
    <!--  center Begin  -->

    <h1> Chi Tiết Đơn Hàng </h1>

    <p class="lead"> Chi tiết được liệt kê</p>

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

                <th> STT </th>
                <th> Tên Sản Phẩm </th>
                <th> Size </th>
                <th> Số lượng </th>
                <th> Đơn giá</th>

            </tr><!--  tr Finish  -->

        </thead><!--  thead Finish  -->

        <tbody>
            <!--  tbody Begin  -->

            <?php
            if(isset($_GET['order_detail'])){
                $orderID = $_GET['order_detail'];
            }
            $order_id = "SELECT bdt.id, bdt.price, bdt.quantity,p.name, s.name as sizeName,b.status FROM bill_detail bdt join bill b ON b.id=bdt.id_bill join product p ON bdt.id_product = p.id JOIN size_detail sdt ON sdt.id = bdt.id_size_detail JOIN size s ON s.id = sdt.id_size WHERE bdt.id_bill = $orderID";

            $run_order = mysqli_query($con, $order_id);
            $i = 0;

            while ($row_orders = mysqli_fetch_array($run_order)) {

                $order_id = $row_orders['id'];

                $price = $row_orders['price'];

                $quantiy = $row_orders['quantity'];

                $name = $row_orders['name'];

                $status = $row_orders['status'];

                $size = $row_orders['sizeName'];
                $i++;
            ?>

                <tr>
                    <!--  tr Begin  -->

                    <th> <?php echo $i ?></th>
                    <td> <?php echo $name; ?> </td>
                    <td> <?php echo $size ?></td>
                    <td><?php echo $quantiy ?></td>
                    <td>
                        <?php echo $price?>
                    </td>

                </tr><!--  tr Finish  -->

            <?php } ?>

        </tbody><!--  tbody Finish  -->

    </table><!--  table table-bordered table-hover Finish  -->

</div><!--  table-responsive Finish  -->