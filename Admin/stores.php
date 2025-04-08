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

            <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header my-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Our Stores</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Our Stores</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="card-title">Our Stores</h4>
                                    <a href="" class="btn btn-sm btn-soft-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                                        <i class="bx bx-plus me-1"></i>Add Store
                                    </a>
                                </div>
                            </div>
                            <!--Table start
                            ======================-->
                            <div class="table-responsive table-centered">
                                <table class="table mb-0 table-hover">
                                    <thead class="bg-light bg-opacity-50">
                                        <tr>
                                            <th><a href="javascript:void(0);">#</a></th>
                                            <th><a href="javascript:void(0);">Location Name</a></th>
                                            <th><a href="javascript:void(0);">Phone No.</a></th>
                                            <th><a href="javascript:void(0);">Email</a></th>
                                            <th><a href="javascript:void(0);">Address</a></th>
                                            <th><a href="javascript:void(0);">Open Days</a></th>
                                            <th><a href="javascript:void(0);">Open Time</a></th>
                                            <th><a href="javascript:void(0);">Image</a></th>
                                            <th><a href="javascript:void(0);">Action</a></th>
                                        </tr>
                                    </thead>
                                    <tbody id="storesTable">
                                        <?php
                                            $cnt = 0;
                                            $totalStores = $obj->fetch("SELECT COUNT(*) AS total FROM stores")[0]['total'];
                                            $stores = $obj->fetch("SELECT * FROM stores ORDER BY id DESC");
                                            foreach ($stores as $val) { 
                                                $cnt++; 
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo $val['name'] ?></td>
                                            <td><?php echo $val['phone'] ?></td>
                                            <td><?php echo $val['email'] ?></td>
                                            <td><?php echo $val['address'] ?></td>
                                            <td><?php echo $val['date'] ?></td>
                                            <td><?php echo $val['time'] ?></td>
                                            <td><img src="uploads/store/<?php echo $val['image']?>" alt="popular" class="img-fluid avatar-lg rounded"></td>
                                            <td class="row g-2">
                                                <button class="btn btn-sm btn-soft-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $val['id']; ?>">
                                                    <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon> Edit
                                                </button>
                                                <button class="btn btn-sm btn-soft-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $val['id']; ?>">
                                                    <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon> Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- edit modal start  -->
                                        <div class="modal fade" id="editModal<?php echo $val['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $val['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light">
                                                        <h4 class="modal-title" id="editModalLabel<?php echo $val['id']; ?>">Edit Store Details</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="editStoreForm" enctype="multipart/form-data">
                                                            <input type="hidden" name="store_id" value="<?php echo $val['id']; ?>">
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Name</label>
                                                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $val['name']; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="phone" class="form-label">Phone No.</label>
                                                                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $val['phone']; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="email" class="form-label">Email</label>
                                                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $val['email']; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="address" class="form-label">Address</label>
                                                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $val['address']; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="date" class="form-label">Open Days</label>
                                                                <input type="text" class="form-control" id="date" name="date" value="<?php echo $val['date']; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="time" class="form-label">Open Time</label>
                                                                <input type="text" class="form-control" id="time" name="time" value="<?php echo $val['time']; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="image" class="form-label">Image</label>
                                                                <input type="file" class="form-control" id="image" name="image">
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="uploads/store/<?php echo $val['image']; ?>" alt="Deal Image" class="img-fluid me-3" style="max-height: 100px; border-radius: 10px;">
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-soft-primary float-end p-2"><i class="bx bx-refresh me-1"></i>Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- edit modal end -->

                                        <!-- delete modal start -->
                                        <div class="modal fade" id="deleteModal<?php echo $val['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $val['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="deleteModalLabel<?php echo $val['id']; ?>">Delete Store</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <p>Are you sure you want to delete this Store?</p>
                                                        <p><strong><?php echo $val['name']; ?></strong></p>
                                                        <form class="storeDeleteForm">
                                                            <input type="hidden" name="store_id" value="<?php echo $val['id']; ?>">
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-center">
                                                        <button type="button" class="btn btn-soft-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-soft-danger confirm-delete" data-id="<?php echo $val['id']; ?>"><i class="bx bx-trash me-1"></i>Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- delete modal end -->
                                         
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Add Modal Start -->
                            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="addModalLabel">Add Store</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="storeFormAdd">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Location Name <span style="color:red;">*</span></label>
                                                    <input type="text" class="form-control" id="name" name="name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Phone No. <span style="color:red;">*</span></label>
                                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email <span style="color:red;">*</span></label>
                                                    <input type="email" class="form-control" id="email" name="email" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address <span style="color:red;">*</span></label>
                                                    <input type="text" class="form-control" id="address" name="address" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="date" class="form-label">Open Days <span style="color:red;">*</span></label>
                                                    <input type="text" class="form-control" id="date" name="date" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="time" class="form-label">Open Time <span style="color:red;">*</span></label>
                                                    <input type="text" class="form-control" id="time" name="time" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Upload Store Image <span style="color:red;">*</span></label>
                                                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="saveStore">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Add Category Modal End -->

                            <!-- total entries  -->
                            <div class="card-footer border-top">
                                <div class="row g-3">
                                    <div class="col-sm">
                                        <div class="text-muted">
                                            Total <span class="fw-semibold" id="totalStores"><?php echo $totalStores; ?></span> entries.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- total entries  -->
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'footer.php'; ?>
        </div>
    </div>

<!-- All necessary scripts are in here -->
<script>
    // add store ajax
    document.getElementById("saveStore").addEventListener("click", function() {
        let form = document.getElementById("storeFormAdd");
        let formData = new FormData(form);
        if (!formData.get("name") || !formData.get("phone") || !formData.get("email") || !formData.get("address") || !formData.get("image").name) {
            showToast("Please fill all fields", "error");
            return;
        }
        fetch("add_store.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            showToast(data.message, data.status);
            if (data.status === "success") {
                form.reset();
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            }
        })
        .catch(() => showToast("Server error occurred", "error"));
    });
    function showToast(msg, type) {
        Toastify({ text: msg, duration: 2000, gravity: "top", position: "center", backgroundColor: type === "success" ? "green" : "red" }).showToast();
    }

    // edit store ajax 
    $(document).on("submit", ".editStoreForm", function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: "edit_store.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                let res = JSON.parse(response);
                if (res.status === "success") {
                    Toastify({
                        text: "Store Details updated successfully!",
                        duration: 3000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "green",
                    }).showToast();
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
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

    // delete store ajax 
    $(document).ready(function () {
        $(".confirm-delete").click(function () {
            var storeId = $(this).data("id");
            $.ajax({
                url: "delete_store.php",
                type: "POST",
                data: { id: storeId },
                beforeSend: function () {
                    Toastify({
                        text: "Deleting store...",
                        duration: 500,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#FFA500", 
                    }).showToast();
                },
                success: function (response) {
                    if (response.trim() === "success") {
                        $("#deleteModal" + storeId).modal("hide");
                        Toastify({
                            text: "Store deleted successfully!",
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
                            text: "Error deleting store. Try again.",
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