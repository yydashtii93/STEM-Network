<?php
session_start();
session_unset();
session_destroy();

setcookie("user_id", "", time() - 2628000);
setcookie("user_name", "", time() - 2628000);
setcookie("user_email", "", time() - 2628000);
setcookie("user_role", "", time() - 2628000);

header("Location: login.php");
