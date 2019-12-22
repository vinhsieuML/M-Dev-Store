<?php

if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

?>

    <?php

    if (isset($_GET['edit_product'])) {

        $edit_id = $_GET['edit_product'];

        $get_p = "select p.id,p.name,p.price,p.id_type, p.id_hang,p.description, GROUP_CONCAT(img.link) as imagesID from product p LEFT JOIN images img ON p.id = img.id_product where p.id= $edit_id group by p.id";

        $run_edit = mysqli_query($con, $get_p);

        $row_edit = mysqli_fetch_array($run_edit);

        $p_id = $row_edit['id'];

        $p_title = $row_edit['name'];

        $p_cat = $row_edit['id_type'];

        $m_id = $row_edit['id_hang'];

        $p_price = $row_edit['price'];

        $image = $row_edit['imagesID'];
        // $p_sale = $row_edit['product_sale'];

        $p_desc = $row_edit['description'];
    }

    // $get_manufacturer = "select * from hang where id='$m_id'";

    // $run_manufacturer = mysqli_query($con, $get_manufacturer);

    // $row_manufacturer = mysqli_fetch_array($run_manufacturer);

    // $manufacturer_id = $row_manufacturer['id'];

    // $manufacturer_title = $row_manufacturer['name'];

    // $get_p_cat = "select * from product_type where id='$p_cat'";

    // $run_p_cat = mysqli_query($con, $get_p_cat);

    // $row_p_cat = mysqli_fetch_array($run_p_cat);

    // $p_cat_title = $row_p_cat['name'];

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="js/uploadify/uploadifive.css" />
        <script type="text/javascript" src="js/uploadify/jquery.uploadifive.js"></script>
        <style type="text/css">
            body {
                font: 13px Arial, Helvetica, Sans-serif;
            }

            .uploadifive-button {
                float: left;
                margin-right: 10px;
            }

            #queue {
                border: 1px solid #E5E5E5;
                height: 177px;
                overflow: auto;
                margin-bottom: 10px;
                padding: 0 3px 3px;
                width: 300px;
            }
        </style>
        <script type="text/javascript">
            <?php $timestamp = time(); ?>
            $(function() {
                $('#file_upload').uploadifive({
                    'auto': false,
                    'checkScript': 'js/uploadify/check-exists.php',
                    'formData': {
                        'timestamp': '<?php echo $timestamp; ?>',
                        'token': '<?php echo md5('unique_salt' . $timestamp); ?>'
                    },
                    'queueID': 'queue',
                    'uploadScript': 'js/uploadify/uploadifive.php',
                    'onUploadComplete': function(file, data) {
                        $imageInfo = file.name;
                        $data = {
                            $imageInfo,
                            product_id: document.getElementById("product_id").innerHTML,
                            type: "Sua_Hinh_Anh"
                        };
                        $.post("./source/product/insert_ajax.php", $data,
                            function(data, status) {
                                if (data === "THANH_CONG") {
                                    window.open('index.php?view_products', '_self')
                                }
                            });
                    }
                });
            });
        </script>
        <script>
            function jsonForm(formArray) { //serialize data function
                var returnArray = {};
                for (var i = 0; i < formArray.length; i++) {
                    returnArray[formArray[i]['name']] = formArray[i]['value'];
                }
                return returnArray;
            };
            // wait for the DOM to be loaded 
            $(document).ready(function() {
                $("button").click(function(e) {
                    e.preventDefault();
                    tinyMCE.triggerSave();
                    $dataFromForm = jsonForm($('form').serializeArray());
                    $data = {
                        $dataFromForm,
                        type: "Sua_San_Pham"
                    };
                    $.post("./source/product/insert_ajax.php", $data,
                        function(data, status) {
                            if (data == "THANH_CONG") {
                                if ($('.uploadify-queue-item').length == 0) {
                                    alert('Chỉnh sửa thành công');
                                    window.open('index.php?view_products', '_self')
                                } else {
                                    $('#file_upload').uploadifive('upload');
                                }
                            }
                        });
                });
            });
        </script>
        <title> Insert Products </title>
    </head>

    <body>

        <div class="row">
            <!-- row bat dau -->

            <div class="col-lg-12">
                <!-- col-lg-12 bat dau -->

                <ol class="breadcrumb">
                    <!-- breadcrumb bat dau -->

                    <li class="active">
                        <!-- active bat dau -->

                        <i class="fa fa-dashboard"></i> Dashboard / Edit Products

                    </li><!-- active xong -->

                </ol><!-- breadcrumb xong -->

            </div><!-- col-lg-12 xong -->

        </div><!-- row xong -->

        <div class="row">
            <!-- row bat dau -->

            <div class="col-lg-12">
                <!-- col-lg-12 bat dau -->

                <div class="panel panel-default">
                    <!-- panel panel-default bat dau -->

                    <div class="panel-heading">
                        <!-- panel-heading bat dau -->

                        <h3 class="panel-title">
                            <!-- panel-title bat dau -->

                            <i class="fa fa-money fa-fw"></i> Chỉnh sửa sản phẩm

                        </h3><!-- panel-title xong -->

                    </div> <!-- panel-heading xong -->

                    <div class="panel-body">
                        <!-- panel-body bat dau -->

                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                            <!-- form-horizontal bat dau -->
                            <input name='product_id' value=<?php echo $p_id; ?> hidden></input>
                            <div class="form-group">
                                <!-- form-group bat dau -->

                                <label class="col-md-3 control-label"> Tên Sản Phẩm </label>

                                <div class="col-md-6">
                                    <!-- col-md-6 bat dau -->

                                    <input name="product_title" type="text" class="form-control" required value="<?php echo $p_title; ?>">

                                </div><!-- col-md-6 xong -->

                            </div><!-- form-group xong -->

                            <div class="form-group">
                                <!-- form-group bat dau -->

                                <label class="col-md-3 control-label"> Hãng </label>

                                <div class="col-md-6">
                                    <!-- col-md-6 bat dau -->

                                    <select name="manufacturer" class="form-control">
                                        <!-- form-control bat dau -->

                                        <?php

                                                                                                                    $get_manufacturer = "select * from hang";
                                                                                                                    $run_manufacturer = mysqli_query($con, $get_manufacturer);

                                                                                                                    while ($row_manufacturer = mysqli_fetch_array($run_manufacturer)) {

                                                                                                                        $manufacturer_idAll = $row_manufacturer['id'];
                                                                                                                        $manufacturer_titleAll = $row_manufacturer['name'];

                                                                                                                        if ($manufacturer_idAll == $manufacturer_id) {
                                                                                                                            echo "
                                    <option value='$manufacturer_idAll' selected> $manufacturer_titleAll </option>
                                    ";
                                                                                                                        } else {
                                                                                                                            echo "
                                    <option value='$manufacturer_idAll'> $manufacturer_titleAll </option>
                                    ";
                                                                                                                        }
                                                                                                                    }

                                        ?>

                                    </select><!-- form-control xong -->

                                </div><!-- col-md-6 xong -->

                            </div><!-- form-group xong -->

                            <div class="form-group">
                                <!-- form-group bat dau -->

                                <label class="col-md-3 control-label"> Danh mục sản phẩm </label>

                                <div class="col-md-6">
                                    <!-- col-md-6 bat dau -->

                                    <select name="product_cat" class="form-control">
                                        <!-- form-control bat dau -->

                                        <option disabled value="Select Product Category">Chọn danh mục sản phẩm</option>

                                        <!-- <option value="<?php echo $p_cat; ?>"><?php echo $p_cat_title; ?></option> -->

                                        <?php

                                                                                                                    $get_p_cats = "select * from product_type";
                                                                                                                    $run_p_cats = mysqli_query($con, $get_p_cats);

                                                                                                                    while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {

                                                                                                                        $p_cat_id = $row_p_cats['id'];
                                                                                                                        $p_cat_title = $row_p_cats['name'];
                                                                                                                        if ($p_cat_id == $p_cat) {
                                                                                                                            echo "
                                  
                                    <option value='$p_cat_id' selected> $p_cat_title </option>
                                    
                                    ";
                                                                                                                        } else {
                                                                                                                            echo "
                                  
                                    <option value='$p_cat_id'> $p_cat_title </option>
                                    
                                    ";
                                                                                                                        }
                                                                                                                    }

                                        ?>

                                    </select><!-- form-control xong -->

                                </div><!-- col-md-6 xong -->

                            </div><!-- form-group xong -->

                            <div class="form-group">
                                <!-- form-group bat dau -->

                                <label class="col-md-3 control-label"> Size </label>

                                <div class="col-md-6">
                                    <!-- col-md-6 bat dau -->

                                    <div class="table-responsive">
                                        <!-- table-responsive bat dau -->
                                        <table class="table table-hover table-striped table-bordered">
                                            <!-- tabel tabel-hover table-striped table-bordered bat dau -->

                                            <thead>
                                                <!-- thead bat dau -->
                                                <tr>
                                                    <!-- tr bat dau -->
                                                    <th> Tên Size </th>
                                                    <th> Số lượng </th>
                                                </tr><!-- tr xong -->
                                            </thead><!-- thead xong -->

                                            <tbody>
                                                <!-- tbody bat dau -->

                                                <?php


                                                                                                                    $get_size = "select sd.id,sd.number,s.name from size_detail sd join size s on sd.id_size = s.id where id_product = $p_id";

                                                                                                                    $run_size = mysqli_query($con, $get_size);
                                                                                                                    while ($row_size = mysqli_fetch_array($run_size)) {

                                                                                                                        $size_id = $row_size['id'];

                                                                                                                        $size_title = $row_size['name'];

                                                                                                                        $size_number = $row_size['number'];

                                                                                                                        echo ("
                                    <tr>
                                            <td> $size_title </td>
                                        <td>
                                        <input type='number' min='0' name='$size_id' class='form-control' placeholder='Số lượng' value= $size_number>
                                        </td>
                                    </tr>
                                            ");

                                                ?>
                                                    <!-- tr xong -->

                                                <?php } ?>

                                            </tbody><!-- tbody xong -->

                                        </table><!-- tabel tabel-hover table-striped table-bordered xong -->
                                    </div><!-- table-responsive xong -->

                                </div><!-- col-md-6 xong -->

                            </div><!-- form-group xong -->





                            <div class="form-group">
                                <!-- form-group bat dau -->

                                <label class="col-md-3 control-label"> Hình Ảnh </label>
                                <small class="col-md-5" style="color: red">Chỉnh sửa hình sẽ xóa hết hình cũ</small>
                                <div class="col-md-6">
                                    <!-- col-md-6 bat dau -->

                                    <div id="queue"></div>
                                    <input id="file_upload" name="file_upload" type="file" multiple="true">
                                    <br>
                                    <?php
                                            foreach (preg_split("/\,/", $image) as $value) {
                                                echo "<img width='70' height='70' src='product_images/$value' alt= $value style = 'margin-left: 10px'>";
                                            }

                                    ?>

                                </div><!-- col-md-6 xong -->
                            </div><!-- form-group xong -->

                            <div class="form-group">
                                <!-- form-group bat dau -->

                                <label class="col-md-3 control-label"> Giá </label>

                                <div class="col-md-6">
                                    <!-- col-md-6 bat dau -->

                                    <input name="product_price" type="text" class="form-control" required value="<?php echo $p_price; ?>">

                                </div><!-- col-md-6 xong -->

                            </div><!-- form-group xong -->



                            <div class="form-group">
                                <!-- form-group bat dau -->

                                <label class="col-md-3 control-label"> Mô tả </label>

                                <div class="col-md-6">
                                    <!-- col-md-6 bat dau -->

                                    <textarea name="product_desc" cols="19" rows="6" class="form-control">

                              <?php echo $p_desc; ?>
                              
                          </textarea>

                                </div><!-- col-md-6 xong -->

                            </div><!-- form-group xong -->


                            <div class="form-group">
                                <!-- form-group bat dau -->

                                <label class="col-md-3 control-label"></label>

                                <div class="col-md-6">
                                    <!-- col-md-6 bat dau -->
                                    <button class="btn btn-primary form-control"> Sửa Sản Phẩm</button>
                                </div><!-- col-md-6 xong -->

                            </div><!-- form-group xong -->

                        </form><!-- form-horizontal xong -->

                    </div><!-- panel-body xong -->

                </div><!-- canel panel-default xong -->

            </div><!-- col-lg-12 xong -->

        </div><!-- row xong -->

        <script src="js/tinymce/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: 'textarea'
            });
        </script>
    </body>

    </html>


<?php } ?>