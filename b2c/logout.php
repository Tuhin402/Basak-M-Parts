<?php
session_name("B2C_SESSION");
session_start();
session_unset();
session_destroy();
setcookie("B2C_SESSION", "", time() - 3600, "/");
header("Location: login.php");
exit();
?>