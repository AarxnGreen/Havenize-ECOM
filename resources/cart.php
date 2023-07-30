<?php require_once("config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
<?php 

if (isset($_GET['add'])) {


    $query = query("SELECT * FROM products WHERE product_id= " . escape_string($_GET['add']));
    $result = fetchArray($query);
    if ($result['product_quantity'] > $_SESSION['product_' . $_GET['add']]) {

        $_SESSION['product_' . $_GET['add']] += 1; 
        redirect("../public/checkout.php");

    }
    else {
        set_message("We do not have any more available.");
        redirect("../public/checkout.php");
    }


}

if (isset($_GET['remove'])) {

    $_SESSION['product_' . $_GET['remove']]--;

    if ($_SESSION['product_' . $_GET['remove']] < 1) {
        unset($_SESSION['cart_total']);
        unset($_SESSION['item_quant']);
        redirect("../public/checkout.php");
    } else {
        redirect("../public/checkout.php");
    }
}

if (isset($_GET['delete'])) {

    $_SESSION['product_' . $_GET['delete']] = '0';
    unset($_SESSION['cart_total']);
    unset($_SESSION['item_quant']);
    redirect("../public/checkout.php");



}

?>


