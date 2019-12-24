<?php 

session_start();

$active='Cart';

include("includes/db.php");
include("functions/functions.php");

?>

<?php 

if(isset($_POST['id_user'])){
    $id_user = $_POST['id_user'];
    $id_size = $_POST['id_size'];
    $qty = $_POST['quantity'];
    $update_qty = "update cart_detail set quantity='$qty' where id_customer=(select id FROM users WHERE email = '$id_user') AND id_size_detail='$id_size'";
    $run_qty = mysqli_query($con,$update_qty);
    if($run_qty){
        echo 'THANH_CONG';
    }
    else{
        echo 'THAT_BAI';
    }
}
?>