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
                <h3 class="heading text-center">B2B Registration</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li><a class="link" href="index.php">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li>B2B Registration</li>
                </ul>
            </div>
        </div>
        <?php } ?>
        <!-- /page-title -->

        <!-- registration -->
        <section class="flat-spacing">
            <div class="container">
                <div class="login-wrap">
                    <div class="left">
                        <div class="heading">
                            <h4>Business to Business Registration</h4>
                        </div>
                        <form id="regBtoB" class="form-login form-has-password">
                            <div class="wrap">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <fieldset class="">
                                            <input class="" type="text" placeholder="Full Name*" name="name" tabindex="2" value="" required>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="">
                                            <input class="" type="tel" placeholder="Phone No.*" name="phone" tabindex="2" value="" required>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <fieldset class="">
                                            <input class="" id="email" type="email" placeholder="Email Address*" name="email" tabindex="2" value="" required>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <fieldset class="">
                                            <input class="" type="text" placeholder="Address Line 1*" name="addressOne" tabindex="2" value="" required>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="">
                                            <input class="" type="text" placeholder="Address Line 2" name="addressTwo" tabindex="2" value="">
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <fieldset class="">
                                            <input class="" type="text" placeholder="State*" name="state" tabindex="2" value="" required>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="">
                                            <input class="" type="text" placeholder="District*" name="district" tabindex="2" value="" required>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <fieldset class="">
                                            <input class="" type="text" placeholder="Landmark*" name="landmark" tabindex="2" value="" required>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="">
                                            <input class="" type="number" placeholder="Area PIN Code*" name="pin" tabindex="2" value="" required>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <fieldset class="position-relative password-item">
                                            <input class="input-password" type="password" placeholder="Password*" name="password" tabindex="2" value="" required>
                                            <span class="toggle-password unshow">
                                                <i class="icon-eye-hide-line"></i>
                                            </span>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="position-relative password-item">
                                            <input class="input-password" type="password" placeholder="Confirm Password*" name="cpassword" tabindex="2" value="" required>
                                            <span class="toggle-password unshow">
                                                <i class="icon-eye-hide-line"></i>
                                            </span>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <fieldset class="">
                                            <input class="" type="text" placeholder="Business Name*" name="business" tabindex="2" value="" required>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="">
                                            <input class="" type="text" placeholder="GST No.*" name="gst" tabindex="2" value="" required>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <fieldset class=""> 
                                            <label class="text-secondary-2">Upload Store Image*</label>
                                            <input class="" type="file" id="imageUpload" name="image" tabindex="2" value="" required>
                                        </fieldset>
                                        <div class="alert alert-info text-center mt-2 rounded" role="alert">
                                          <i class="bi bi-info-circle-fill me-2"></i>Please make sure to upload a image of your <strong>B2B store</strong> to ensure optimal visibility and branding.
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="otp" id="hiddenOtp">
                                <div class="d-flex align-items-center">
                                    <div class="tf-cart-checkbox">
                                        <label class="text-secondary-2" for="login-form_agree">
                                            By submitting this form, You are agreeing to our
                                            <a href="terms.php" title="Terms of Service" style="margin-left: 5px;"> Terms & Condition</a>
                                        </label>
                                    </div>
                                </div>
                                <a href="../b2c/register.php" class="font-2 text-button forget-password link" style="color: #EB5831;">Business to Customer Registration -></a>
                            </div>
                            <div class="button-submit">
                                <button class="tf-btn btn-fill" type="button" id="sendOtpBtn">
                                    <span class="text text-button">Send OTP</span>
                                </button>
                                <button class="tf-btn btn-fill d-none" type="submit" id="registerBtn">
                                    <span class="text text-button">Register</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="right">
                        <h4 class="mb_8">Already have an account?</h4>
                        <p class="text-secondary">Welcome back. Sign in to access your personalized experience, saved
                            preferences, and more. We're thrilled to have you with us again!</p>
                        <a href="login_B_to_B.php" class="tf-btn btn-fill"><span class="text text-button">Login</span></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /login -->

        <!-- otp form  -->
        <div id="otpOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1040;"></div>
        <div class="otp-popup" id="otpPopup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 30px; border-radius: 12px; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3); background-color: #181818; color: #F9F9F9; z-index: 1050; width: 400px; max-width: 90%; text-align: center;">
            <span class="close" id="closeOtpModal" style="position: absolute; top: 10px; right: 15px; cursor: pointer; font-size: 1.5rem;">&times;</span>
            <h5 class="text-center mb-3" style="color: #F9F9F9; font-weight: 600;">
                <i class="bi bi-envelope-check-fill" style="font-size: 1.5rem; color: #612A34; margin-right: 8px;"></i> 
                OTP Verification
            </h5>
            <p style="color: #C0C0C0; font-size: 0.9rem; margin-bottom: 20px;">
                We have sent an OTP to your email address, if you couldn't find one then check your spam mails. Please enter it below to verify.
            </p>
            <div id="timer" style="font-size: 1.2rem; margin-bottom: 20px; font-weight: 650;">05:00</div>
            <div class="form-group">
                <input type="text" id="otpInput" class="form-control text-center mb-4" placeholder="Enter OTP" required style="background: #2E2E2E; border: 1px solid #612A34; color: #F9F9F9; font-size: 1.2rem;">
            </div>
            <button class="btn w-100" id="verifyOtpBtn" style="background: #612A34; border: none; color: #F9F9F9; font-weight: 600; padding: 10px; font-size: 1rem;">
                <i class="bi bi-shield-lock-fill" style="margin-right: 8px;"></i> Verify & Register
            </button>
        </div>

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
        const sendOtpBtn = document.getElementById('sendOtpBtn');
        const otpPopup = document.getElementById('otpPopup');
        const otpInput = document.getElementById('otpInput');
        const verifyOtpBtn = document.getElementById('verifyOtpBtn');
        const hiddenOtp = document.getElementById('hiddenOtp');
        const registerBtn = document.getElementById('registerBtn');
        const closeOtpModal = document.getElementById('closeOtpModal');
        const timerDisplay = document.getElementById('timer');
    
        let generatedOtp;
        let timerInterval;
        let timeRemaining = 300;
        
        // 5 min timer
        function startTimer() {
            clearInterval(timerInterval);
            timeRemaining = 300;
            updateTimerDisplay();
            timerInterval = setInterval(() => {
                timeRemaining--;
                updateTimerDisplay();
                if (timeRemaining <= 0) {
                    clearInterval(timerInterval);
                    hidePopup();
                    Toastify({
                        text: "OTP expired. Please try again.",
                        duration: 3000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#dc3545",
                    }).showToast();
                    sendOtpBtn.disabled = false;
                    sendOtpBtn.querySelector('.text-button').innerText = "Send OTP";
                }
            }, 1000);
        }
        function updateTimerDisplay() {
            let minutes = Math.floor(timeRemaining / 60);
            let seconds = timeRemaining % 60;
            timerDisplay.innerText = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }
        
        // popup hide/show
        function showPopup() {
            otpPopup.style.display = 'block';
            startTimer();
        }
        function hidePopup() {
            otpPopup.style.display = 'none';
            clearInterval(timerInterval);
        }
        
        // send otp ajax
        sendOtpBtn.addEventListener('click', () => {
            const email = document.getElementById('email').value;
            const name = document.querySelector('input[name="name"]').value;
            const phone = document.querySelector('input[name="phone"]').value;
            const address = document.querySelector('input[name="addressOne"]').value;
            const state = document.querySelector('input[name="state"]').value;
            const district = document.querySelector('input[name="district"]').value;
            const landmark = document.querySelector('input[name="landmark"]').value;
            const pin = document.querySelector('input[name="pin"]').value;
            const business = document.querySelector('input[name="business"]').value;
            const gst = document.querySelector('input[name="gst"]').value;
        
            if (!name || !phone || !email || !address || !state || !district || !landmark || !pin || !business || !gst) {
                Toastify({
                    text: "Please fill all mandatory form fields",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#dc3545",
                }).showToast();
            } else if (!email) {
                Toastify({
                    text: "Please enter email",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#dc3545",
                }).showToast();
            } else {
                sendOtpBtn.disabled = true;
                sendOtpBtn.querySelector('.text-button').innerText = "Getting There....";
                
                fetch('verify_otp_btob.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email: email })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        generatedOtp = data.otp; 
                        Toastify({
                            text: "OTP sent to your email!",
                            duration: 3000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#28a745",
                        }).showToast();
                        showPopup();
                    } else {
                        Toastify({
                            text: data.message || "Error sending OTP",
                            duration: 3000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#dc3545",
                        }).showToast();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Toastify({
                        text: "An unexpected error occurred!",
                        duration: 3000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#dc3545",
                    }).showToast();
                });
            }
        });
    
        verifyOtpBtn.addEventListener('click', () => {
            const enteredOtp = otpInput.value;
    
            if (enteredOtp == generatedOtp) {
                const formData = new FormData();
            
                formData.append('name', document.querySelector('input[name="name"]').value);
                formData.append('email', document.querySelector('input[name="email"]').value);
                formData.append('phone', document.querySelector('input[name="phone"]').value);
                formData.append('addressOne', document.querySelector('input[name="addressOne"]').value);
                formData.append('addressTwo', document.querySelector('input[name="addressTwo"]').value);
                formData.append('state', document.querySelector('input[name="state"]').value);
                formData.append('district', document.querySelector('input[name="district"]').value);
                formData.append('landmark', document.querySelector('input[name="landmark"]').value);
                formData.append('pin', document.querySelector('input[name="pin"]').value);
                formData.append('password', document.querySelector('input[name="password"]').value);
                formData.append('cpassword', document.querySelector('input[name="cpassword"]').value);
                formData.append('business', document.querySelector('input[name="business"]').value);
                formData.append('gst', document.querySelector('input[name="gst"]').value);
                const imageInput = document.querySelector('input[name="image"]');
                
                if (imageInput.files.length > 0) {
                    formData.append('image', imageInput.files[0]);
                }
            
                fetch('register_btob.php', {
                    method: 'POST',
                    body: formData, 
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Toastify({
                                text: "Account created successfully!",
                                duration: 3000,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#28a745",
                            }).showToast();
            
                            hidePopup();
            
                            setTimeout(() => {
                                window.location.href = "login_B_to_B.php";
                            }, 1200);
                        } else {
                            Toastify({
                                text: data.message || "Error creating account",
                                duration: 3000,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#dc3545",
                            }).showToast();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Toastify({
                            text: "An unexpected error occurred!",
                            duration: 3000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#dc3545",
                        }).showToast();
                    });
            } else {
                Toastify({
                    text: "OTP does not match!",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#dc3545",
                }).showToast();
            }
        });
    </script>

</body>
</html>