<?php 
include 'session_config.php';
include 'headerlink.php'; 
?>

<body class="preload-wrapper">

    <!-- Scroll Top -->
    <button id="scroll-top">
        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_15741_24194)">
                <path
                    d="M3 11.9175L12 2.91748L21 11.9175H16.5V20.1675C16.5 20.3664 16.421 20.5572 16.2803 20.6978C16.1397 20.8385 15.9489 20.9175 15.75 20.9175H8.25C8.05109 20.9175 7.86032 20.8385 7.71967 20.6978C7.57902 20.5572 7.5 20.3664 7.5 20.1675V11.9175H3Z"
                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
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
                <h3 class="heading text-center">Contact Us</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li><a class="link" href="index.php">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
        <?php } ?>
        <!-- /page-title -->

        <!-- Get In Touch -->
        <section class="flat-spacing">
            <div class="container">
                <div class="contact-us-content">
                    <div class="left">
                        <h4>Get In Touch</h4>
                        <p class="text-secondary-2">Use the form below to get in touch with the sales team</p>
                        <form id="contactform" class="form-leave-comment" novalidate>
                            <div class="wrap">
                                <div class="cols">
                                    <fieldset>
                                        <input type="text" placeholder="Your Name*" name="name" id="name" tabindex="2" value="" aria-required="true" required="">
                                    </fieldset>
                                    <fieldset>
                                        <input type="email" placeholder="Your Email*" name="email" id="email" tabindex="2" value="" aria-required="true" required="">
                                    </fieldset>
                                </div>
                                <div class="cols">
                                    <fieldset>
                                        <input type="tel" placeholder="Your Phone No.*" name="mobile" id="mobile" tabindex="2" value="" aria-required="true" required="">
                                    </fieldset>
                                    <fieldset>
                                        <input type="text" placeholder="Your Address*" name="address" id="address" tabindex="2" value="" aria-required="true" required="">
                                    </fieldset>
                                </div>
                                <fieldset>
                                    <textarea name="message" id="message" rows="4" placeholder="Your Message*" tabindex="2" aria-required="true" required=""></textarea>
                                </fieldset>
                            </div>
                            <div class="button-submit send-wrap">
                                <button class="tf-btn btn-fill" type="submit">
                                    <span class="text text-button">Send message</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <?php 
                    $infoQuery = "SELECT * FROM contact";
                    $infos = $obj->fetch($infoQuery); 
                    ?>
                    <div class="right">
                        <h4>Information</h4>
                        <div class="mb_20">
                            <div class="text-title mb_8">Phone:</div>
                            <?php foreach ($infos as $info) { ?>
                            <p class="text-secondary"><a class="text-secondary" href="tel:<?= htmlspecialchars($info['phone']) ?>"><?= htmlspecialchars($info['phone']) ?></a></p>
                            <?php } ?>
                        </div>
                        <div class="mb_20">
                            <div class="text-title mb_8">Helpline:</div>
                            <?php foreach ($infos as $info) { ?>
                            <p class="text-secondary"><a class="text-secondary" href="tel:<?= htmlspecialchars($info['helpline']) ?>"><?= htmlspecialchars($info['helpline']) ?></a></p>
                            <?php } ?>
                        </div>
                        <div class="mb_20">
                            <div class="text-title mb_8">Email:</div>
                            <?php foreach ($infos as $info) { ?>
                            <p class="text-secondary"><a class="text-secondary" href="mailto:<?= htmlspecialchars($info['email']) ?>"><?= htmlspecialchars($info['email']) ?></a></p>
                            <?php } ?>
                        </div>
                        <div class="mb_20">
                            <div class="text-title mb_8">Address:</div>
                            <?php foreach ($infos as $info) { ?>
                            <p class="text-secondary"><a class="text-secondary" href="<?= htmlspecialchars($info['map']) ?>" target="_blank"><?= htmlspecialchars($info['address']) ?></a></p>
                            <?php } ?>
                        </div>
                        <div>
                            <div class="text-title mb_8">Open Time:</div>
                            <?php foreach ($infos as $info) { ?>
                            <p class="mb_4 open-time"><span class="text-secondary" style="width:max-content;"><?= htmlspecialchars($info['open_date']) ?></span> <?= htmlspecialchars($info['open_time']) ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Get In Touch -->

        <!-- location -->
        <div class="wrap-map">
            <?php foreach ($infos as $info) { 
                if (strpos($info['map'], 'embed') !== false) { ?>
                    <iframe src="' . htmlspecialchars($info['map']) . '" width="100%" height="400" style="border:0;" loading="lazy"></iframe>
                <?php } else { ?>
                    <div class="alert alert-warning d-flex align-items-center justify-content-center gap-2 p-3 text-danger rounded-3 shadow-sm" role="alert">
                      <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
                      <div>
                        <strong>Heads up!</strong> Please update your map with an <u>embeddable</u> URL 🙏
                      </div>
                    </div>
            <?php } } ?>   
        </div>
        <!-- /location -->

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
    <script type="text/javascript" src="js/jquery-validate.js"></script>
    <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="js/lazysize.min.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/count-down.js"></script>
    <script type="text/javascript" src="js/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="js/carousel.js"></script>
    <script type="text/javascript" src="js/multiple-modal.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuSiPhoDaOJ7aqtJVtQhYhLzwwJ7rQlmA"></script>
    <script type="text/javascript" src="js/map-contact.js"></script>
    <script type="text/javascript" src="js/marker.js"></script>
    <script type="text/javascript" src="js/infobox.min.js"></script>

    <!-- contact form submission ajax -->
    <script>
        $(document).ready(function (e) {
            $("#contactform").on("submit", function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "send_email.php",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        Toastify({
                            text: "Sending your message...",
                            duration: 700,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#007bff",
                        }).showToast();
                    },
                    success: function (data) {
                        if (data == 200) {
                            Toastify({
                                text: "Message sent successfully! We'll get back to you soon.",
                                duration: 3000,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#28a745",
                            }).showToast();
                            setTimeout(location.reload.bind(location), 1500);
                        } else {
                            Toastify({
                                text: data, 
                                duration: 3000,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#dc3545",
                            }).showToast();
                        }
                    },
                    error: function () {
                        Toastify({
                            text: "An error occurred. Please try again later.",
                            duration: 3000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#dc3545",
                        }).showToast();
                    }
                });
            });
        });
    </script>
</body>
</html>