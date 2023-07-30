<?php 

require_once("../../config.php"); 

if (isset($_GET['id'])) {
    $id = escape_string($_GET['id']);

    query("DELETE FROM products WHERE product_id = $id");
    redirect("../../../public/admin/index.php?source=products");
}