<?php
include 'session_config.php';
if(isset($_SESSION['user_id'])) {
    echo '<script>window.location.href="dashboard.php"</script>';
} else {
    echo '<script>window.location.href="login.php"</script>';
}
?>