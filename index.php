<!DOCTYPE html>
<html lang="en">
<?php
require_once('header.php');
require_once('model/product_db.php');
require_once('model/category_db.php');
$productdb = new Product_DB();
$categorydb = new Category_DB();
// Từ khóa tìm kiếm
$keyword =  isset($_GET['keyword']) ? $_GET['keyword'] : '';

// trả về loại sản phẩm đầu tiên nếu không có loại nào
$category_id_selected = isset($_GET['category_id']) ? $_GET['category_id'] : 1;


// giới hạn số trang hiển thị trên thanh phân trang
$offset = 2;
// hiển thị 5 sản phẩm trên 1 trang
$perPage = 3;
// Lấy số trang trên thanh địa chỉ
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
// Tính tổng số dòng, ví dụ kết quả là 18
$total = $productdb->selectSoLuongByLoaiSanPham($category_id_selected);
// lấy đường dẫn đến file hiện hành
$url = $_SERVER['PHP_SELF'] . "?category_id=$category_id_selected&";

// danh sách sản phẩm phan trang
$listSP_PhanTrang = $productdb->select($currentPage, $perPage, $category_id_selected);

// danh sách loại sản phẩm
$listDM = $categorydb->select();


?>

<body>
    <?php
    require_once('body_header.php');
    require_once('body_navigation.php');
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
                        <!-- <span class="store-qty">Showing 20-100 products</span> -->
                        <ul class="store-pagination">
                            <?php echo $productdb->getPaginationBar($url, $total, $currentPage, $perPage, $offset) ?>
                        </ul>
                    </div>
                    <!-- /store bottom filter -->

                    <!-- store products -->
                    <div class="row">
                        <!-- product -->
                        <?php


                        foreach ($listSP_PhanTrang as $key => $value) {
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
                                    <p class='product-category'>{$value['cname']}</p>
                                    <h3 class='product-name'><a href='#'>{$value['pname']}</a></h3>
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