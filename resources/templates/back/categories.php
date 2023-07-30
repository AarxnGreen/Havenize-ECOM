        <div id="page-wrapper">

            <div class="container-fluid">

        

<h1 class="page-header">
  Product Categories

</h1>

<div class="col-md-4">
    
    <form action="../../resources/templates/back/add_category.php" method="post">
    
        <div class="form-group">
            <label for="category-title">Name</label>
            <input type="text" class="form-control" name="catTitle">
        </div>

        <div class="form-group">
            
            <input type="submit" class="btn btn-primary" value="Add Category">
        </div>      


    </form>

    <?php 

        if (isset($_GET['edit_id'])) {

        $id = $_GET['edit_id'];

        $form = <<<DELIMITER

    <form action="../../resources/templates/back/edit_category.php?id=$id" method="post">
    
        <div class="form-group">
            <label for="category-title">Edit Name</label>
            <input type="text" class="form-control" name="newTitle">
        </div>

        <div class="form-group">
            
            <input type="submit" class="btn btn-primary" value="Edit Category">
        </div>      


    </form>

    DELIMITER;

    echo $form;
        }
    ?>



</div>

<div class="col-md-8">

    <table class="table">
            <thead>

        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
            </thead>


    <tbody>
   <?= listCategoriesAdmin(); ?> 
    </tbody>

        </table>

</div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

