<?php
include("../../includes/db.php");
$myJSON = $_REQUEST;
switch ($myJSON['type']) {
    case 'Them_San_Pham':
        $data = $myJSON['$dataFromForm'];
        $product_title = $data['product_title'];
        $product_cat = $data['cat'];
        $hang = $data['manufacturer'];
        $product_price = $data['product_price'];
        $product_desc = $data['product_desc'];

        //Insert Product
        $insert_product = "insert into product (id_type,id_hang,name,price,description,collectionID) values
    ('$product_cat','$hang','$product_title','$product_price','$product_desc','null')";


        $sl_size = $data['sl_size'];
        $run_product = mysqli_query($con, $insert_product);



        $product_id;

        //Insert Product Size
        if ($run_product) {


            $select_pro_id = "select id from product where name='$product_title'";
            $run_product = mysqli_query($con, $select_pro_id);
            while ($row_products = mysqli_fetch_array($run_product)) {

                $product_id = $row_products['id'];
            }


            for ($i = 1; $i <=  $sl_size; $i++) {

                # code...

                $s_id = "size_id_$i";
                $size_id = $data[$s_id];


                $p_qty = "product_qty_$i";
                $product_qty = $data[$p_qty];
                if ($product_qty != 0 || $product_qty != null) {
                    $insert_size_detail = "insert into size_detail (id_size,id_product,number) values
                    ('$size_id','$product_id','$product_qty')";
                    $run_size_detail = mysqli_query($con, $insert_size_detail);
                } else {
                    $insert_size_detail = "insert into size_detail (id_size,id_product,number) values
                    ('$size_id','$product_id','0')";
                    $run_size_detail = mysqli_query($con, $insert_size_detail);
                }
            }
            echo "$product_id";
            // echo "<script>alert('Sản phẩm đã được thêm thành công')</script>";
            // echo "<script>window.open('index.php?view_product.php','_self')</script>";
        } else {
            echo "LOI";
        }
        break;
    case 'Them_Hinh_Anh':
        $name = $myJSON['$imageInfo'];
        $product_id = $myJSON['product_id'];
        $extend = preg_split("/\./", $name)[1];
        $i = 0;
        while (file_exists("../../product_images/$product_id($i).$extend")) {
            $i++;
        }
        $result = rename("../../product_images/$name", "../../product_images/$product_id($i).$extend");
        $insert_product_image = "insert into images (link,id_product) values
                    ('$product_id($i).$extend','$product_id')";
        $run_product = mysqli_query($con, $insert_product_image);
        if ($run_product) {
            echo "THANH_CONG";
        }
        break;
    case 'Sua_San_Pham':
        $data = $myJSON['$dataFromForm'];
        $product_id = $data['product_id'];
        $product_title = $data['product_title'];
        $product_cat = $data['product_cat'];
        $manufacturer_id = $data['manufacturer'];
        $product_price = $data['product_price'];
        $product_desc = $data['product_desc'];
        $update_product = "update product set id_type='$product_cat',name='$product_title',price='$product_price',description='$product_desc' where id='$product_id'";
        $run_product = mysqli_query($con, $update_product);
        if ($run_product) {
            $i = 1;
            while (!isset($data[$i])) {
                $i++;
            }
            while (isset($data[$i])) {
                $update_size = "update size_detail set number='$data[$i]' where id='$i'";
                $run_size = mysqli_query($con, $update_size);
                $i++;
            }
            echo "THANH_CONG";
        } else {
            echo "LOI";
        }
        break;
    case 'Sua_Hinh_Anh':
        $name = $myJSON['$imageInfo'];
        $product_id = $myJSON['product_id'];
        $extend = preg_split("/\./", $name)[1];
        $i = 0;
        while (file_exists("../../product_images/$product_id($i).$extend")) {
            $i++;
        }
        while (file_exists("../../product_images/$product_id($i).$extend")) {
            $i++;
        }
        $result = rename("../../product_images/$name", "../../product_images/$product_id($i).$extend");
        $insert_product_image = "insert into images (link,id_product) values
                    ('$product_id($i).$extend','$product_id')";
        $run_product = mysqli_query($con, $insert_product_image);
        if ($run_product) {
            echo "THANH_CONG";
        }
        break;
}
