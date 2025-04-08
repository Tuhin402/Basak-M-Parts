<section class="flat-spacing pt-0"> 
    <div class="container">
        <div class="heading-section text-center wow fadeInUp">
            <h4 class="heading">You may also like</h4>
        </div>
        <div class="flat-animate-tab">
            <div class="tab-content">
                <div class="tab-pane active show" id="AllProducts" role="tabpanel">
                    <div class="row">
                        <?php 
                        $query = "SELECT * FROM products WHERE id >= (SELECT FLOOR( MAX(id) * RAND()) FROM products) ORDER BY sort_order ASC LIMIT 12";
                        $products = $obj->fetch($query);
                        foreach ($products as $product){ 
                            $product_id = $product['id'];
                            $stock = $product['stock'];
                        ?>
                        <div class="col-6 col-lg-2 col-md-3 col-sm-6 mb-4">
                            <div class="card-product wow fadeInUp" data-wow-delay="0.1s">
                                <div class="card-product-wrapper">
                                    <a href="product-detail.php?product_id=<?= base64_encode($product['id']) ?>" class="product-img">
                                        <?php if(!empty($product['image_1'])) { ?>
                                        <img class="lazyload img-product" data-src="../Admin/uploads/products/<?= $product['image_1'] ?>" src="../Admin/uploads/products/<?= $product['image_1'] ?>" alt="<?= $product['name'] ?>" style="object-fit: contain">
                                        <?php } ?>
                                        <?php if(!empty($product['image_2'])) { ?>
                                        <img class="lazyload img-hover" data-src="../Admin/uploads/products/<?= $product['image_2'] ?>" src="../Admin/uploads/products/<?= $product['image_2'] ?>" alt="<?= $product['name'] ?>" style="object-fit: contain">
                                        <?php } else { ?>
                                        <img class="lazyload img-hover" data-src="../Admin/uploads/products/<?= $product['image_1'] ?>" src="../Admin/uploads/products/<?= $product['image_1'] ?>" alt="<?= $product['name'] ?>" style="object-fit: contain">
                                        <?php } ?>
                                    </a>
                                    <?php if($product['b2c_discount'] != 0) { ?>
                                    <div class="on-sale-wrap"><span class="on-sale-item">-<?= htmlspecialchars($product['b2c_discount']) ?>%</span></div>
                                    <?php } ?>
                                    <div class="list-product-btn">
                                        <button type="button" class="box-icon wishlist btn-icon-action border-0 p-3" data-product-id="<?= $product_id ?>" data-price="<?= $product['b2c_price'] ?>">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip">Wishlist</span>
                                        </button>
                                        <a href="compare.php?product_id=<?= $product_id ?>" class="box-icon compare btn-icon-action">
                                            <span class="icon icon-gitDiff"></span>
                                            <span class="tooltip">Compare</span>
                                        </a>
                                        <button type="button" class="box-icon quickview tf-btn-loading border-0 p-3" data-bs-toggle="modal" data-bs-target="#quickView<?php echo $product_id; ?>">
                                            <span class="icon icon-eye"></span>
                                            <span class="tooltip">Quick View</span>
                                        </button>
                                    </div>
                                    <div class="list-btn-main">
                                        <button type="button" class="btn-main-product add-to-cart" data-product-id="<?= $product_id ?>" data-price="<?= $product['b2c_price'] ?>">
                                            Add To Cart
                                        </button>
                                    </div>
                                </div>
                                <div class="card-product-info">
                                    <a href="product-detail.php?product_id=<?= base64_encode($product['id']) ?>" class="title link mb-3"><?= htmlspecialchars($product['name']) ?></a>
                                    <div class="box-rating">
                                        <?php
                                        $sql = "SELECT AVG(rating) AS avg_rating, COUNT(*) AS total_reviews FROM product_reviews WHERE product_id = $product_id";
                                        $result = $obj->fetch($sql);
                                        $avg_rating = isset($result[0]['avg_rating']) ? round($result[0]['avg_rating'], 1) : 0;
                                        $total_reviews = isset($result[0]['total_reviews']) ? $result[0]['total_reviews'] : 0;
                                        ?>
                                        <div class="list-star">
                                            <?php
                                            $full_stars = floor($avg_rating);
                                            $half_star = ($avg_rating - $full_stars) >= 0.5 ? true : false;
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $full_stars) {
                                                    echo '<i class="fas fa-star icon"></i>'; 
                                                } elseif ($half_star) {
                                                    echo '<i class="fas fa-star-half icon"></i>'; 
                                                    $half_star = false;
                                                } else {
                                                    echo '<i class="icon icon-star-empty"></i>'; 
                                                }
                                            }
                                            ?>
                                        </div>
                                        <span class="text text-caption-1">(<?php echo $total_reviews; ?> reviews)</span>
                                    </div>
                                    <span class="price"><span class="old-price">₹ <?= htmlspecialchars($product['mrp']) ?></span>₹ <?= htmlspecialchars($product['b2c_price']) ?></span>
                                    <div class="box-progress-stock">
                                        <div class="stock-status d-flex justify-content-between align-items-center">
                                            <div class="stock-item text-caption-1">
                                                <?= ($stock > 5) ? '<span class="stock-value" style="color: green;">In Stock' : '<span class="stock-value" style="color: red;">Only 2 left</span>'; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>