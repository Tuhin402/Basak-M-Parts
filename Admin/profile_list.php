<?php
include 'session_config.php';
if(empty($_SESSION['user_email'])){
    echo '<script>window.location.href="login.php"</script>';
}
include "config.php";
include 'headerlink.php'; 
?>

<body>

    <!-- START Wrapper -->
    <div class="wrapper">
        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>

        <div class="page-content">
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header my-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">User Account List</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item">Profile</li>
                                <li class="breadcrumb-item active">User List</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header"><h4 class="card-title flex-grow-1">User Account List</h4></div>
                            <div>
                                <!-- table start  -->
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0 table-hover table-centered">
                                        <thead class="bg-light-subtle">
                                            <tr>
                                                <th>Created at</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone No.</th>
                                                <th>Address</th>
                                                <th>Type</th>
                                                <th>Password</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $users = $obj->fetch("SELECT * FROM profile ORDER BY date DESC");
                                                foreach ($users as $val) { 
                                                    $password = $val['password'];
                                                    $decodedPassword = base64_decode($password);

                                                    $typeClass = "";
                                                    if ($val['type'] == "user") {
                                                        $typeClass = "border-warning text-warning";
                                                    } elseif ($val['type'] == "admin") {
                                                        $typeClass = "border-success text-success";
                                                    }
                                            ?>
                                            <tr>
                                                <td><?= date("d M, Y", strtotime($val['date'])); ?></td>
                                                <td><?= $val['name'] ?></td>
                                                <td><a href="mailto:<?= $val['email'] ?>"><?= $val['email'] ?></a></td>
                                                <td><a href="tel:<?= $val['phone'] ?>"><?= $val['phone'] ?></a></td>
                                                <td><p class="text-muted"><?= $val['address'] ?></p></td>
                                                <td><span class="badge border <?= $typeClass; ?> px-2 py-1 fs-13"><?= $val['type'] ?></span></td>
                                                <td><p class="text-muted"><?= $decodedPassword ?></p></td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <button class="btn btn-soft-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $val['id']; ?>">
                                                            <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                                                        </button>
                                                        <button class="btn btn-soft-danger btn-sm delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $val['id']; ?>">
                                                            <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- edit modal start  -->
                                            <div class="modal fade" id="editModal<?php echo $val['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $val['id']; ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="editModalLabel<?php echo $val['id']; ?>">Edit User Account</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="editUserForm" enctype="multipart/form-data">
                                                                <h4 class="text-center p-3 bg-light rounded">User Details</h4>
                                                                <input type="hidden" name="user_id" value="<?php echo $val['id']; ?>">
                                                                <div class="row mt-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="name" class="form-label">User Name </label>
                                                                            <input type="text" id="name" name="name" class="form-control" value="<?php echo $val['name']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="type" class="form-label">User Type </label>
                                                                            <select class="form-control" id="type" name="type">
                                                                                <option selected disabled><?php echo $val['type']; ?></option>
                                                                                <option value="admin">Admin</option>
                                                                                <option value="user">User</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="phone" class="form-label">User Phone No. </label>
                                                                            <input type="tel" id="phone" name="phone" class="form-control" value="<?php echo $val['phone']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="address" class="form-label">User Address </label>
                                                                            <input type="tel" id="address" name="address" class="form-control" value="<?php echo $val['address']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <h4 class="text-center p-3 bg-light rounded mt-4">Login Credentials</h4>
                                                                <div class="row mt-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="email" class="form-label">User Email </label>
                                                                            <input type="email" id="email" name="email" class="form-control" value="<?php echo $val['email']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="password" class="form-label">Update Password </label>
                                                                            <input type="password" id="password" name="password" class="form-control" value="<?php echo $decodedPassword; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button type="submit" class="btn btn-soft-primary mt-3 float-end p-2"><i class="bx bx-refresh me-1"></i>Update</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- edit modal end -->

                                            <!-- delete modal start  -->
                                            <div class="modal fade" id="deleteModal<?php echo $val['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $val['id']; ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title" id="deleteModalLabel<?php echo $val['id']; ?>">Delete User Account</h3>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <p>Are you sure you want to delete this account?</p>
                                                            <p><strong><?php echo $val['name']; ?></strong></p>
                                                            <form class="deleteUserForm">
                                                                <input type="hidden" name="user_id" value="<?php echo $val['id']; ?>">
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button type="button" class="btn btn-soft-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-soft-danger confirm-delete" data-id="<?php echo $val['id']; ?>"><i class="bx bx-trash me-1"></i>Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- delete modal end  -->
                                            
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- table end -->
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
    // edit user ajax 
    $(document).ready(function () {
        $(".editUserForm").on("submit", function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "edit_user.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    let res = JSON.parse(response);
                    if (res.status === "success") {
                        Toastify({
                            text: "User Account updated successfully!",
                            duration: 3000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#28a745",
                        }).showToast();
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000);
                    } else {
                        Toastify({
                            text: res.message || "Something went wrong!",
                            duration: 3000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#dc3545",
                        }).showToast();
                    }
                },
                error: function () {
                    Toastify({
                        text: "Server error! Try again later.",
                        duration: 3000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#dc3545",
                    }).showToast();
                }
            });
        });
    });

    // delete user ajax 
    $(document).ready(function () {
        $(".confirm-delete").click(function () {
            var userId = $(this).data("id");
            $.ajax({
                url: "delete_user.php",
                type: "POST",
                data: { id: userId },
                beforeSend: function () {
                    Toastify({
                        text: "Deleting User Account...",
                        duration: 500,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#FFA500", 
                    }).showToast();
                },
                success: function (response) {
                    if (response.trim() === "success") {
                        $("#deleteModal" + userId).modal("hide");
                        Toastify({
                            text: "User Account deleted successfully!",
                            duration: 2000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#28a745", 
                        }).showToast();
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        Toastify({
                            text: "Error deleting user account. Try again.",
                            duration: 2000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#dc3545",
                        }).showToast();
                    }
                }
            });
        });
    });
</script>
<?php include 'footerlink.php'; ?>