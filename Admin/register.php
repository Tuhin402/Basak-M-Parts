<?php
include 'session_config.php';
include 'headerlink.php'; 
?>

<body class="h-100">
    <div class="d-flex flex-column h-100 p-3">
         <div class="d-flex flex-column flex-grow-1">
              <div class="row h-100">
                   <div class="col-xxl-6">
                        <div class="row justify-content-center h-100">
                             <div class="col-lg-6 py-lg-5">
                                  <div class="d-flex flex-column h-100 justify-content-center">
                                       <div class="auth-logo mb-4">
                                            <a href="index.php" class="logo-dark"><img src="images/logo-white.png" height="140" alt="logo dark"></a>
                                            <a href="index.php" class="logo-light"><img src="images/logo-white.png" height="140" alt="logo light"></a>
                                       </div>
                                       <h2 class="fw-bold fs-24">Sign Up</h2>
                                       <p class="text-muted mt-1 mb-4">New to our platform? Sign up now! It only takes a minute</p>
                                       <div class="mb-5">
                                            <form id="register" class="authentication-form">
                                                 <div class="mb-3">
                                                      <label class="form-label" for="name">Username</label>
                                                      <input type="text" id="name" name="name" class="form-control" placeholder="Make a username">
                                                 </div>
                                                 <div class="mb-3">
                                                      <label class="form-label" for="email">Email</label>
                                                      <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email">
                                                 </div>
                                                 <div class="mb-3">                                                      
                                                      <label class="form-label" for="password">Password</label>
                                                      <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                                 </div>
                                                 <div class="mb-1 text-center d-grid">
                                                      <button class="btn btn-soft-primary" type="submit">Sign Up</button>
                                                 </div>
                                            </form>
                                       </div>
                                       <p class="mt-auto text-danger text-center">I already have an account  <a href="login.php" class="text-dark fw-bold ms-1">Sign In</a></p>
                                  </div>
                             </div>
                        </div>
                   </div>

                   <div class="col-xxl-6 d-none d-xxl-flex">
                        <div class="card h-100 mb-0 overflow-hidden">
                             <div class="d-flex flex-column h-100">
                                  <img src="images/login2.png" alt="sample-image" class="w-100 h-100">
                             </div>
                        </div>
                   </div>
              </div>
         </div>
    </div>

<script>
     $(document).ready(function () {
          $("#register").submit(function (e) {
               e.preventDefault();

               var name = $("#name").val();
               var email = $("#email").val();
               var password = $("#password").val();

               $.ajax({
                    url: "registration.php",
                    type: "POST",
                    data: { name: name, email: email, password: password },
                    dataType: "json",
                    success: function (response) {
                         if (response.status === "success") {
                         Toastify({
                              text: "Account created successfully! Redirecting to login page...",
                              duration: 2000,
                              gravity: "top",
                              position: "center",
                              backgroundColor: "green",
                         }).showToast();

                         setTimeout(function () {
                              window.location.href = "login.php";
                         }, 2000);
                         } else {
                         Toastify({
                              text: response.message,
                              duration: 3000,
                              gravity: "top",
                              position: "center",
                              backgroundColor: "red",
                         }).showToast();
                         }
                    },
                    error: function () {
                         Toastify({
                         text: "Something went wrong!",
                         duration: 3000,
                         gravity: "top",
                         position: "center",
                         backgroundColor: "red",
                         }).showToast();
                    }
               });
          });
     });
</script>
<?php include 'footerlink.php'; ?>