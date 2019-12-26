<?php

$active = 'Shop';
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
                    <a href="index.php">Trang chủ</a>
                </li>
                <li>
                    Cửa hàng
                </li>
            </ul><!-- breadcrumb Finish -->

        </div><!-- col-md-12 Finish -->

        <div class="col-md-3">
            <!-- col-md-3 Begin -->

            <?php

            include("includes/sidebar.php");

            ?>

        </div><!-- col-md-3 Finish -->

        <div class="col-md-9">
            <!-- col-md-9 Begin -->
            <?php

            getpcatpro();

            gethang();

            search();
            ?>
            
            

        </div><!-- col-md-9 Finish -->

        <div id="wait" style="position:absolute;top:40%;left:45%;padding: 200px 100px 100px 100px;"></div>

    </div><!-- container Finish -->
</div><!-- #content Finish -->

<?php

include("includes/footer.php");

?>

<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>



</body>

</html>