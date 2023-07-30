<?php
require_once("../resources/config.php");

if (isset($_SESSION['username'])) {
$_SESSION['username'] = null;
$_SESSION['user_role'] = null;
redirect("index.php");
}
