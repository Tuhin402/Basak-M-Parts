<style>
    .bg-blue-2 {
        background-color: #F95454 !important;
    }
    .bg-blue-3 {
        background-color: #8E1616 !important;
    }
    .bg-main {
        background-color: #F95454;
    }
    #header .main-header.bg-blue-2 .nav-icon .nav-icon-item:hover svg path {
        stroke: #fff;
    }
    #header .nav-icon .nav-icon-item:hover .icon {
        color: var(--primary);
    }
    .tf-btn {
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease;
        background-color: #3c3d45;
        color: var(--white);
        padding: 15px 32px;
        border-radius: 99px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 16px;
        line-height: 26px;
        font-weight: 600;
        text-transform: capitalize;
        position: relative;
        overflow: hidden;
    }
    .wrapper-header-left .logo-header .logo {
        height: 100px;
        width: auto;
    }
    @media screen and (max-width: 800px) {
        .wrapper-header-left .logo-header .logo {
            height: 70px;
        }
    }
</style>

<?php
include "../Admin/config.php";
$userId = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;
$userName = isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : null;
?>

<!-- Header -->
<header id="header" class="header-default header-style-5 header-white">
    <div class="main-header bg-blue-2">
        <div class="container">
            <div class="row wrapper-header align-items-center line-top-rgba">
                <div class="col-md-4 col-3 d-xl-none">
                    <a href="#mobileMenu" class="mobile-menu" data-bs-toggle="offcanvas" aria-controls="mobileMenu">
                        <i class="icon text-white icon-categories"></i>
                    </a>
                </div>
                <div class="col-xl-8 col-md-4 col-6">
                    <div class="wrapper-header-left justify-content-center justify-content-xl-start">
                        <a href="index.php" class="logo-header"><img src="images/logo-white.png" alt="Basak M Parts logo" class="logo"></a>
                        <div class="d-xl-block d-none">
                            <div class="form-search-select">
                                <!-- search by company -->
                                <form action="shop_by_company.php" method="GET" novalidate>
                                    <div class="search-group">
                                        <input type="text" name="company_name" placeholder="Find Company.." required>
                                        <button type="submit" class="tf-btn"><span class="text">Search</span></button>
                                    </div>
                                </form>
                                <!-- search by part no. -->
                                <form action="search_part.php" method="GET" novalidate>
                                    <div class="search-group">
                                        <input type="text" name="part_no" placeholder="Enter Part No.." required>
                                        <button type="submit" class="tf-btn"><span class="text">Search</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-3">
                    <div class="wrapper-header-right">
                        <div class="d-none d-xl-flex box-support">
                            <span class="text-white icon icon-lifebuoy"></span>
                            <?php 
                            $infoQuery = "SELECT * FROM contact LIMIT 1";
                            $infos = $obj->fetch($infoQuery); 
                            ?>
                            <div>
                                <?php foreach ($infos as $info) { ?>
                                <div class="text-title text-white"><a href="tel:<?= htmlspecialchars($info['helpline']) ?>" class="text-white"> <?= htmlspecialchars($info['helpline']) ?></a></div>
                                <?php } ?>
                                <div class="text-white text-caption-2">24/7 Support Center</div>
                            </div>
                        </div>
                        <ul class="nav-icon d-flex justify-content-end align-items-center">
                            <li class="nav-search d-none d-xl-flex">
                                <a href="#generalSearch" data-bs-toggle="modal" class="nav-icon-item">
                                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M21.35 21.0004L17 16.6504" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>   
                                </a>
                            </li>
                            <li class="nav-search d-inline-flex d-xl-none">
                                <a href="#search" data-bs-toggle="modal" class="nav-icon-item">
                                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M21.35 21.0004L17 16.6504" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>   
                                </a>
                            </li>
                            <li class="nav-account">
                                <a href="#" class="nav-icon-item">
                                    <?php if ($userId): ?>
                                        <div class="user-circle" style="width: 34px; height: 34px; background-color: #612A34; color: #fff; border: 3px solid #181818; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 14px; font-weight: bold; text-transform: uppercase;">
                                            <?php echo strtoupper(substr($userName, 0, 1)); ?>
                                        </div>
                                    <?php else: ?>
                                        <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                                stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                                stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    <?php endif; ?>
                                </a>
                                <div class="dropdown-account dropdown-login">
                                    <div class="sub-top">
                                        <?php if ($userId): ?>
                                            <p class="text-center text-secondary-2">
                                                Welcome, <strong><?php echo htmlspecialchars($userName); ?></strong>
                                            </p>
                                        <?php else: ?>
                                            <a href="login.php" class="tf-btn btn-reset">Login</a>
                                            <p class="text-center text-secondary-2">
                                                Don’t have an account? <a href="register.php">Register</a>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($userId): ?>
                                        <div class="sub-bot d-flex flex-column align-items-center justify-content-center gap-2">
                                            <a class="tf-btn btn-reset" href="profile.php">My Account</a>
                                            <a class="tf-btn btn-reset" href="my_orders.php">My Orders</a>
                                            <a class="tf-btn btn-reset" href="logout.php">Logout</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <li class="nav-wishlist">
                                <a href="wish-list.php" class="nav-icon-item">
                                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.8401 4.60987C20.3294 4.09888 19.7229 3.69352 19.0555 3.41696C18.388 3.14039 17.6726 2.99805 16.9501 2.99805C16.2276 2.99805 15.5122 3.14039 14.8448 3.41696C14.1773 3.69352 13.5709 4.09888 13.0601 4.60987L12.0001 5.66987L10.9401 4.60987C9.90843 3.57818 8.50915 2.99858 7.05012 2.99858C5.59109 2.99858 4.19181 3.57818 3.16012 4.60987C2.12843 5.64156 1.54883 7.04084 1.54883 8.49987C1.54883 9.95891 2.12843 11.3582 3.16012 12.3899L4.22012 13.4499L12.0001 21.2299L19.7801 13.4499L20.8401 12.3899C21.3511 11.8791 21.7565 11.2727 22.033 10.6052C22.3096 9.93777 22.4519 9.22236 22.4519 8.49987C22.4519 7.77738 22.3096 7.06198 22.033 6.39452C21.7565 5.72706 21.3511 5.12063 20.8401 4.60987V4.60987Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg> 
                                    <?php if ($userId): 
                                        $wishlistCountQuery = "SELECT COUNT(*) as total FROM wishlist WHERE b2c_id = '$userId'";
                                        $wishlistCountResult = $obj->fetch($wishlistCountQuery);
                                        $wishlistCount = $wishlistCountResult[0]['total'] ?? 0; ?>
                                        <span class="count-box"><?= $wishlistCount ?></span>
                                    <?php endif; ?> 
                                </a>
                            </li>
                            <li class="nav-cart">
                                <a href="shopping-cart.php" class="nav-icon-item">
                                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.5078 10.8734V6.36686C16.5078 5.17166 16.033 4.02541 15.1879 3.18028C14.3428 2.33514 13.1965 1.86035 12.0013 1.86035C10.8061 1.86035 9.65985 2.33514 8.81472 3.18028C7.96958 4.02541 7.49479 5.17166 7.49479 6.36686V10.8734M4.11491 8.62012H19.8877L21.0143 22.1396H2.98828L4.11491 8.62012Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <?php if ($userId): 
                                        $cartCountQuery = "SELECT COUNT(*) as total FROM cart WHERE b2c_id = '$userId'";
                                        $cartCountResult = $obj->fetch($cartCountQuery);
                                        $cartCount = $cartCountResult[0]['total'] ?? 0; ?>
                                        <span class="count-box"><?= $cartCount ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom bg-blue-3 d-none d-xl-block">
        <div class="container">
            <div class="wrapper-header d-flex justify-content-between align-items-center">
                <div class="box-left">
                    <div class="tf-list-categories">
                        <a href="javascript:void(0)" class="categories-title"><span class="icon-left icon-squares-four"></span> <span class="text">Menu </span> <span class="icon icon-arrow-down"></span></a>
                        <div class="list-categories-inner">
                            <ul>
                                <li class="sub-categories2">
                                    <a href="javascript:void(0)" class="categories-item"><span class="inner-left">Products</span><i class="icon icon-arrRight"></i></a>
                                    <ul class="list-categories-inner">
                                        <?php 
                                        $sql = "SELECT DISTINCT pc.id, pc.category, pc.image FROM product_category pc JOIN category_company cc ON pc.id = cc.cat_id";
                                        $cats = $obj->fetch($sql);
                                        foreach ($cats as $cat) { ?>
                                        <li>
                                            <a href="products-list.php?cat_id=<?= $cat['id'] ?>" class="categories-item">
                                                <span class="inner-left"><?= htmlspecialchars($cat['category']) ?></span>
                                            </a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <li><a href="ourstore.php" class="categories-item"><span class="inner-left">Our Stores</span></a></li>
                                <li><a href="about-us.php" class="categories-item"><span class="inner-left">About Us</span></a></li>
                                <li><a href="contact-us.php" class="categories-item"><span class="inner-left">Contact Us</span></a></li>
                                <li><a href="returnpolicy.php" class="categories-item"><span class="inner-left">Return Policy</span></a></li>
                                <li><a href="#certificatesSection" class="categories-item"><span class="inner-left">Certificates</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <nav class="box-navigation">
                        <ul class="box-nav-ul d-flex align-items-center">
                            <li class="menu-item"><a href="index.php" class="item-link text-white">Home</a></li>
                            <li class="menu-item"><a href="about-us.php" class="item-link text-white">About Us</a></li>
                            <li class="menu-item"><a href="contact-us.php" class="item-link text-white">Contact Us</a></li>
                            <li class="menu-item"><a href="ourstore.php" class="item-link text-white">Our Store</a></li>
                            <?php if (!$userId): ?>
                                <li class="menu-item"><a href="../b2b/index.php" class="item-link text-white">B2B</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
                <div class="box-right">
                    <?php foreach ($infos as $info) { ?>
                    <ul class="box-nav-ul d-flex align-items-center">
                        <li class="menu-item text-white">
                            <a class="text-caption-1 text-white" href="tel:<?= htmlspecialchars($info['phone']) ?>"><?= htmlspecialchars($info['phone']) ?></a>
                        </li>
                        <li class="menu-item text-white">
                            <a class="text-caption-1 text-white" href="mailto:<?= htmlspecialchars($info['email']) ?>"><?= htmlspecialchars($info['email']) ?></a>
                        </li>
                        <li class="menu-item text-white">
                            <a class="text-caption-1 text-white text-decoration-underline" href="ourstore.php">Our Store</a>
                        </li>
                    </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- /Header -->

<!-- mobile menu -->
<div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
    <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
    <div class="mb-canvas-content">
        <div class="mb-body">
            <div class="mb-content-top">
                <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                    <li class="nav-mb-item active"><a href="index.php" class="mb-menu-link"><span>Home</span></a></li>
                    <!-- Main Menu Item -->
                    <li class="nav-mb-item">
                        <a href="#dropdown-menu-main" class="collapsed mb-menu-link" data-bs-toggle="collapse" aria-expanded="false" aria-controls="dropdown-menu-main">
                            <span>Menu</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="dropdown-menu-main" class="collapse">
                            <ul class="sub-nav-menu sub-menu-level-2">
                                <!-- Products Submenu -->
                                <li class="nav-mb-item">
                                    <a href="#dropdown-menu-products" class="collapsed mb-menu-link" data-bs-toggle="collapse" aria-expanded="false" aria-controls="dropdown-menu-products">
                                        <span>Products</span>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="dropdown-menu-products" class="collapse">
                                        <ul class="sub-nav-menu sub-menu-level-2">
                                            <?php foreach ($cats as $cat) { ?>
                                            <li>
                                                <a href="products-list.php?cat_id=<?= $cat['id'] ?>" class="sub-nav-link">
                                                    <span><?= htmlspecialchars($cat['category']) ?></span>
                                                </a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="ourstore.php" class="sub-nav-link">Our Store</a></li>
                                <li><a href="about-us.php" class="sub-nav-link">About Us</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-mb-item"><a href="contact-us.php" class="mb-menu-link"><span>Contact Us</span></a></li>
                    <li class="nav-mb-item">
                        <a href="#dropdown-menu-policies" class="collapsed mb-menu-link" data-bs-toggle="collapse" aria-expanded="false" aria-controls="dropdown-menu-policies">
                            <span>Policies</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="dropdown-menu-policies" class="collapse">
                            <ul class="sub-nav-menu sub-menu-level-2">
                                <li><a href="shipping_policy.php" class="sub-nav-link">Shipping Policy</a></li>
                                <li><a href="privacy_policy.php" class="sub-nav-link">Privacy Policy</a></li>
                                <li><a href="returnpolicy.php" class="sub-nav-link">Return & Refund</a></li>
                                <li><a href="terms.php" class="sub-nav-link">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </li>
                    <?php if ($userId) { ?>
                        <li class="nav-mb-item"><a href="profile.php" class="mb-menu-link"><span>My Account</span></a></li>
                        <li class="nav-mb-item"><a href="my_orders.php" class="mb-menu-link"><span>My Orders</span></a></li>
                        <li class="nav-mb-item mt-4"><a href="logout.php" class="tf-btn btn-reset">Logout</a></li>
                    <?php } else { ?>
                        <li class="nav-mb-item"><a href="../b2b/index.php" class="mb-menu-link fw-bold" style="color: #00529f;">B2B</a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="mb-other-content">
                <div class="group-icon">
                    <a href="wish-list.php" class="site-nav-icon">
                        <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.8401 4.60987C20.3294 4.09888 19.7229 3.69352 19.0555 3.41696C18.388 3.14039 17.6726 2.99805 16.9501 2.99805C16.2276 2.99805 15.5122 3.14039 14.8448 3.41696C14.1773 3.69352 13.5709 4.09888 13.0601 4.60987L12.0001 5.66987L10.9401 4.60987C9.90843 3.57818 8.50915 2.99858 7.05012 2.99858C5.59109 2.99858 4.19181 3.57818 3.16012 4.60987C2.12843 5.64156 1.54883 7.04084 1.54883 8.49987C1.54883 9.95891 2.12843 11.3582 3.16012 12.3899L4.22012 13.4499L12.0001 21.2299L19.7801 13.4499L20.8401 12.3899C21.3511 11.8791 21.7565 11.2727 22.033 10.6052C22.3096 9.93777 22.4519 9.22236 22.4519 8.49987C22.4519 7.77738 22.3096 7.06198 22.033 6.39452C21.7565 5.72706 21.3511 5.12063 20.8401 4.60987V4.60987Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        Wishlist
                    </a>
                    <?php if ($userId): ?>
                        <a href="javascript:void(0)" class="site-nav-icon">
                            <span class="text-caption-1">Welcome, <?php echo htmlspecialchars($userName); ?></span>
                        </a>
                    <?php else: ?>
                        <a href="login.php" class="site-nav-icon">
                            <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            Login
                        </a>
                    <?php endif; ?>
                </div>
                <div class="mb-notice"><a href="contact-us.php" class="text-need">Need Help?</a></div>
                <div class="mb-contact">
                    <?php foreach ($infos as $info) { ?>
                    <p class="text-caption-1"><?= htmlspecialchars($info['address']) ?></p>
                    <a href="<?= htmlspecialchars($info['map']) ?>" target="_blank" class="tf-btn-default text-btn-uppercase">GET DIRECTION<i class="icon-arrowUpRight"></i></a>
                    <?php } ?>
                </div>
                <ul class="mb-info">
                    <li>
                        <i class="icon icon-mail"></i>
                        <?php foreach ($infos as $info) { ?>
                        <p><a href="mailto:<?= htmlspecialchars($info['email']) ?>"><?= htmlspecialchars($info['email']) ?></a></p>
                        <?php } ?>
                    </li>
                    <li>
                        <i class="icon icon-phone"></i>
                        <?php foreach ($infos as $info) { ?>
                        <p><a href="tel:<?= htmlspecialchars($info['phone']) ?>"><?= htmlspecialchars($info['phone']) ?></a></p>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mb-bottom"></div>
    </div>
</div>
<!-- /mobile menu -->