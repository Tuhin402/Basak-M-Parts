<?php
include "../Admin/config.php"; 

$categories = isset($_POST['categories']) ? json_decode($_POST['categories']) : [];
$companies = isset($_POST['companies']) ? json_decode($_POST['companies']) : [];
$min_price = isset($_POST['min_price']) ? floatval($_POST['min_price']) : 1;
$max_price = isset($_POST['max_price']) ? floatval($_POST['max_price']) : 10000;
$in_stock = isset($_POST['in_stock']) ? intval($_POST['in_stock']) : 0;

$sql = "SELECT * FROM products WHERE 1=1";

if (!empty($categories)) {
    $cat_ids = implode(",", array_map("intval", $categories));
    $sql .= " AND cat_id IN ($cat_ids)";
}

if (!empty($companies)) {
    $comp_ids = implode(",", array_map("intval", $companies));
    $sql .= " AND company_id IN ($comp_ids)";
}

if ($min_price > 0 || $max_price > 0) {
    $sql .= " AND b2b_price >= $min_price AND b2b_price <= $max_price";
}

if ($in_stock) {
    $sql .= " AND stock > 5";
}

$products = $obj->fetch($sql);

if (!empty($products)) {
    foreach ($products as $product) { 
        $product_id = $product['id'];
        ?>
        <div class="card-product grid" data-availability="In stock" data-brand="brand">
            <div class="card-product-wrapper">
                <a href="product-detail.php?product_id=<?= base64_encode($product_id) ?>" class="product-img">
                    <?php if(!empty($product['image_1'])) { ?>
                    <img class="lazyload img-product" data-src="../Admin/uploads/products/<?= $product['image_1'] ?>" src="../Admin/uploads/products/<?= $product['image_1'] ?>" alt="<?= $product['name'] ?>" style="object-fit: contain">
                    <?php } ?>
                    <?php if(!empty($product['image_2'])) { ?>
                    <img class="lazyload img-hover" data-src="../Admin/uploads/products/<?= $product['image_2'] ?>" src="../Admin/uploads/products/<?= $product['image_2'] ?>" alt="<?= $product['name'] ?>" style="object-fit: contain">
                    <?php } else { ?>
                    <img class="lazyload img-hover" data-src="../Admin/uploads/products/<?= $product['image_1'] ?>" src="../Admin/uploads/products/<?= $product['image_2'] ?>" alt="<?= $product['name'] ?>" style="object-fit: contain">
                    <?php } ?>
                </a>
                <div class="list-product-btn">
                    <button type="button" class="box-icon wishlist btn-icon-action border-0 p-3" data-product-id="<?= $product_id ?>" data-price="<?= $product['b2b_price'] ?>">
                        <span class="icon icon-heart"></span>
                        <span class="tooltip">Wishlist</span>
                    </button>
                    <a href="compare.php?product_id=<?= $product_id ?>" class="box-icon compare btn-icon-action">
                        <span class="icon icon-gitDiff"></span>
                        <span class="tooltip">Compare</span>
                    </a>
                    <button type="button" class="box-icon quickview tf-btn-loading border-0 p-3" data-bs-toggle="modal" data-bs-target="#quickView<?= $product_id; ?>">
                        <span class="icon icon-eye"></span>
                        <span class="tooltip">Quick View</span>
                    </button>
                </div>
                <div class="list-btn-main">
                    <button type="button" class="btn-main-product add-to-cart" data-product-id="<?= $product_id ?>" data-price="<?= $product['b2b_price'] ?>">
                        Add To Cart
                    </button>
                </div> 
            </div>
            <div class="card-product-info">
                <a href="product-detail.php?product_id=<?= base64_encode($product_id) ?>" class="title link"><?= htmlspecialchars($product['name']) ?></a>
                <span class="price current-price">₹<?= number_format($product['b2b_price'], 2) ?></span>
            </div>
        </div>
        <?php 
    }
} else {
    echo "<p>No data found as per your selection.</p>";
}
?>