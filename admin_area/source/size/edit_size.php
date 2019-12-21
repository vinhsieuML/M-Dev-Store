<?php

if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

    ?>

    <?php

        if (isset($_GET['edit_size'])) {

            $edit_size_id = $_GET['edit_size'];

            $edit_size_query = "select * from size where id='$edit_size_id'";

            $run_edit = mysqli_query($con, $edit_size_query);

            $row_edit = mysqli_fetch_array($run_edit);

            $size_id = $row_edit['id'];

            $size_title = $row_edit['name'];
        }

        ?>

    <div class="row">
        <!-- row 1 begin -->
        <div class="col-lg-12">
            <!-- col-lg-12 begin -->
            <ol class="breadcrumb">
                <!-- breadcrumb begin -->
                <li>

                    <i class="fa fa-dashboard"></i> Dashboard / Edit Size

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

                        <i class="fa fa-pencil fa-fw"></i> Edit Category

                    </h3><!-- panel-title finish -->
                </div><!-- panel-heading finish -->

                <div class="panel-body">
                    <!-- panel-body begin -->
                    <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <!-- form-horizontal begin -->
                        <div class="form-group">
                            <!-- form-group begin -->

                            <label for="" class="control-label col-md-3">
                                <!-- control-label col-md-3 begin -->

                                Tên Size

                            </label><!-- control-label col-md-3 finish -->

                            <div class="col-md-6">
                                <!-- col-md-6 begin -->

                                <input value="<?php echo $size_title; ?>" name="size_title" type="text" class="form-control">

                            </div><!-- col-md-6 finish -->

                        </div><!-- form-group finish -->



                        <div class="form-group">
                            <!-- form-group begin -->

                            <label for="" class="control-label col-md-3">
                                <!-- control-label col-md-3 begin -->

                            </label><!-- control-label col-md-3 finish -->

                            <div class="col-md-6">
                                <!-- col-md-6 begin -->

                                <input value="Cập Nhật Size" name="update" type="submit" class="form-control btn btn-primary">

                            </div><!-- col-md-6 finish -->

                        </div><!-- form-group finish -->
                    </form><!-- form-horizontal finish -->
                </div><!-- panel-body finish -->

            </div><!-- panel panel-default finish -->
        </div><!-- col-lg-12 finish -->
    </div><!-- row 2 finish -->

    <?php

        if (isset($_POST['update'])) {

            $size_title = $_POST['size_title'];


            $update_size = "update size set name='$size_title' where id ='$size_id'";

            $run_cat = mysqli_query($con, $update_size);

            if ($run_cat) {

                echo "<script>alert('Your Category Has Been Updated')</script>";

                echo "<script>window.open('index.php?view_size','_self')</script>";
            }
        }


        ?>



<?php } ?>