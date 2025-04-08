<?php
include 'session_config.php';
if(empty($_SESSION['user_email'])){
    echo '<script>window.location.href="login.php"</script>';
}
include "config.php";
include 'headerlink.php'; 
?>

<body">
    <div class="wrapper">

        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>

        <div class="page-content">
            <div class="container-fluid text-center">
                <div class="row justify-content-center vh-100">
                    <div class="col-xxl-12 col-xl-10 col-lg-10 col-md-10 col-sm-12 d-flex flex-column align-items-center justify-content-center p-3" style="width: 500px;">
                        <h1 class="display-1 fw-bold text-danger" style="font-size: 8rem;">404</h1>
                        <p class="fs-4">Oops! Looks like you took a wrong turn.</p>
                        <p class="text-muted">The page you’re looking for either never existed, got deleted, or was stolen by a mischievous bug.</p>
                        <a href="index.php" class="btn btn-soft-primary px-4 py-2 btn-lg shadow-lg">
                            <i class="bx bx-left-arrow-alt"></i> Take Me Home
                        </a>
                        <p class="mt-4 text-secondary">Still lost? Contact support before we start blaming the intern 🧐</p>
                    </div>
                </div>
            </div>

            <?php include 'footer.php'; ?>
        </div>
    </div>

<?php include 'footerlink.php'; ?>