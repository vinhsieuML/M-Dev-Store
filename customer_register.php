<?php

$active = 'Account';
include("includes/header.php");

?>

<div id="content">
    <!-- #content Begin -->
    <div class="container">
        <!-- container Begin -->
        <div class="col-md-12">
            <!-- col-md-12 Begin -->

            <ul class="breadcrumb">
                <!-- breadcrumb Begin -->
                <li>
                    <a href="index.php">Trang Chủ</a>
                </li>
                <li>
                    Đăng Kí
                </li>
            </ul><!-- breadcrumb Finish -->

        </div><!-- col-md-12 Finish -->

        <div class="col-md-12">
            <!-- col-md-12 Begin -->

            <div class="box">
                <!-- box Begin -->

                <div class="box-header">
                    <!-- box-header Begin -->

                    <center>
                        <!-- center Begin -->

                        <h2> Đăng Kí Tài Khoản Mới </h2>

                    </center><!-- center Finish -->

                    <form action="customer_register.php" method="post" enctype="multipart/form-data">
                        <!-- form Begin -->

                        <div class="form-group">
                            <!-- form-group Begin -->

                            <label>Tên Của Bạn</label>

                            <input type="text" class="form-control" name="c_name" required>

                        </div><!-- form-group Finish -->

                        <div class="form-group">
                            <!-- form-group Begin -->

                            <label>Email</label>

                            <input type="text" class="form-control" name="c_email" required>

                        </div><!-- form-group Finish -->

                        <div class="form-group">
                            <!-- form-group Begin -->

                            <label>Số Điện Thoại</label>

                            <input type="text" class="form-control" name="c_phone" required>

                        </div><!-- form-group Finish -->

                        <div class="form-group">
                            <!-- form-group Begin -->

                            <label>Mật Khẩu</label>

                            <input type="password" class="form-control" name="c_pass" required>

                        </div><!-- form-group Finish -->

                        <div class="form-group">
                            <!-- form-group Begin -->

                            <label>Nhập lại mật khẩu</label>

                            <input type="password" class="form-control" name="c_pass_repeat" required>

                        </div><!-- form-group Finish -->

                        <div class="column">
                            <div class="row">
                                <label class="col-md-5 control-label">Thành Phố</label>
                                <select name="city_select" id="city_select" class="setw form-control" style="width : 40%">
                                </select>
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <label class="col-md-5 control-label">Quận</label>
                                <select name="district_select" id="district_select" class="setw form-control" style="width : 40%">
                                </select>
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <label class="col-md-5 control-label">Phường</label>
                                <select name="ward_select" class="setw form-control" id="ward_select" style="width : 40%">
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <!-- form-group Begin -->

                            <label>Địa chỉ của bạn</label>

                            <input type="text" class="form-control" name="c_address" required>

                        </div><!-- form-group Finish -->

                        <div class="text-center">
                            <!-- text-center Begin -->

                            <button type="submit" name="register" class="btn btn-primary">

                                <i class="fa fa-user-md"></i> Đăng Kí

                            </button>

                        </div><!-- text-center Finish -->

                    </form><!-- form Finish -->

                </div><!-- box-header Finish -->

            </div><!-- box Finish -->

        </div><!-- col-md-12 Finish -->

    </div><!-- container Finish -->
</div><!-- #content Finish -->

<?php

include("includes/footer.php");

?>

<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "http://192.168.0.135:3000/api/city",
            method: "GET",
            headers: {},
            contentType: 'application/json; charset=utf-8',
            success: function(response) {
                var $select = $('#city_select');
                $.each(response, function(index, val) {
                    $select.append($('<option />', {
                        value: response[index]['ProvinceID'],
                        text: response[index]['ProvinceName']
                    }));
                });
            }
        });

        $('#city_select').on('change', function() {
            const cityid = this.value;
            $.ajax({
                url: "http://192.168.0.135:3000/api/district/" + cityid,
                method: "GET",
                headers: {},
                contentType: 'application/json; charset=utf-8',
                success: function(response) {
                    var $select = $('#district_select');
                    $select.empty();
                    $('#ward_select').empty();
                    $.each(response, function(index, val) {
                        $select.append($('<option />', {
                            value: response[index]['DistrictID'],
                            text: response[index]['DistrictName']
                        }));
                    });
                }
            });
        });

        $('#district_select').on('change', function() {
            const districtID = this.value;
            var $select = $('#ward_select');
            $select.empty();
            $select.append("<option> Đang Tải Dữ Liệu </option>");
            $.ajax({
                url: "http://192.168.0.135:3000/api/ward/" + districtID,
                method: "GET",
                headers: {},
                contentType: 'application/json; charset=utf-8',
                success: function(response) {
                    $select.empty();
                    $.each(response, function(index, val) {
                        $select.append($('<option />', {
                            value: response[index]['WardCode'],
                            text: response[index]['WardName']
                        }));
                    });
                }
            });
        });
    });
</script>

</body>

</html>


<?php

if (isset($_POST['register'])) {

    $c_name = $_POST['c_name'];

    $c_email = $_POST['c_email'];

    $c_pass = $_POST['c_pass'];

    $c_phone = $_POST['c_phone'];

    $c_pass_repeat = $_POST['c_pass_repeat'];

    $c_address = $_POST['c_address'];

    $city_id = $_POST['city_select'];

    $district_id = $_POST['district_select'];

    $ward_id = $_POST['ward_select'];

    if(!isset($c_name) || !isset($c_email) || !isset($c_phone) || !isset($c_address) || !isset($city_id) || !isset($district_id) || !isset($ward_id)){
        echo "<script>alert('Vui lòng nhập đầy đủ')</script>";
        exit();
    }
    if($c_pass != $c_pass_repeat){
        echo "<script>alert('Mật khẩu không trùng nhau')</script>";
        exit();
    }
    $c_pass = md5($c_pass);

    $insert_customer = "insert into users (email,password,name,phone,address,cityID,districtID,wardID) values ('$c_email','$c_pass','$c_name','$c_phone','$c_address','$city_id','$district_id','$ward_id')";

    $run_customer = mysqli_query($con, $insert_customer);

    if ($run_customer) {

        echo "<script>alert('Đăng Kí Thành Công')</script>";

        echo "<script>window.open('checkout.php','_self')</script>";
    } else {
        echo "<script>alert('Email Đã Tồn Tại')</script>";
    }
}

?>