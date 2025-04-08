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
                            <h3 class="page-title">Contact Details</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Contact Details</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="card-title">Contact Details Table</h4>
                                    <a href="" class="btn btn-sm btn-soft-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                                        <i class="bx bx-plus me-1"></i>Add Details
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
                                            <th><a href="javascript:void(0);">Phone No.</a></th>
                                            <th><a href="javascript:void(0);">Helpline No.</a></th>
                                            <th><a href="javascript:void(0);">Email</a></th>
                                            <th><a href="javascript:void(0);">Address</a></th>
                                            <th><a href="javascript:void(0);">Open Days</a></th>
                                            <th><a href="javascript:void(0);">Open Time</a></th>
                                            <th><a href="javascript:void(0);">Google Map URL</a></th>
                                            <th><a href="javascript:void(0);">Action</a></th>
                                        </tr>
                                    </thead>
                                    <tbody id="contactTable">
                                        <?php
                                            $cnt = 0;
                                            $totalContactDetails = $obj->fetch("SELECT COUNT(*) AS total FROM contact")[0]['total'];
                                            $contacts = $obj->fetch("SELECT * FROM contact ORDER BY id DESC");
                                            foreach ($contacts as $val) { 
                                                $cnt++; 
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo $val['phone'] ?></td>
                                            <td><?php echo $val['helpline'] ?></td>
                                            <td><?php echo $val['email'] ?></td>
                                            <td><?php echo $val['address'] ?></td>
                                            <td><?php echo $val['open_date'] ?></td>
                                            <td><?php echo $val['open_time'] ?></td>
                                            <td><a href="<?php echo $val['map'] ?>" class="fw-semibold text-danger" target="_blank">Link</a></td>
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
                                                        <h4 class="modal-title" id="editModalLabel<?php echo $val['id']; ?>">Edit Details</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="editContactForm" enctype="multipart/form-data">
                                                            <input type="hidden" name="detail_id" value="<?php echo $val['id']; ?>">
                                                            <div class="mb-3">
                                                                <label for="phone" class="form-label">Phone No.</label>
                                                                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $val['phone']; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="helpline" class="form-label">Helpline Phone No.</label>
                                                                <input type="tel" class="form-control" id="helpline" name="helpline" value="<?php echo $val['helpline']; ?>">
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
                                                                <input type="text" class="form-control" id="date" name="date" value="<?php echo $val['open_date']; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="time" class="form-label">Open Time</label>
                                                                <input type="text" class="form-control" id="time" name="time" value="<?php echo $val['open_time']; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="map" class="form-label">Google Map URL</label>
                                                                <input type="url" class="form-control" id="map" name="map" value="<?php echo $val['map']; ?>">
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
                                                        <h3 class="modal-title" id="deleteModalLabel<?php echo $val['id']; ?>">Delete Details</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <p>Are you sure you want to delete this details with helpline no.?</p>
                                                        <p><strong><?php echo $val['helpline']; ?></strong></p>
                                                        <form class="deleteContactForm">
                                                            <input type="hidden" name="detail_id" value="<?php echo $val['id']; ?>">
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
                                            <h3 class="modal-title" id="addModalLabel">Add Details</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="contactFormAdd">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Phone No. <span style="color:red;">*</span></label>
                                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="helpline" class="form-label">Helpline Phone No. <span style="color:red;">*</span></label>
                                                    <input type="tel" class="form-control" id="helpline" name="helpline" required>
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
                                                    <label for="map" class="form-label">Google Map URL <span style="color:red;">*</span></label>
                                                    <input type="url" class="form-control" id="map" name="map" required>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="saveContact">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Add Modal End -->

                            <!-- total entries  -->
                            <div class="card-footer border-top">
                                <div class="row g-3">
                                    <div class="col-sm">
                                        <div class="text-muted">
                                            Total <span class="fw-semibold" id="totalContactDetails"><?php echo $totalContactDetails; ?></span> entries.
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
    // add contact ajax
    document.getElementById("saveContact").addEventListener("click", function() {
        let form = document.getElementById("contactFormAdd");
        let formData = new FormData(form);
        if (!formData.get("phone") || !formData.get("helpline") || !formData.get("email") || !formData.get("address") || !formData.get("date") || !formData.get("time") || !formData.get("map")) {
            showToast("Please fill all fields", "error");
            return;
        }
        fetch("add_contact.php", {
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

    // edit contact ajax 
    $(document).on("submit", ".editContactForm", function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: "edit_contact.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                let res = JSON.parse(response);
                if (res.status === "success") {
                    Toastify({
                        text: "Details updated successfully!",
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

    // delete contact ajax 
    $(document).ready(function () {
        $(".confirm-delete").click(function () {
            var detailId = $(this).data("id");
            $.ajax({
                url: "delete_contact.php",
                type: "POST",
                data: { id: detailId },
                beforeSend: function () {
                    Toastify({
                        text: "Deleting details...",
                        duration: 500,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#FFA500", 
                    }).showToast();
                },
                success: function (response) {
                    if (response.trim() === "success") {
                        $("#deleteModal" + detailId).modal("hide");
                        Toastify({
                            text: "Details deleted successfully!",
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
                            text: "Error deleting details. Try again.",
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