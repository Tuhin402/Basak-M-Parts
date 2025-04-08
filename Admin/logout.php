<?php
session_name("ADMIN_SESSION");
session_start();
session_unset();
session_destroy();
setcookie("ADMIN_SESSION", "", time() - 3600, "/");
header("Location: login.php");
exit();
?>