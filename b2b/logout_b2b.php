<?php
session_name("B2B_SESSION");
session_start();
session_unset();
session_destroy();
setcookie("B2B_SESSION", "", time() - 3600, "/");
header("Location: login_B_to_B.php");
exit();
?>