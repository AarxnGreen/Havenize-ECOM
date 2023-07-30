<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>


    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <?php if($_SERVER['REQUEST_METHOD'] === "GET") {
            $catId = $_GET['category'];
            $query = query("SELECT cat_title FROM categories WHERE cat_id =" . escape_string($catId) . " " );
            $row = fetchArray($query);
            $catTitle = $row['cat_title'];
            } ?>
        <header class="jumbotron hero-spacer">
            <h1><?= $catTitle ?></h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
            </p>
        </header>

        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Latest Items</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">
        <?php getCategoryProducts($catId); ?>

        </div>
        <!-- /.row -->

        <hr>


    </div>
    <!-- /.container -->

    <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>


