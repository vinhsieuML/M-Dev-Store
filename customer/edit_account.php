<?php

$customer_session = $_SESSION['customer_email'];

$get_customer = "select * from users where email='$customer_session'";

$run_customer = mysqli_query($con, $get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['id'];

$customer_name = $row_customer['name'];

$customer_email = $row_customer['email'];

$customer_contact = $row_customer['phone'];

$customer_address = $row_customer['address'];

$customer_city_id = $row_customer['cityID'];

$customer_district_id = $row_customer['districtID'];

$customer_ward_id = $row_customer['wardID'];
?>

<h1 align="center"> Chỉnh sửa tài khoản </h1>

<form action="" method="post" enctype="multipart/form-data">
    <!-- form Begin -->
    <input type="text" name="o_city_id" id="o_city_id" value="<?php echo $customer_city_id; ?>" hidden>
    <input type="text" name="o_district_id" id="o_district_id" value="<?php echo $customer_district_id; ?>" hidden>
    <input type="text" name="o_ward_id" id="o_ward_id" value="<?php echo $customer_ward_id; ?>" hidden>
    <div class="form-group">
        <!-- form-group Begin -->

        <label> Tên Của Bạn: </label>

        <input type="text" name="c_name" class="form-control" value="<?php echo $customer_name; ?>" required>

    </div><!-- form-group Finish -->

    <div class="form-group">
        <!-- form-group Begin -->

        <label> Email: </label>

        <input type="text" name="c_email" class="form-control" value="<?php echo $customer_email; ?>" readonly required>

    </div><!-- form-group Finish -->


    <div class="form-group">
        <!-- form-group Begin -->

        <label> Số Điện Thoại: </label>

        <input type="text" name="c_contact" class="form-control" value="<?php echo $customer_contact; ?>" required>

    </div><!-- form-group Finish -->
    <div class="column">
        <div class="row">
            <label class="col-md-5 control-label">Thành Phố</label>
            <select name="city_select" id="city_select" class="setw form-control" style="width : 230px">
            </select>
        </div>
        <div class="row" style="margin-top: 5px">
            <label class="col-md-5 control-label">Quận</label>
            <select name="district_select" id="district_select" class="setw form-control" style="width : 230px">
            </select>
        </div>
        <div class="row" style="margin-top: 5px">
            <label class="col-md-5 control-label">Phường</label>
            <select name="ward_select" class="setw form-control" id="ward_select" style="width : 230px">
            </select>
        </div>
    </div>

    <div class="form-group">
        <!-- form-group Begin -->

        <label> Địa Chỉ: </label>

        <input type="text" name="c_address" class="form-control" value="<?php echo $customer_address; ?>" required>

    </div><!-- form-group Finish -->


    <div class="text-center">
        <!-- text-center Begin -->

        <button name="update" class="btn btn-primary">
            <!-- btn btn-primary Begin -->

            <i class="fa fa-user-md"></i> Cập Nhật

        </button><!-- btn btn-primary inish -->

    </div><!-- text-center Finish -->

</form><!-- form Finish -->

<script>
    $(document).ready(function() {
        $.ajax({
            url: "http://localhost:3000/api/city",
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
                $('option[value=' + $('#o_city_id').val() + ']').attr('selected', true);
                $select.trigger('change');
            }
        });

        $('#city_select').on('change', function() {
            const cityid = this.value;
            $.ajax({
                url: "http://localhost:3000/api/district/" + cityid,
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
                    $('option[value=' + $('#o_ward_id').val() + ']').attr('selected', true);
                    $select.trigger('change');
                }
            });
        });

        $('#district_select').on('change', function() {
            const districtID = this.value;
            var $select = $('#ward_select');
            $select.empty();
            $select.append("<div class='loader'></div>");
            $.ajax({
                url: "http://localhost:3000/api/ward/" + districtID,
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
                    $('option[value=' + $('#o_district_id').val() + ']').attr('selected', true);
                }
            });
        });
    });
</script>


<?php

if (isset($_POST['update'])) {

    $update_id = $customer_id;

    $c_name = $_POST['c_name'];

    $c_address = $_POST['c_address'];

    $c_contact = $_POST['c_contact'];

    $city_id = $_POST['city_select'];

    $district_id = $_POST['district_select'];

    $ward_id = $_POST['ward_select'];

    if (isset($city_id) && isset($district_id) && isset($ward_id)) {
        $update_customer = "update users set name='$c_name',address='$c_address',phone='$c_contact' ,cityID = '$city_id', districtID ='$district_id', wardID ='$ward_id' where id='$update_id' ";

        $run_customer = mysqli_query($con, $update_customer);

        if ($run_customer) {

            echo "<script>alert('Cập Nhật Thành Công')</script>";

            // echo "<script>window.open('logout.php','_self')</script>";
        }
    }
}

?>