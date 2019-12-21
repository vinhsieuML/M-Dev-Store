<?php
$q=$_GET["q"];
include("../../includes/db.php");
// $con = mysqli_connect("localhost","root","","db_app");
// if (!$con)
//   {
//   die('Could not connect: '.mysqli_error(null));
//   }

//   mysqli_select_db($con,"ajax_demo");

$sql="SELECT * FROM size WHERE id_type = '".$q."'";
$result = mysqli_query($con,$sql);

echo " <b> Nhập số lượng theo size của sản phẩm </b> 
<hr>
<!-- <hr>
<table border='1'>
<tr>
<th>Size</th>
<th>Số lượng</th>

</tr> -->  ";
$i=0;






while($row = mysqli_fetch_array($result)) {
  $i++;
    //echo "<tr>";
    //echo "<td>" . $row['size_name'] . "</td>";
    //echo"<td><input type='text'></td>";
    echo"
    <div class='form-group'> <!--form-group Begin-->

               <!-- <label class='col-md-3 control-label' name='product_size'> Size " . $row['name'] . " </label> -->
                <div class='col-md-2'>
                  <input class='form-control' type='text' name='product_size_$i' value='Size " . $row['name'] . "'  required readonly >
                </div>
                <input type='hidden' name='size_id_$i' value='" . $row['id'] . "'  required readonly>

                <div class='col-md-3'>
                    <input type='number' min='0' name='product_qty_$i' class='form-control' placeholder='Số lượng'>
                </div>

                

    </div> <!--form-group End-->
    ";
  
  
}

echo"<input type='text' name='sl_size' value='" . $i . "'  required readonly hidden> ";


//echo "</table>";
mysqli_close($con);
?>