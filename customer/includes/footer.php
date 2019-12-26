<div id="footer"> <!-- Footer Begin-->
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-3">

                <h4><img src="../images/logo2.png" alt=""></h4>
                <!-- <p class="addressp">Với mong muốn lan tỏa tình yêu với trái bóng cam 
                    đến tất cả mọi người. SH Shop luôn cập nhật những sản phẩm mới nhất,
                     tốt nhất cùng với những lời tư vấn chân thành nhất.
                </p>

                <hr> -->
              
                <ul>
                    <li class="space_line"><a href="cart.php">Giỏ hàng</a></li>
                    <li class="space_line"><a href="customer/my_account.php">Tài khoản</a></li>
                    <li class="space_line"><a href="shop.php">Cửa hàng</a></li>  
                    <li class="space_line"><a href="contact.php">Liên hệ</a></li>                 
                </ul>

             
                <!-- <hr>

                <h4>User Section</h4>
                <ul>
                    <li><a href="cart.php">Đăng nhập</a></li>
                    <li><a href="checkout.php">Đăng ký</a></li>            
                </ul>

                <hr class="hidden-md hidden-lg hidden-sm"> -->

            </div>

            <div class="col-sm-6 col-md-3">
                <h4 class="headline">Danh mục sản phẩm</h4>
                <ul>
                <?php 
                    
                    $get_p_cats = "select * from product_type";
                
                    $run_p_cats = mysqli_query($con,$get_p_cats);
                
                    while($row_p_cats=mysqli_fetch_array($run_p_cats)){
                        
                        $p_cat_id = $row_p_cats['id'];
                        
                        $p_cat_title = $row_p_cats['name'];
                        
                        echo "
                        
                            <li class='space_line'>
                            
                                <a href='shop.php?p_cat=$p_cat_id'>
                                
                                    $p_cat_title
                                
                                </a>
                            
                            </li>
                        
                        ";
                        
                    }
                
                ?>
                </ul>

                <!-- <h4 class="headline">Thao tác</h4>
                
                <ul>
                    <li class="space_line2"><a href="cart.php">Đăng nhập</a></li>
                    <li class="space_line2"><a href="checkout.php">Đăng ký</a></li>            
                </ul>

                <hr class="hidden-md hidden-lg hidden-sm"> -->

            </div>

            <div class="col-sm-6 col-md-3">
                <h4 class="headline">Liên hệ với chúng tôi</h4>
                <p class="addressp">
                    <!-- <strong>SH Shop</strong> -->
                    Mr.Sieu - 0897644321
                    <br/>Mr.Hoang - 0377577205
                    <br/>shshop_basketball@gmail.com
                    <br/>Địa chỉ: 417 KTX khu A, Linh Trung, Thủ Đức, TP.HCM
                </p>

                <a href="contact.php">Xem thông tin liên hệ của chúng tôi</a>
                <hr class="hidden-md hidden-lg">

            </div>

            <div class="com-sm-6 col-md-3">
                <h4 class="headline">Nhận thông tin mới nhất</h4>
                <p class="text-muted addressp">
                    Hãy đăng ký nhận thông tin để không bỏ lỡ những sản phẩm mới nhất!
                     
                 </p>

               <form action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" 
                onsubmit="window.open('feedburner.google.com/fb/a/mailverify?uri=FlyToAnotherSky', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" name="email">
                        <input type="hidden" value="FlyToAnotherSky" name="uri"/><input type="hidden" name="loc" value="en_US"/>
                        <span class="input-group-btn">
                            <input type="submit" value="Subscribe" class="btn btn-default subc">
                        </span>
                    </div>               
               </form>

               

                <hr>

               <h4 class="headline">Theo dõi shop trên:</h4>
                <p class="social">
                    <a href="#" class="fa fa-facebook"></a>
                    
                    <a href="#" class="fa fa-instagram"></a>
                   
                    <a href="#" class="fa fa-envelope"></a>
                </p>
            </div>



        </div>
    </div>
</div> <!-- Footer Finish-->

<p class="footer-bottom-text">&copy;2019 SH Shop All Right Reserve</p>