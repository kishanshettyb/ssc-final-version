<?php
session_start();
unset($_SESSION["session_admin_username"]);
unset($_SESSION["session_branch"]);
unset($_SESSION["session_branch_id"]);
unset($_SESSION["session_admin_id"]);
header("Location: login.php");
 ?>
