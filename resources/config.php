<?php 

ob_start();

session_start();
//session_destroy();

defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR); //Checks if 'DS' is defined, if it is then do nothing. If not, DS is assigned the OS directory separator.

defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates/front"); // Checks if TEMPLATE_FRONT is defined. If not, assigns it to the directory.
defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates/back"); // Same as TEMPLATE_FRONT but for TEMPLATE_BACK.
defined("UPLOAD_DIRECTORY") ? null : define("UPLOAD_DIRECTORY", __DIR__ . DS . "templates/uploads");

defined("DB_HOST") ? null : define("DB_HOST", "localhost");

defined("DB_USER") ? null : define("DB_USER", "root");

defined("DB_PASS") ? null : define("DB_PASS", "");

defined("DB_NAME") ? null : define("DB_NAME", "ecom_db"); // Assigns all required database information to constants.

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME); // Defining the database connection using the constants.

require_once("functions.php"); // Only require once so we can use config.php throughout the app.
require_once("cart.php");
