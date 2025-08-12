<?php
session_start();
session_unset();
session_destroy();
header("Location: userlogin.html"); // or wherever user login is
exit();
?>
