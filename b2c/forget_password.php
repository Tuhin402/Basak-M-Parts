<?php 
include 'session_config.php';
include 'headerlink.php'; 
?>

<body class="preload-wrapper">
    
    <!-- Scroll Top -->
    <button id="scroll-top">
        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_15741_24194)">
            <path d="M3 11.9175L12 2.91748L21 11.9175H16.5V20.1675C16.5 20.3664 16.421 20.5572 16.2803 20.6978C16.1397 20.8385 15.9489 20.9175 15.75 20.9175H8.25C8.05109 20.9175 7.86032 20.8385 7.71967 20.6978C7.57902 20.5572 7.5 20.3664 7.5 20.1675V11.9175H3Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <defs>
            <clipPath id="clip0_15741_24194">
            <rect width="24" height="24" fill="white" transform="translate(0 0.66748)"/>
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
       
        <!-- Header -->
        <?php include 'header.php'; ?>
        <!-- /Header -->

        <!-- page-title -->
        <?php 
        $imageQuery = "SELECT * FROM banner LIMIT 1";
        $bans = $obj->fetch($imageQuery);
        foreach ($bans as $ban){ 
        ?>
        <div class="page-title" style="background-image: url('../Admin/uploads/banner/<?= htmlspecialchars($ban['b2c_image']) ?>');">
            <div class="container">
                <h3 class="heading text-center">Forget Your Password</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li><a class="link" href="index.php">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li>Forget Your Password</li>
                </ul>
            </div>
        </div>
        <?php } ?>
        <!-- /page-title -->

        <!-- Reset -->
        <section class="flat-spacing">
            <div class="container">
                <div class="login-wrap">
                    <div class="left">
                        <div class="heading">
                            <h4 class="mb_8">Reset your password</h4>
                            <p>We will send you a OTP to your email to reset your password</p>
                        </div>
                        <form class="form-login form-has-password" id="forgetPasswordForm" novalidate>
                            <div class="wrap" id="wrap">
                                <fieldset>
                                    <input type="email" placeholder="Registered email address*" id="email" name="email" tabindex="2" aria-required="true" required>
                                </fieldset>
                            </div>
                            <div class="row g-3 mb_20 d-none" id="passwordForm">
                                <div class="col-lg-6 col-md-6">
                                    <fieldset class="position-relative password-item">
                                        <input class="input-password" type="password" placeholder="New Password*" id="password" name="password" tabindex="2" required>
                                        <span class="toggle-password unshow">
                                            <i class="icon-eye-hide-line"></i>
                                        </span>
                                    </fieldset>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <fieldset class="position-relative password-item">
                                        <input class="input-password" type="password" placeholder="Confirm Password*" id="cpassword" name="cpassword" tabindex="2" required>
                                        <span class="toggle-password unshow">
                                            <i class="icon-eye-hide-line"></i>
                                        </span>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="button-submit">
                                <button class="tf-btn btn-fill" type="button" id="sendOtpBtn">
                                    <span class="text text-button">Send OTP</span>
                                </button>
                                <button class="tf-btn btn-fill d-none" type="submit" id="changePassBtn">
                                    <span class="text text-button">Change Password</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="right">
                        <h4 class="mb_8">New Customer</h4>
                        <p class="text-secondary">Be part of our growing family of new customers! Join us today and unlock a world of exclusive benefits, offers, and personalized experiences.</p>
                        <a href="register.php" class="tf-btn btn-fill"><span class="text text-button">Register</span></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Reset -->

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
                <i class="bi bi-shield-lock-fill" style="margin-right: 8px;"></i> Verify & Submit
            </button>
        </div>


        <?php include 'footer.php'; ?>
        
    </div>
    <!-- /wrapper -->

    <!-- search -->
    <?php include 'search.php'; ?>
    <?php include 'general_search.php'; ?>
    <!-- /search -->
    
    <!-- Javascript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        const changePassBtn = document.getElementById('changePassBtn');
        const verifyOtpBtn = document.getElementById('verifyOtpBtn');
        const otpPopup = document.getElementById('otpPopup');
        const otpInput = document.getElementById('otpInput');
        const closeOtpModal = document.getElementById('closeOtpModal');
        const timerDisplay = document.getElementById('timer');
        const passwordForm = document.getElementById('passwordForm');
        const wrap = document.getElementById('wrap');
        
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
    
        // send otp
        sendOtpBtn.addEventListener('click', () => {
            let email = document.getElementById('email').value;
            if(email != ""){
                sendOtpBtn.disabled = true;
                sendOtpBtn.querySelector('.text-button').innerText = "Getting There....";
                
                fetch('send_otp.php', {
                    method: 'POST',
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
                        sendOtpBtn.disabled = false;
                        sendOtpBtn.querySelector('.text-button').innerText = "Send OTP";
                    }
                });
            } else {
                Toastify({
                    text: "Please enter your registered email address",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#dc3545",
                }).showToast();
            }
        });
    
        // modal close and open
        closeOtpModal.addEventListener('click', () => {
            hidePopup();
            sendOtpBtn.disabled = false;
            sendOtpBtn.querySelector('.text-button').innerText = "Send OTP";
        });
        window.addEventListener('click', (event) => {
            if (event.target == otpPopup) {
                hidePopup();
                sendOtpBtn.disabled = false;
                sendOtpBtn.querySelector('.text-button').innerText = "Send OTP";
            }
        });
    
        // Verify OTP button event 
        verifyOtpBtn.addEventListener('click', () => {
            let verifyOtp = otpInput.value;
            if (verifyOtp == generatedOtp) {
                Toastify({
                    text: "OTP Verified!",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#28a745"
                }).showToast();
                hidePopup();
                wrap.classList.add('d-none');
                passwordForm.classList.remove('d-none');
                changePassBtn.classList.remove('d-none');
                sendOtpBtn.classList.add('d-none');
            } else if (verifyOtp === "") {
                Toastify({
                    text: "Write a OTP first",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#dc3545",
                }).showToast();
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
    
        // Change Password form submission event
        $('#forgetPasswordForm').submit(function(e) {
          e.preventDefault();
          let password = document.querySelector('input[name="password"]').value;
          let cpassword = document.querySelector('input[name="cpassword"]').value;
          let email = document.getElementById('email').value;
          if(password === "" || cpassword === ""){
            Toastify({
              text: "Please fill in both password fields.",
              duration: 3000,
              gravity: "top",
              position: "center",
              backgroundColor: "#ff0000"
            }).showToast();
            return;
          }
          if(password !== cpassword){
            Toastify({
              text: "Passwords do not match.",
              duration: 3000,
              gravity: "top",
              position: "center",
              backgroundColor: "#ff0000"
            }).showToast();
            return;
          }
          $.ajax({
            url: 'update_password.php',
            type: 'POST',
            data: { email: email, password: password, cpassword: cpassword },
            dataType: 'json',
            success: function(response){
              if(response.status === "success"){
                Toastify({
                  text: "Password updated successfully!",
                  duration: 3000,
                  gravity: "top",
                  position: "center",
                  backgroundColor: "#28a745"
                }).showToast();
                setTimeout(() => {
                   window.location.href = 'login.php';
                }, 1200);
              } else {
                Toastify({
                  text: response.message || "Failed to update password.",
                  duration: 3000,
                  gravity: "top",
                  position: "center",
                  backgroundColor: "#ff0000"
                }).showToast();
              }
            },
            error: function(){
              Toastify({
                text: "Something went wrong while updating password.",
                duration: 3000,
                gravity: "top",
                position: "center",
                backgroundColor: "#ff0000"
              }).showToast();
            }
          });
        });
      </script>
</body>
</html>