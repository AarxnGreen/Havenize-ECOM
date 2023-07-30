<?php require_once("../../resources/config.php"); ?>
<?php include(TEMPLATE_BACK . DS . "admin_header.php"); ?>
<?php

if(!isset($_SESSION['user_role'])) {
    redirect("../index.php");
} elseif($_SESSION['user_role'] == "User") {
    redirect("../index.php");
}; 

?>










?>
        
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <?php if ($_SERVER['REQUEST_URI'] == "/ecom/public/admin/" || $_SERVER['REQUEST_URI'] == "/ecom/public/admin/index.php") {
                    include(TEMPLATE_BACK . DS . "admin_heading.php");} ?>
                <!-- /.row -->
                
                <?php if ($_SERVER['REQUEST_URI'] == "/ecom/public/admin/" || $_SERVER['REQUEST_URI'] == "/ecom/public/admin/index.php") {
                    include(TEMPLATE_BACK . DS . "admin_content.php");}


                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                        switch($source) {

                            case 'orders':
                                include(TEMPLATE_BACK . DS . "orders.php");
                                break;
                            case 'products':
                                include(TEMPLATE_BACK . DS . "products.php");
                                break;
                            case 'add_product':
                                include(TEMPLATE_BACK . DS . "add_product.php");
                                break;
                            case 'edit_product':
                                include(TEMPLATE_BACK . DS . "edit_product.php");
                                break;
                            case 'categories':
                                include(TEMPLATE_BACK . DS . "categories.php");
                                break;
                            case 'users':
                                include(TEMPLATE_BACK . DS . "users.php");
                                break;
                            case 'reports':
                                include(TEMPLATE_BACK . DS . "reports.php");
                                break;
                            case 'add_user':
                                include(TEMPLATE_BACK . DS . "add_user.php");
                                break;

                        }
                    }    
                        ?>


                 <!-- FIRST ROW WITH PANELS -->
                 

                <!-- /.row -->
                
                
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include(TEMPLATE_BACK . DS . "admin_footer.php"); ?>



