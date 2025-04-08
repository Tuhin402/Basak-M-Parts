<div class="main-nav">
    <!-- Sidebar Logo -->
    <div class="logo-box">
        <a href="dashboard.php" class="logo-dark">
            <img src="images/logo-white.png" class="logo-sm" alt="logo sm">
            <img src="images/logo-white.png" class="logo-lg" alt="logo dark">
        </a>

        <a href="dashboard.php" class="logo-light">
            <img src="images/logo-white.png" class="logo-sm" alt="logo sm">
            <img src="images/logo-white.png" class="logo-lg" alt="logo light">
        </a>
    </div>

    <!-- Menu Toggle Button (sm-hover) -->
    <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
        <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone" class="button-sm-hover-icon"></iconify-icon>
    </button>

    <div class="scrollbar" data-simplebar="">
        <ul class="navbar-nav" id="navbar-nav">

            <li class="menu-title">General</li>         
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Dashboard </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarCategories" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCategories">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:clipboard-list-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Category </span>
                </a>
                <div class="collapse" id="sidebarCategories">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="product_category.php">Product Category</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="company_category.php">Company</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarProducts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProducts">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:box-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Products </span>
                </a>
                <div class="collapse" id="sidebarProducts">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="product_add.php">Create</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="product_list.php">List</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="low_stock.php">Low Stock</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="refill_stock.php">Stock Refill</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarSell" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSell">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:shop-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Offline Sells </span>
                </a>
                <div class="collapse" id="sidebarSell">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="offline_sell.php">Sell</a>
                        </li><li class="sub-nav-item">
                            <a class="sub-nav-link" href="offline_sell_list.php">List</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarOrders" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarOrders">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:bag-smile-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Orders </span>
                </a>
                <div class="collapse" id="sidebarOrders">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="b2c_order_list.php">B2C Orders</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="b2b_order_list.php">B2B Orders</a>
                        </li>
                    </ul>
                </div>
            </li>
            
            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarCancels" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCancels">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:close-circle-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Order Cancellation </span>
                </a>
                <div class="collapse" id="sidebarCancels">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="pending_cancellation.php">Pending</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="refunded_cancellation.php">Completed</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarReturns" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarReturns">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:refresh-circle-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Order Return </span>
                </a>
                <div class="collapse" id="sidebarReturns">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="pending_return.php">Pending</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="refunded_return.php">Completed</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarPicks" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPicks">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:tag-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Popular Offers </span>
                </a>
                <div class="collapse" id="sidebarPicks">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="b2c_pick.php">B2C Offers</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="b2b_pick.php">B2B Offers</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarReports" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarReports">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:bill-list-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Reports </span>
                </a>
                <div class="collapse" id="sidebarReports">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="b2c_report.php">B2C Sell</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="b2b_report.php">B2B Sell</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="offline_report.php">Offline Sell</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="leaser.php">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:book-bookmark-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Leaser </span>
                </a>
            </li>
            
            
            <li class="menu-title mt-2">Users</li>
            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarUsers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUsers">
                    <span class="nav-icon"><iconify-icon icon="solar:user-speak-rounded-bold-duotone"></iconify-icon></span>
                    <span class="nav-text"> Profile </span>
                </a>
                <div class="collapse" id="sidebarUsers">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="profile_add.php">Create</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="profile_list.php">List</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="menu-title mt-2">Website Controls</li>
            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarBanner" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarBanner">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:chat-square-like-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> General Banner </span>
                </a>
                <div class="collapse" id="sidebarBanner">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="b2c_bnr.php">B2C Banner</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="b2b_bnr.php">B2B Banner</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="videos.php">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:clapperboard-play-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Guide Videos </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="certificates.php">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:bill-list-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Certificates </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarAbout" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAbout">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:chat-square-like-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> About Content </span>
                </a>
                <div class="collapse" id="sidebarAbout">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="abt_bnr.php">Banner</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="abt_headshot.php">About Us</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="team.php">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:users-group-two-rounded-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Our Team </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="reviews.php">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:chat-round-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Customer Reviews </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="contact.php">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:mailbox-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Contact Details </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="stores.php">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:shop-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Our Stores </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarPolicy" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPolicy">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:lock-keyhole-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Policies </span>
                </a>
                <div class="collapse" id="sidebarPolicy">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="t&c.php">Terms & Condition</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="return.php">Return & Refund</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="shipping.php">Shipping</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="privacy.php">Privacy</a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>