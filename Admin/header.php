<?php
$userName = isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : null;
?>
<header class="topbar">
     <div class="container-fluid">
          <div class="navbar-header">
               <div class="d-flex align-items-center">
                    <div class="topbar-item">
                         <button type="button" class="button-toggle-menu me-2">
                              <iconify-icon icon="solar:hamburger-menu-broken" class="fs-24 align-middle"></iconify-icon>
                         </button>
                    </div>
                    <div class="topbar-item">
                         <h4 class="fw-bold topbar-button pe-none text-uppercase mb-0">Welcome <?php echo htmlspecialchars($userName); ?>!</h4>
                    </div>
               </div>
               <div class="d-flex align-items-center gap-1">
                    <div class="topbar-item">
                         <button type="button" class="topbar-button" id="light-dark-mode">
                              <iconify-icon icon="solar:moon-bold-duotone" class="fs-24 align-middle"></iconify-icon>
                         </button>
                    </div>
                    <div class="dropdown topbar-item">
                         <a type="button" class="topbar-button" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="d-flex align-items-center">
                                   <img class="rounded-circle" width="32" src="images/avatar-1.jpg" alt="avatar-3">
                              </span>
                         </a>
                         <div class="dropdown-menu dropdown-menu-end">
                              <h6 class="dropdown-header">Welcome <?php echo htmlspecialchars($userName); ?>!</h6>
                              <div class="dropdown-divider my-1"></div>
                              <a class="dropdown-item text-danger" href="" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                   <i class="bx bx-log-out fs-18 align-middle me-1"></i><span class="align-middle">Logout</span>
                              </a>
                         </div>
                    </div>
                    <!-- App Search-->
                    <form class="app-search d-none d-md-block ms-2" action="search_order.php" method="GET" novalidate style="width: 350px;">
                         <div class="position-relative">
                              <input type="text" class="form-control" name="content" placeholder="General Search" autocomplete="off" required>
                              <button type="submit" class="search-widget-icon border-0 bg-transparent" style="width: auto; height: auto; display: flex; align-items: center; justify-content: center;">
                                   <iconify-icon icon="solar:magnifer-linear"></iconify-icon>
                              </button>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</header>

<!-- logout modal start  -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <i class="bx bx-log-out fs-24 align-middle me-2"></i>
                    <h5 class="modal-title" id="logoutModalLabel">Logout Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <p class="text-center">Are you sure you want to logout?</p>
               </div>
               <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-soft-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                    <a href="logout.php" class="btn btn-soft-danger">Logout</a>
               </div>
          </div>
     </div>
</div>
<!-- logout modal end  -->

<!-- necessary styling for the table -->
<style>
     .table-responsive {
          overflow-x: auto;
          white-space: nowrap;
     }
     .table {
          width: 100%;
     }
     .table th, .table td {
          padding: 10px 15px;
          text-align: center !important;
          vertical-align: middle !important;
          white-space: wrap;
          overflow: hidden;
          text-overflow: ellipsis;
     }
     .table tbody tr {
          height: auto;
          max-height: 60px;
     }
     .table td p {
          margin-bottom: 0;
          font-size: 14px;
          overflow: hidden;
          text-overflow: ellipsis;
          white-space: nowrap;
     }
     th:nth-child(1), td:nth-child(1) { max-width: 300px; } 
     th:nth-child(2), td:nth-child(2) { max-width: 350px; }
     th:nth-child(3), td:nth-child(3) { max-width: 120px; }
     th:nth-child(4), td:nth-child(4) { max-width: 150px; }
     th:nth-child(5), td:nth-child(5) { max-width: 150px; }
     th:nth-child(6), td:nth-child(6) { max-width: 120px; }
     th:nth-child(7), td:nth-child(7) { max-width: 140px; } 
     th:nth-child(8), td:nth-child(8) { max-width: 140px; } 
     th:nth-child(9), td:nth-child(9) { max-width: 200px; } 
     th:nth-child(10), td:nth-child(10) { max-width: 130px; } 
     th:nth-child(11), td:nth-child(11) { max-width: 100px; } 
     th:nth-child(12), td:nth-child(12) { max-width: 140px; } 
</style>