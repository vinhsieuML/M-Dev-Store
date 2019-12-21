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
                <li>

                    <i class="fa fa-dashboard"></i> Dashboard / View Categories

                </li>
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

                        <i class="fa fa-tags fa-fw"></i> View Size

                    </h3><!-- panel-title finish -->
                </div><!-- panel-heading finish -->

                <div class="panel-body">
                    <!-- panel-body begin -->
                    <div class="table-responsive">
                        <!-- table-responsive begin -->
                        <table class="table table-hover table-striped table-bordered">
                            <!-- tabel tabel-hover table-striped table-bordered begin -->

                            <thead>
                                <!-- thead begin -->
                                <tr>
                                    <!-- tr begin -->
                                    <th> Tên Danh Mục </th>
                                    <th> Các Size </th>
                                    <th> Chỉnh sửa </th>
                                    <th> Xóa </th>
                                </tr><!-- tr finish -->
                            </thead><!-- thead finish -->

                            <tbody>
                                <!-- tbody begin -->

                                <?php


                                    $get_cats = "select * from product_type";

                                    $run_cats = mysqli_query($con, $get_cats);

                                    while ($row_cats = mysqli_fetch_array($run_cats)) {

                                        $cat_id = $row_cats['id'];

                                        $cat_title = $row_cats['name'];

                                        


                                        $get_size = "select * from size where  id_type = $cat_id";
                                        $run_size = mysqli_query($con, $get_size);
                                        $count_row_size = mysqli_num_rows($run_size);
                                        echo ("
                                    <tr>
                                    <td rowspan= '$count_row_size'> $cat_title </td>");
                                        while ($row_size = mysqli_fetch_array($run_size)){
                                            $size_name = $row_size['name'];
                                            $size_id = $row_size['id'];
                                            echo ("
                                            <td> $size_name </td>
                                        <td>
                                            <a href='index.php?edit_size=$size_id'>
                                                <i class='fa fa-pencil'></i> Edit
                                            </a>
                                        </td>
                                        <td>
                                            <a href='index.php?delete_size=$size_id'>
                                                <i class='fa fa-trash'></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                            ");
                                        }

                                        ?>

                                    
                                        <!-- tr finish -->

                                <?php } ?>

                            </tbody><!-- tbody finish -->

                        </table><!-- tabel tabel-hover table-striped table-bordered finish -->
                    </div><!-- table-responsive finish -->
                </div><!-- panel-body finish -->

            </div><!-- panel panel-default finish -->
        </div><!-- col-lg-12 finish -->
    </div><!-- row 2 finish -->


<?php } ?>