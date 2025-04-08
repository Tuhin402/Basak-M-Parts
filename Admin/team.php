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
                            <h3 class="page-title">Our Team</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Our Team</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="card-title">Our Team Members</h4>
                                    <a href="" class="btn btn-sm btn-soft-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                                        <i class="bx bx-plus me-1"></i>Add Team Member
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
                                            <th><a href="javascript:void(0);">Name</a></th>
                                            <th><a href="javascript:void(0);">Role</a></th>
                                            <th><a href="javascript:void(0);">Social (Facebook)</a></th>
                                            <th><a href="javascript:void(0);">Image</a></th>
                                            <th><a href="javascript:void(0);">Action</a></th>
                                        </tr>
                                    </thead>
                                    <tbody id="membersTable">
                                        <?php
                                            $cnt = 0;
                                            $totalMembers = $obj->fetch("SELECT COUNT(*) AS total FROM team")[0]['total'];
                                            $members = $obj->fetch("SELECT * FROM team ORDER BY id DESC");
                                            foreach ($members as $val) { 
                                                $cnt++; 
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo $val['name'] ?></td>
                                            <td><?php echo $val['role'] ?></td>
                                            <td><a href="<?php echo $val['social'] ?>" target="_blank" class="text-danger fw-semibold">Link</a></td>
                                            <td><img src="uploads/team/<?php echo $val['image']?>" alt="popular" class="img-fluid avatar-lg rounded"></td>
                                            <td>
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
                                                        <h4 class="modal-title" id="editModalLabel<?php echo $val['id']; ?>">Edit Member</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="editMemberForm" enctype="multipart/form-data">
                                                            <input type="hidden" name="member_id" value="<?php echo $val['id']; ?>">
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Name</label>
                                                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $val['name']; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="role" class="form-label">Role</label>
                                                                <input type="text" class="form-control" id="role" name="role" value="<?php echo $val['role']; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="link" class="form-label">Facebook profile URL</label>
                                                                <input type="url" class="form-control" id="link" name="link" value="<?php echo $val['social']; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="image" class="form-label">Image</label>
                                                                <input type="file" class="form-control" id="image" name="image">
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="uploads/team/<?php echo $val['image']; ?>" alt="Deal Image" class="img-fluid me-3" style="max-height: 100px; border-radius: 10px;">
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
                                                        <h3 class="modal-title" id="deleteModalLabel<?php echo $val['id']; ?>">Delete Team Member</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <p>Are you sure you want to delete this Member?</p>
                                                        <p><strong><?php echo $val['name']; ?></strong></p>
                                                        <form class="deleteMemberForm">
                                                            <input type="hidden" name="member_id" value="<?php echo $val['id']; ?>">
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
                                            <h3 class="modal-title" id="addModalLabel">Add Team Member</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="memberFormAdd">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Name <span style="color:red;">*</span></label>
                                                    <input type="text" class="form-control" id="name" name="name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="role" class="form-label">Role <span style="color:red;">*</span></label>
                                                    <input type="text" class="form-control" id="role" name="role" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="link" class="form-label">Facebook Profile URL</label>
                                                    <input type="url" class="form-control" id="link" name="link">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Upload Image <span style="color:red;">*</span></label>
                                                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="saveMember">Save</button>
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
                                            Total <span class="fw-semibold" id="totalMembers"><?php echo $totalMembers; ?></span> entries.
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
    // add member ajax
    document.getElementById("saveMember").addEventListener("click", function() {
        let form = document.getElementById("memberFormAdd");
        let formData = new FormData(form);
        if (!formData.get("name") || !formData.get("role") || !formData.get("link") || !formData.get("image").name) {
            showToast("Please fill all fields", "error");
            return;
        }
        fetch("add_team.php", {
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

    // edit member ajax 
    $(document).on("submit", ".editMemberForm", function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: "edit_team.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                let res = JSON.parse(response);
                if (res.status === "success") {
                    Toastify({
                        text: "Member details updated successfully!",
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

    // delete member ajax 
    $(document).ready(function () {
        $(".confirm-delete").click(function () {
            var memberId = $(this).data("id");
            $.ajax({
                url: "delete_team.php",
                type: "POST",
                data: { id: memberId },
                beforeSend: function () {
                    Toastify({
                        text: "Deleting member...",
                        duration: 500,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#FFA500", 
                    }).showToast();
                },
                success: function (response) {
                    if (response.trim() === "success") {
                        $("#deleteModal" + memberId).modal("hide");
                        Toastify({
                            text: "Member deleted successfully!",
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
                            text: "Error deleting member. Try again.",
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