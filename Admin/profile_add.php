<?php
include 'session_config.php';
if(empty($_SESSION['user_email'])){
    echo '<script>window.location.href="login.php"</script>';
}
include "config.php";
include 'headerlink.php'; 
?>

<body>

    <div class="wrapper">
        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>

        <div class="page-content">
            <div class="container-xxl">
                <!-- Page Header -->
                <div class="page-header my-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Create User Account</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item">Profile</li>
                                <li class="breadcrumb-item active">Create User</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header"><h3 class="card-title">Add User</h3></div>
                            <div class="card-body">
                                <!-- form start 
                                ===================================== -->
                                <form id="userAddForm" novalidate>
                                    <h4 class="text-center p-3 bg-light rounded">User Details</h4>
                                    <div class="row mt-4">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">User Name <span style="color:red;">*</span></label>
                                                <input type="text" id="name" name="name" class="form-control" placeholder="User Name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="type" class="form-label">User Type <span style="color:red;">*</span></label>
                                                <select class="form-control" id="type" name="type" required>
                                                    <option selected disabled>Select User Type</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="user">User</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">User Phone No. </label>
                                                <input type="tel" id="phone" name="phone" class="form-control" placeholder="User Phone No.">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">User Address </label>
                                                <input type="tel" id="address" name="address" class="form-control" placeholder="User Address">
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="text-center p-3 bg-light rounded mt-4">Login Credentials</h4>
                                    <div class="row mt-4">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">User Email <span style="color:red;">*</span></label>
                                                <input type="email" id="email" name="email" class="form-control" placeholder="User Email" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Create Password <span style="color:red;">*</span></label>
                                                <input type="password" id="password" name="password" class="form-control" placeholder="Create Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-3 my-3 rounded">
                                        <div class="row justify-content-end g-2">
                                            <div class="col-lg-2">
                                                <button type="submit" class="btn btn-soft-primary w-100">Create User</button>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="reset" class="btn btn-outline-secondary w-100">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'footer.php'; ?>
        </div>
    </div>


<!-- All necessary scripts are here  -->
<script>
    // add ajax 
    $(document).ready(function () {
        $("#userAddForm").on("submit", function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "add_profile.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    let res = JSON.parse(response);
                    if (res.status === "success") {
                        Toastify({
                            text: res.message,
                            duration: 2000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "green",
                        }).showToast();
                        $("#userAddForm")[0].reset();
                    } else {
                        Toastify({
                            text: res.message,
                            duration: 2000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "red",
                        }).showToast();
                    }
                },
                error: function () {
                    Toastify({
                        text: "Something went wrong!",
                        duration: 2000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "red",
                    }).showToast();
                },
            });
        });
    });
</script>
<?php include 'footerlink.php'; ?>