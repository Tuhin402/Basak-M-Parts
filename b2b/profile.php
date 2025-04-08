<?php 
include 'session_config.php';
include 'headerlink.php'; 
?>

<body class="preload-wrapper">
    
    <!-- Scroll Top -->
    <button id="scroll-top">
        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_15741_24194)">
            <path d="M3 11.9175L12 2.91748L21 11.9175H16.5V20.1675C16.5 20.3664 16.421 20.5572 16.2803 20.6978C16.1397 20.8385 15.9489 20.9175 15.75 20.9175H8.25C8.05109 20.9175 7.86032 20.8385 7.71967 20.6978C7.57902 20.5572 7.5 20.3664 7.5 20.1675V11.9175H3Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </g>
            <defs>
            <clipPath id="clip0_15741_24194">
            <rect width="24" height="24" fill="white" transform="translate(0 0.66748)"></rect>
            </clipPath>
            </defs>
        </svg> 
    </button>

    <!-- preload -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->

    <!-- #wrapper -->
    <div id="wrapper">

        <?php include 'header.php'; ?>

        <!-- page-title -->
        <?php 
        $imageQuery = "SELECT * FROM banner_two LIMIT 1";
        $bans = $obj->fetch($imageQuery);
        foreach ($bans as $ban){ 
        ?>
        <div class="page-title" style="background-image: url('../Admin/uploads/banner/<?= htmlspecialchars($ban['b2b_image']) ?>');">
            <div class="container">
                <h3 class="heading text-center">My Account</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li><a class="link" href="index.php">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li>Account</li>
                </ul>
            </div>
        </div>
        <?php } ?>
        <!-- /page-title -->

        <!-- profile -->
        <?php 
        $sql = "SELECT * FROM reg_btob WHERE id = $userId";
        $result = $obj->fetch($sql);
        $acc = $result[0];
        $name = $acc['name'];
        $email = $acc['email'];
        $phone = $acc['phone'];
        $address_one = $acc['address_one'];
        $address_two = $acc['address_two'];
        $state = $acc['state'];
        $district = $acc['district'];
        $landmark = $acc['landmark'];
        $pin = $acc['pin'];
        $business = $acc['business_name'];
        $gst = $acc['gst'];
        $shop_image = $acc['shop_image'];
        ?>
        <section class="flat-spacing">
            <div class="container">
                <div class="my-account-wrap">
                    <div class="wrap-sidebar-account">
                        <div class="sidebar-account">
                            <div class="account-avatar">
                                <div class="profile-user-circle mb_20" style="width: 150px; height: 150px; background-color: #00529F; color: #fff; border: 5px solid #2C97FB; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 72px; font-weight: bold; text-transform: uppercase;">
                                    <?php echo strtoupper(substr($name, 0, 1)); ?>
                                </div>
                                <h6 class="mb_4"><?= $name ?></h6>
                                <div class="body text-1"><?= $email ?></div>
                            </div>
                            <ul class="my-account-nav">
                                <a href="javascript:void(0);" class="my-account-nav-item active">Account Details</a>
                                <a href="my_orders.php" class="my-account-nav-item">My Orders</a>
                                <a href="logout_b2b.php" class="my-account-nav-item">Logout</a>
                            </ul>
                        </div>
                    </div>
                    <div class="my-account-content">
                        <div classs="account-details">
                            <form id="profileUpdateForm" novalidate>
                                <div class="account-info">
                                    <h5 class="title mb_20">Information</h5>
                                    <input type="hidden" id-"user_id" name="user_id" value="<?= $userId ?>">
                                    <div class="cols mb_20">
                                        <fieldset>
                                            <input type="text" id="name" name="name" value="<?= $name ?>" placeholder="Full Name">
                                        </fieldset>
                                    </div>
                                    <div class="cols mb_20">
                                        <fieldset>
                                            <input type="tel" id="phone" name="phone" value="<?= $phone ?>" placeholder="Phone Number">
                                        </fieldset>
                                        <fieldset>
                                            <input type="email" id="email" name="email" value="<?= $email ?>" placeholder="Email Id">
                                        </fieldset>
                                    </div>
                                    <div class="cols mb_20">
                                        <fieldset>
                                            <input type="text" id="addressOne" name="addressOne" value="<?= $address_one ?>" placeholder="Address Line 1">
                                        </fieldset>
                                    </div>
                                    <div class="cols mb_20">
                                        <fieldset>
                                            <input type="text" id="addressTwo" name="addressTwo" value="<?= $address_two ?>" placeholder="Address Line 2 (optional)">
                                        </fieldset>
                                    </div>
                                    <div class="cols mb_20">
                                        <fieldset>
                                            <input type="text" id="state" name="state" value="<?= $state ?>" placeholder="State">
                                        </fieldset>
                                        <fieldset>
                                            <input type="text" id="district" name="district" value="<?= $district ?>" placeholder="District">
                                        </fieldset>
                                    </div>
                                    <div class="cols mb_20">
                                        <fieldset>
                                            <input type="text" id="landmark" name="landmark" value="<?= $landmark ?>" placeholder="Landmark">
                                        </fieldset>
                                        <fieldset>
                                            <input type="number" id="pin" name="pin" value="<?= $pin ?>" placeholder="Area PIN Code">
                                        </fieldset>
                                    </div>
                                    <div class="cols mb_20">
                                        <fieldset>
                                            <input type="text" id="business" name="business" value="<?= $business ?>" placeholder="Business Name">
                                        </fieldset>
                                        <fieldset>
                                            <input type="text" id="gst" name="gst" value="<?= $gst ?>" placeholder="GST Number">
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="button-submit">
                                    <button class="tf-btn btn-reset" type="submit">Update Account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /profile -->
        
        <!-- Footer -->
        <?php include 'footer.php'; ?>
        <!-- /Footer -->
        
    </div>
    <!-- /wrapper -->

    <!-- search -->
    <?php include 'search.php'; ?>
    <?php include 'general_search.php'; ?>
    <!-- /search -->
    
    <!-- Javascript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="js/lazysize.min.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/count-down.js"></script>
    <script type="text/javascript" src="js/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="js/carousel.js"></script>
    <script type="text/javascript" src="js/multiple-modal.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

    <script>
        // update profile ajax
        $(document).ready(function() {
            $('#profileUpdateForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "update_profile.php", 
                    data: formData,
                    success: function(response) {
                        try {
                            var res = JSON.parse(response);
                            if(res.status === "success"){
                                Toastify({
                                    text: res.message,
                                    backgroundColor: "#28a745",
                                    gravity: "top",
                                    position: "center",
                                    duration: 3000
                                }).showToast();
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1200);
                            } else {
                                Toastify({
                                    text: res.message,
                                    backgroundColor: "#dc3545",
                                    gravity: "top",
                                    position: "center",
                                    duration: 3000
                                }).showToast();
                            }
                        } catch(err) {
                            Toastify({
                                text: "Unexpected response from server.",
                                backgroundColor: "#dc3545",
                                gravity: "top",
                                position: "center",
                                duration: 3000
                            }).showToast();
                        }
                    },
                    error: function(xhr, status, error) {
                        Toastify({
                            text: "Something went wrong! Please try again.",
                            backgroundColor: "#dc3545",
                            gravity: "top",
                            position: "center",
                            duration: 3000
                        }).showToast();
                    }
                });
            });
        });
    </script>
    
</body>
</html>