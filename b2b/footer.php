<footer id="footer" class="footer bg-main">
    <div class="footer-wrap">
        <div class="footer-body">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="footer-infor">
                            <div class="footer-logo">
                                <a href="index.php">
                                    <img src="images/logo-white.png" alt="" class="logo" style="height: 100px; width: auto;">
                                </a>
                            </div>
                            <?php 
                            $infoQuery = "SELECT * FROM contact";
                            $infos = $obj->fetch($infoQuery); 
                            ?>
                            <div class="footer-address">
                                <?php foreach ($infos as $info) { ?>
                                <p><?= htmlspecialchars($info['address']) ?></p>
                                <a href="<?= htmlspecialchars($info['map']) ?>" target="_blank" class="tf-btn-default style-white fw-6">GET DIRECTION<i class="icon-arrowUpRight"></i></a>
                                <?php } ?>
                            </div>
                            <ul class="footer-info">
                                <li>
                                    <i class="icon-mail"></i>
                                    <?php foreach ($infos as $info) { ?>
                                    <p><a href="mailto:<?= htmlspecialchars($info['email']) ?>" class="text-light"><?= htmlspecialchars($info['email']) ?></a></p>
                                    <?php } ?>
                                </li>
                                <li>
                                    <i class="icon-phone"></i>
                                    <?php foreach ($infos as $info) { ?>
                                    <p><a href="tel:<?= htmlspecialchars($info['phone']) ?>" class="text-light"><?= htmlspecialchars($info['phone']) ?></a></p>
                                    <?php } ?>
                                </li>
                            </ul>
                            <ul class="tf-social-icon style-white">
                                <li><a href="https://www.facebook.com/basakmparts" class="social-facebook" target="_blank"><i class="icon icon-fb"></i></a></li>
                                <li><a href="https://www.instagram.com/basak_m_parts/" class="social-instagram" target="_blank"><i class="icon icon-instagram"></i></a></li>
                                <li><a href="https://www.youtube.com/@basakmparts" class="social-youtube" target="_blank"><i class="icon icon-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-menu">
                            <div class="footer-col-block">
                                <div class="footer-heading text-button footer-heading-mobile">
                                    Pages
                                </div>
                                <div class="tf-collapse-content">
                                    <ul class="footer-menu-list">
                                        <li class="text-caption-1">
                                            <a href="about-us.php" class="footer-menu_item">About Us</a>
                                        </li>
                                        <li class="text-caption-1">
                                            <a href="contact-us.php" class="footer-menu_item">Contact us</a>
                                        </li>
                                        <li class="text-caption-1">
                                            <a href="products-all.php" class="footer-menu_item">All Products</a>
                                        </li>
                                        <li class="text-caption-1">
                                            <a href="ourstore.php" class="footer-menu_item">Our Stores</a>
                                        </li>
                                        <li class="text-caption-1">
                                            <a href="wish-list.php" class="footer-menu_item">My Wishlist</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="footer-col-block">
                                <div class="footer-heading text-button footer-heading-mobile">
                                    Customer Services
                                </div>
                                <div class="tf-collapse-content">
                                    <ul class="footer-menu-list">
                                        <li class="text-caption-1">
                                            <a href="shipping_policy.php" class="footer-menu_item">Shipping Policy</a>
                                        </li>
                                        <li class="text-caption-1">
                                            <a href="returnpolicy.php" class="footer-menu_item">Return & Refund</a>
                                        </li>
                                        <li class="text-caption-1">
                                            <a href="privacy_policy.php" class="footer-menu_item">Privacy Policy</a>
                                        </li>
                                        <li class="text-caption-1">
                                            <a href="terms.php" class="footer-menu_item">Terms & Conditions</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-col-block">
                            <div class="footer-heading text-button footer-heading-mobile">Newletter</div>
                            <div class="tf-collapse-content">
                                <div class="footer-newsletter">
                                    <p class="text-caption-1">Sign up to our website to buy your necessary goods.</p>
                                    <form id="subscribe-form" action="#" class="form-newsletter subscribe-form style-black" method="post" accept-charset="utf-8" data-mailchimp="true">
                                        <div id="subscribe-content" class="subscribe-content">
                                            <div class="email">
                                                <a href="register_B_to_B.php" class="btn btn-sm btn-outline-info fw-bold fs-22 px-3 py-2 rounded-pill mt-3">Register  🡥</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-bottom-wrap">
                            <div class="left">
                                <p class="text-caption-1">©2025 Basak M Parts. All Rights Reserved.</p>
                            </div>
                            <div class="tf-payment">
                                <p class="text-caption-1">Payment:</p>
                                <ul>
                                    <li><img src="images/img-1.png" alt=""></li>
                                    <li><img src="images/img-2.png" alt=""></li>
                                    <li><img src="images/img-3.png" alt=""></li>
                                    <li><img src="images/img-4.png" alt=""></li>
                                    <li><img src="images/img-5.png" alt=""></li>
                                    <li><img src="images/img-6.png" alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>