<?php

if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title> Insert Products </title>
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
        <script>
            function showUser(str) {
                if (str == "") {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "./source/size/get_size.php?q=" + str, true);
                xmlhttp.send();
            }
        </script>
        <link rel="stylesheet" type="text/css" href="js/uploadify/uploadifive.css" />
        <script type="text/javascript" src="js/uploadify/jquery.uploadifive.js"></script>
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
                            product_id : document.getElementById("product_id").innerHTML,
                            type: "Them_Hinh_Anh"
                        };
                        $.post("./source/product/insert_ajax.php", $data,
                            function(data, status) {
                                if (data === "THANH_CONG") {
                                    window.open('index.php?view_products','_self')
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
                        type: "Them_San_Pham"
                    };
                    $.post("./source/product/insert_ajax.php", $data,
                        function(data, status) {
                            if (data !== 'LOI') {
                                document.getElementById("product_id").innerHTML = data;
                                $('#file_upload').uploadifive('upload');
                            }
                        });
                });
            });
        </script>

    </head>

    <body>
    <div hidden id="product_id"></div>
        <div class="row">
            <!-- row Begin -->

            <div class="col-lg-12">
                <!-- col-lg-12 Begin -->

                <ol class="breadcrumb">
                    <!-- breadcrumb Begin -->

                    <li class="active">
                        <!-- active Begin -->

                        <i class="fa fa-dashboard"></i> Dashboard / Insert Products

                    </li><!-- active Finish -->

                </ol><!-- breadcrumb Finish -->

            </div><!-- col-lg-12 Finish -->

        </div><!-- row Finish -->

        <div class="row">
            <!-- row Begin -->

            <div class="col-lg-12">
                <!-- col-lg-12 Begin -->

                <div class="panel panel-default">
                    <!-- panel panel-default Begin -->

                    <div class="panel-heading">
                        <!-- panel-heading Begin -->

                        <h3 class="panel-title">
                            <!-- panel-title Begin -->

                            <i class="fa fa-money fa-fw"></i> Thêm sản phẩm

                        </h3><!-- panel-title Finish -->

                    </div> <!-- panel-heading Finish -->

                    <div class="panel-body">
                        <!-- panel-body Begin -->

                        <form id='myForm' method="post" class="form-horizontal" enctype="multipart/form-data">
                            <!-- form-horizontal Begin -->

                            <div class="form-group">
                                <!-- form-group Begin -->

                                <label class="col-md-3 control-label"> Tên Sản Phẩm </label>

                                <div class="col-md-6">
                                    <!-- col-md-6 Begin -->

                                    <input name="product_title" type="text" class="form-control" required>

                                </div><!-- col-md-6 Finish -->

                            </div><!-- form-group Finish -->

                            <div class="form-group">
                                <!-- form-group Begin -->

                                <label class="col-md-3 control-label"> Hãng sản xuất </label>

                                <div class="col-md-6">
                                    <!-- col-md-6 Begin -->

                                    <select name="manufacturer" class="form-control">
                                        <!-- form-control Begin -->

                                        <option selected disabled> Chọn hãng </option>

                                        <?php

                                            $get_manufacturer = "select * from hang";
                                            $run_manufacturer = mysqli_query($con, $get_manufacturer);

                                            while ($row_manufacturer = mysqli_fetch_array($run_manufacturer)) {

                                                $manufacturer_id = $row_manufacturer['id'];
                                                $manufacturer_title = $row_manufacturer['name'];

                                                echo "
                                  
                                  <option value='$manufacturer_id'> $manufacturer_title </option>
                                  
                                  ";
                                            }

                                            ?>

                                    </select><!-- form-control Finish -->

                                </div><!-- col-md-6 Finish -->

                            </div><!-- form-group Finish -->

                            <div class="form-group">
                                <!--form-group Begin-->

                                <label class="col-md-3 control-label"> Danh mục sản phẩm </label>


                                <div class="col-md-6">
                                    <select name="cat" class="form-control" onchange="showUser(this.value)">
                                        <option selected disabled>Chọn danh mục:</option>
                                        <?php
                                            $get_p_cats = "select * from product_type";
                                            $run_p_cats = mysqli_query($con, $get_p_cats);
                                            while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {
                                                $p_cat_id = $row_p_cats['id'];
                                                $p_cat_title = $row_p_cats['name'];

                                                echo "
                <option value='$p_cat_id'> $p_cat_title </option>
            ";
                                            }
                                            ?>
                                    </select>
                                    <br>
                                    <div id="txtHint"></div>




                                </div>

                            </div>
                            <!--form-group End-->




                            <div class="form-group">
                                <!-- form-group Begin -->

                                <label class="col-md-3 control-label"> Giá </label>

                                <div class="col-md-6">
                                    <!-- col-md-6 Begin -->

                                    <input name="product_price" type="text" class="form-control" required>

                                </div><!-- col-md-6 Finish -->

                            </div><!-- form-group Finish -->


                            <div class="form-group">
                                <!-- form-group 3 begin -->

                                <label for="" class="control-label col-md-3">
                                    <!-- control-label col-md-3 begin -->

                                    Hình Sản Phẩm

                                </label><!-- control-label col-md-3 finish -->
                                <div class="col-md-6">
                                    <!-- col-md-6 Begin -->
                                    <div id="queue"></div>
                                    <input id="file_upload" name="file_upload" type="file" multiple="true">
                                    
                                </div><!-- col-md-6 Finish -->

                            </div><!-- form-group 3 finish -->


                            <div class="form-group">
                                <!-- form-group Begin -->

                                <label class="col-md-3 control-label"> Mô tả </label>

                                <div class="col-md-6">
                                    <!-- col-md-6 Begin -->

                                    <textarea name="product_desc" cols="19" rows="6" class="form-control"></textarea>

                                </div><!-- col-md-6 Finish -->


                            </div><!-- form-group Finish -->



                            <div class="form-group">
                                <!-- form-group Begin -->

                                <label class="col-md-3 control-label"></label>

                                <div class="col-md-6">
                                    <!-- col-md-6 Begin -->

                                    <!-- <input name="submit" value="Insert Product" type="submit" class="btn btn-primary form-control"> -->
                                    <button class="btn btn-primary form-control"> Thêm Sản Phẩm</button>
                                </div><!-- col-md-6 Finish -->

                            </div><!-- form-group Finish -->

                        </form><!-- form-horizontal Finish -->

                    </div><!-- panel-body Finish -->

                </div><!-- canel panel-default Finish -->

            </div><!-- col-lg-12 Finish -->

        </div><!-- row Finish -->

        <script src="js/tinymce/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: 'textarea'
            });
        </script>

    </body>

    </html>
<?php } ?>