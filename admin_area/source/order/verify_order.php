<?php

if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

?>

<?php

    if (isset($_GET['verify_order'])) {

        $verify_id = $_GET['verify_order'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://192.168.0.135:3000/api/getGHN",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "billID=$verify_id&isCod=0",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        if ($response != 'THAT_BAI') {
            echo "<script>console.log($response)</script>";
            $response = json_decode($response);
            $orderID = $response['OrderID'];
            $orderCode = $response['OrderCode'];
            $expectedDeliveryTime = $response['ExpectedDeliveryTime'] ;
            $totalServiceFee = $response['TotalServiceFee'];

            echo "<script>console.log($orderID,$orderCode,$expectedDeliveryTime,$totalServiceFee)</script>";
            // $delete_order = "UPDATE  bill SET status = '3', orderID ='$response' where id='$verify_id'";

            // $run_delete = mysqli_query($con, $delete_order);

            // if ($run_delete) {

            //     echo "<script>alert('Xác nhận thành công hay giao hàng cho bên vận chuyển')</script>";

            //     echo "<script>window.open('index.php?view_orders','_self')</script>";
            // }
        } else {
            echo "<script>console.log('THATBAI')</script>";
        }
    }

?>

<?php } ?>