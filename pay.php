<?php

session_start();

$active = 'Cart';

include("includes/db.php");
include("functions/functions.php");

?>

<?php
if (isset($_POST['type'])) {

    $token =  $_SESSION['token'];
    // Them Buoc Check So Luong

    //Lay data
    $email = $_SESSION['customer_email'];

    $select_cart = "SELECT * from cart_detail cdt JOIN users urs ON urs.id = cdt.id_customer WHERE email = '$email'";

    $run_cart = mysqli_query($con, $select_cart);

    $count = mysqli_num_rows($run_cart);
    if($count == 0){
        echo 1;
        exit();
    }

    $arrayDetail = array();
    while ($row_cart = mysqli_fetch_array($run_cart)) {

        $pro_id = $row_cart['id_product'];

        $pro_size = $row_cart['id_size_detail'];

        $pro_qty = $row_cart['quantity'];

        $anCart = array(
            "id" => $pro_id,
            "idsize" => $pro_size,
            "quantity" => $pro_qty,
        );

        array_push($arrayDetail, $anCart);
    }
    //Check Out
    if ($_POST['type'] == 1) {
        $url = 'http://192.168.0.135:3000/api/cart';

        $fields = array(
            'token' => $token,
            'arrayDetail' => $arrayDetail,
        );

        //url-ify the data for the POST
        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

        //execute post
        $result = curl_exec($ch);
        curl_close($ch);

        if ($result == "THANH CONG") {
            echo "1";
        } else {
            echo "2";
        }

        //close connection
    }
    else{
        $url = 'http://192.168.0.135:3000/api/cartOnline';

        $fields = array(
            'token' => $token,
            'arrayDetail' => $arrayDetail,
        );

        //url-ify the data for the POST
        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        curl_close($ch);

        echo $result;
    }
}
?>