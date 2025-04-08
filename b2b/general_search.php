<div class="modal fade modal-search" id="generalSearch" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Search</h5>
                <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
            </div>
            <!--general search-->
            <div class="form-search">
                <form action="search_product.php" method="GET" novalidate>
                    <fieldset class="text">
                        <input type="text" name="product" placeholder="Search any product..." required>
                    </fieldset>
                    <button type="submit">
                    <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M21.35 21.0004L17 16.6504" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    </button>
                </form>
            </div>
            <!--/general search-->
            
            <!--random products-->
            <div>
                <h6 class="mb_16">Handpicked for You</h6>
                <div class="row">
                    <?php 
                    $query = "SELECT * FROM products WHERE best_seller = 'yes' ORDER BY sort_order ASC LIMIT 8";
                    $products = $obj->fetch($query);
                    foreach ($products as $product){ 
                        $product_id = $product['id'];
                        $stock = $product['stock'];
                    ?>
                    <div class="col-6 col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
                        <div class="card-product wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                            <div class="card-product-wrapper">
                                <a class="product-img" href="product-detail.php?product_id=<?= base64_encode($product['id']) ?>">
                                    <img loading="lazy" decoding="async" data-nimg="1" class="lazyload img-product" style="color: transparent; object-fit: contain;" src="../Admin/uploads/products/<?= $product['image_1'] ?>" alt="<?= $product['name'] ?>">
                                    <?php if(!empty($product['image_2'])) { ?>
                                    <img loading="lazy" decoding="async" data-nimg="1" class="lazyload img-hover" style="color: transparent; object-fit: contain;" src="../Admin/uploads/products/<?= $product['image_2'] ?>" alt="<?= $product['name'] ?>">
                                    <?php } else { ?>
                                    <img loading="lazy" decoding="async" data-nimg="1" class="lazyload img-hover" style="color: transparent; object-fit: contain;" src="../Admin/uploads/products/<?= $product['image_1'] ?>" alt="<?= $product['name'] ?>">
                                    <?php } ?>
                                </a>
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
                                <a href="product-detail.php?product_id=<?= base64_encode($product['id']) ?>" class="title link"><?= htmlspecialchars($product['name']) ?></a>
                                <span class="price">₹ <?= htmlspecialchars($product['b2b_price']) ?></span>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!--/random products--> 
            
            <!--load more-->
            <div class="wd-load view-more-button text-center">
                <a href="products-all.php" class="tf-loading btn-loadmore tf-btn btn-reset">
                    <span class="text text-btn text-btn-uppercase">Load More</span>
                </a>
            </div>
            <!--/load more-->
        </div>
    </div>
</div>