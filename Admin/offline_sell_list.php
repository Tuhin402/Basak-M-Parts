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
                              <h3 class="page-title">Offline Sell List</h3>
                              <ul class="breadcrumb">
                                   <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                   <li class="breadcrumb-item">Products</li>
                                   <li class="breadcrumb-item active">Offline Sell List</li>
                              </ul>
                         </div>
                    </div>
               </div>

               <div class="row">
                    <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center gap-1">
                                    <h4 class="card-title flex-grow-1">Product Sell List Offline</h4>
                                </div>
                                <div>
                                    <!-- table start  -->
                                    <div class="table-responsive">
                                        <table class="table align-middle mb-0 table-hover table-centered">
                                            <thead class="bg-light-subtle">
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Part No.</th>
                                                    <th>Type</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total Price</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $cnt = 0;
                                                $sold = $obj->fetch("SELECT * FROM offline_sell ORDER BY date DESC");
                                                foreach ($sold as $val) {
                                                    $pro_id = $val['pro_id'];
                                                    $product = $obj->fetch("SELECT image_1 FROM products WHERE id = '$pro_id'");
                                                    $img = $product[0]['image_1']; 
                                                    $cnt++; 
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                                <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                    <img src="uploads/products/<?php echo $img ?>" alt="" class="avatar-md rounded">
                                                                </div>
                                                                <div>
                                                                    <a href="javascript:void(0);" class="text-dark fw-medium fs-15"><?php echo $val['name'] ?></a>
                                                                </div>
                                                        </div>
                                                    </td>
                                                    <td><p class="text-muted"><?php echo $val['part'] ?></p></td>
                                                    <td><p class="text-muted"><span class="text-dark fw-medium"> <?php echo $val['type'] ?></span></p></td>
                                                    <td><p class="text-muted"><span class="text-dark fw-medium"> <?php echo $val['price'] ?> ₹</span></p></td>
                                                    <td><p class="text-muted"><?php echo $val['qty'] ?></p></td>
                                                    <td><p class="text-muted"><span class="text-dark fw-medium"> <?php echo $val['totalprice'] ?> ₹</span></p></td>
                                                    <td><p class="text-muted"><?php echo $val['date'] ?></p></td>
                                                </tr>
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



<?php include 'footerlink.php'; ?>