<div class="offcanvas offcanvas-start canvas-filter" id="filterShop">
    <div class="canvas-wrapper">
        <div class="canvas-header">
            <h5>Filters</h5>
            <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        </div>
        <div class="canvas-body">
            <!-- Categories -->
            <div class="widget-facet facet-categories">
                <h6 class="facet-title">Product Categories</h6>
                <div class="box-fieldset-item">
                    <?php
                    $query = "SELECT DISTINCT pc.id, pc.category FROM product_category pc JOIN category_company cc ON pc.id = cc.cat_id";
                    $categories = $obj->fetch($query);
                    foreach ($categories as $category) {
                    ?>
                    <fieldset class="fieldset-item d-flex align-items-center justify-content-start gap-2 mb-3">
                        <input type="checkbox" name="<?= $category['category'] ?>" id="<?= $category['category'] ?>" class="tf-check category-checkbox" value="<?= $category['id'] ?>">
                        <label for="<?= $category['category'] ?>"><?= $category['category'] ?></label>
                    </fieldset>
                    <?php } ?>
                </div>
            </div>
            <!-- Company -->
            <div class="widget-facet facet-fieldset">
                <h6 class="facet-title">Companies</h6>
                <div class="box-fieldset-item">
                    <?php
                    $sql = "SELECT DISTINCT c.id, c.name FROM company c JOIN category_company cc ON c.id = cc.company_id";
                    $companies = $obj->fetch($sql);
                    foreach ($companies as $company) {
                    ?>
                    <fieldset class="fieldset-item d-flex align-items-center justify-content-start gap-2 mb-3">
                        <input type="checkbox" name="<?= $company['name'] ?>" id="<?= $company['name'] ?>" class="tf-check company-checkbox" value="<?= $company['id'] ?>">
                        <label for="<?= $company['name'] ?>"><?= $company['name'] ?></label>
                    </fieldset>
                    <?php } ?>
                </div>
            </div>
            <!-- price range -->
            <?php
            $query = "SELECT MIN(b2c_price) AS min_b2c_price, MAX(b2c_price) AS max_b2c_price FROM products";
            $result = $obj->fetch($query);

            $min_price = !empty($result[0]['min_b2c_price']) ? $result[0]['min_b2c_price'] : 1;
            $max_price = !empty($result[0]['max_b2c_price']) ? $result[0]['max_b2c_price'] : 10000;
            ?>
            <div class="widget-facet facet-price">
                <h6 class="facet-title">Price</h6>
                <div id="price-value-range" data-min="<?= floatval($min_price) ?>" data-max="<?= floatval($max_price) ?>"></div>
                <div class="box-price-product mt-3">
                    <div class="box-price-item">
                        <span class="title-price">Min price</span>
                        <div class="price-val" id="price-min-value"><?= floatval($min_price) ?></div>
                    </div>
                    <div class="box-price-item">
                        <span class="title-price">Max price</span>
                        <div class="price-val" id="price-max-value"><?= floatval($max_price) ?></div>
                    </div>
                </div>
            </div>
            <!-- Availability -->
            <div class="widget-facet facet-fieldset">
                <h6 class="facet-title">Availability</h6>
                <div class="box-fieldset-item">
                    <fieldset class="fieldset-item">
                        <input type="checkbox" name="availability" class="tf-check" id="inStock" checked>
                        <label for="inStock">In stock</label>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="canvas-bottom">
            <button id="apply_filter" class="tf-btn btn-reset">Apply Filters</button>
        </div>
    </div>
</div>