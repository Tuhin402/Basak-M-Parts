<?php foreach ($products as $product){ 
    $product_id = $product['id']; 
    $final_price = $product['mrp'] + ($product['mrp'] * ($product['gst'] / 100));

    $category_id = $product['cat_id'];
    $sql = "SELECT category FROM product_category WHERE id = $category_id";
    $result = $obj->fetch($sql);
    $category = $result[0]['category'];

    $company_id = $product['company_id'];
    $sql2 = "SELECT name FROM company WHERE id = $company_id";
    $result2 = $obj->fetch($sql2);
    $company_name = $result2[0]['name'];
?>
<div class="modal fullRight fade modal-quick-view" id="quickView<?php echo $product_id; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $product_id; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="tf-quick-view-image">
                <div class="wrap-quick-view wrapper-scroll-quickview">
                    <?php if(!empty($product['image_1'])) { ?>
                    <div class="quickView-item item-scroll-quickview" data-scroll-quickview="beige">
                        <img class="lazyload" data-src="../Admin/uploads/products/<?= $product['image_1'] ?>" src="../Admin/uploads/products/<?= $product['image_1'] ?>" alt="">
                    </div>
                    <?php } ?>
                    <?php if(!empty($product['image_2'])) { ?>
                    <div class="quickView-item item-scroll-quickview" data-scroll-quickview="beige">
                        <img class="lazyload" data-src="../Admin/uploads/products/<?= $product['image_2'] ?>" src="../Admin/uploads/products/<?= $product['image_2'] ?>" alt="">
                    </div>
                    <?php } ?>
                    <?php if(!empty($product['image_3'])) { ?>
                    <div class="quickView-item item-scroll-quickview" data-scroll-quickview="gray">
                        <img class="lazyload" data-src="../Admin/uploads/products/<?= $product['image_3'] ?>" src="../Admin/uploads/products/<?= $product['image_3'] ?>" alt="">
                    </div>
                    <?php } ?>
                    <?php if(!empty($product['image_4'])) { ?>
                    <div class="quickView-item item-scroll-quickview" data-scroll-quickview="gray">
                        <img class="lazyload" data-src="../Admin/uploads/products/<?= $product['image_4'] ?>" src="../Admin/uploads/products/<?= $product['image_4'] ?>" alt="">
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="wrap">
                <div class="header">
                    <h5 class="title">Quick View</h5>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="tf-product-info-list w-100">
                    <div class="tf-product-info-heading">
                        <div class="tf-product-info-name">
                            <div class="text text-btn-uppercase"><?= htmlspecialchars($category) ?></div>
                            <h3 class="name"><?= htmlspecialchars($product['name']) ?></h3>
                            <div class="sub">
                                <div class="tf-product-info-rate">
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
                                    <div class="text text-caption-1">(<?php echo $total_reviews; ?> reviews)</div>
                                </div>
                            </div>
                        </div>
                        <div class="tf-product-info-desc">
                            <div class="tf-product-info-price">
                                <h5 class="price-on-sale font-2">₹ <?= htmlspecialchars($product['b2c_price']) ?></h5>
                                <div class="compare-at-price font-2">₹ <?= htmlspecialchars($product['mrp']) ?></div>
                                <?php if($product['b2c_discount'] != 0) { ?>
                                <div class="badges-on-sale text-btn-uppercase">-<?= htmlspecialchars($product['b2c_discount']) ?>%</div>
                                <?php } ?>
                            </div>
                            <p><?= htmlspecialchars($product['description']) ?></p>
                        </div>
                    </div>
                    <div class="tf-product-info-choose-option">
                        <div class="tf-product-info-help">
                            <div class="tf-product-info-time">
                                <div class="icon"><i class="icon-timer"></i></div>
                                <p class="text-caption-1">Estimated Delivery:&nbsp;&nbsp;<span>3-6 days</span> (India)</p>
                            </div>
                            <div class="tf-product-info-return">
                                <div class="icon"><i class="icon-arrowClockwise"></i></div>
                                <p class="text-caption-1">Return within <span>4 days</span> after delivery. Duties & taxes are non-refundable.</p>
                            </div>
                        </div>
                        <ul class="tf-product-info-sku">
                            <li>
                                <p class="text-caption-1">HSN:</p>
                                <p class="text-caption-1 text-1"><?= htmlspecialchars($product['sku']) ?></p>
                            </li>
                            <li>
                                <p class="text-caption-1">Part No.:</p>
                                <p class="text-caption-1 text-1"><?= htmlspecialchars($product['part']) ?></p>
                            </li>
                            <li>
                                <p class="text-caption-1">Company:</p>
                                <p class="text-caption-1"><?= htmlspecialchars($company_name) ?></p>
                            </li>
                            <li>
                                <p class="text-caption-1">Availability:</p>
                                <p class="text-caption-1 text-1">
                                    <?= ($product['stock'] > 5) ? '<span style="color: green;">In Stock</span>' : '<span style="color: red;">Only 2 left</span>'; ?>
                                </p>
                            </li>
                            <li>
                                <p class="text-caption-1">Category:</p>
                                <p class="text-caption-1"><?= htmlspecialchars($category) ?></p>
                            </li>
                        </ul>
                        <div class="tf-product-info-guranteed">
                            <div class="text-title">
                                Guranteed safe checkout:
                            </div>
                            <div class="tf-payment">
                                <a href="javascript:void(0);"><img src="images/payment/img-1.png" alt=""></a>
                                <a href="javascript:void(0);"><img src="images/payment/img-2.png" alt=""></a>
                                <a href="javascript:void(0);"><img src="images/payment/img-3.png" alt=""></a>
                                <a href="javascript:void(0);"><img src="images/payment/img-4.png" alt=""></a>
                                <a href="javascript:void(0);"><img src="images/payment/img-5.png" alt=""></a>
                                <a href="javascript:void(0);"><img src="images/payment/img-6.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>