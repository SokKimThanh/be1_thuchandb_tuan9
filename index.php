<!DOCTYPE html>
<html lang="en">
<?php
require_once('header.php');
require_once('model/product_db.php');
$productdb = new Product_DB();

// $keyword =  isset($_GET['keyword']) ? $_GET['keyword'] : '';
// hiển thị 5 sản phẩm trên 1 trang
// $perPage = 3;
// Lấy số trang trên thanh địa chỉ
// $page = isset($_GET['page']) ? $_GET['page'] : 1;
// Tính tổng số dòng, ví dụ kết quả là 18
// $total = $productDB->getSoLuong($keyword);
// lấy đường dẫn đến file hiện hành
// $url = $_SERVER['PHP_SELF'] . "?keyword={$keyword}&";

// $searchList = $productDB->search($keyword, $currentPage, $perPage);

?>

<body>
    <?php
    require_once('body_header.php');
    // require_once('body_navigation.php');
    ?>
     
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- STORE -->
                <div id="store" class="col-md-12">
                    <!-- /store products -->

                    <!-- store bottom filter -->
                    <div class="store-filter clearfix">
                        <span class="store-qty">Showing 20-100 products</span>
                        <ul class="store-pagination">
                            <li class="active">1</li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5<i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                    <!-- /store bottom filter -->

                    <!-- store products -->
                    <div class="row">
                        <!-- product -->
                        <?php

                        foreach ($productdb->select() as $key => $value) {
                            echo "
                            <div class='col-md-4 col-xs-6'>
                            <div class='product'>
                                <div class='product-img'>
                                    <img src='./img/{$value['image']}' alt=''>
                                    <div class='product-label'>
                                        <span class='sale'>-30%</span>
                                        <span class='new'>NEW</span>
                                    </div>
                                </div>
                                <div class='product-body'>
                                    <p class='product-category'>Category</p>
                                    <h3 class='product-name'><a href='#'>{$value['name']}</a></h3>
                                    <h4 class='product-price'>$ {$value['price']} <del class='product-old-price'>$990.00</del></h4>
                                    <div class='product-rating'>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                    </div>
                                    <div class='product-btns'>
                                        <button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to wishlist</span></button>
                                        <button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button>
                                        <button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button>
                                    </div>
                                </div>
                                <div class='add-to-cart'>
                                    <button class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> add to cart</button>
                                </div>
                            </div>
                        </div>
                            ";
                        }
                        ?>

                        <!-- /product -->

                        <!-- /product -->
                    </div>

                </div>
                <!-- /STORE -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->



    <!-- FOOTER -->
    <?php require_once('footer.php') ?>

</body>

</html>