<?php adminAddProduct(); ?>
        <div id="page-wrapper">

        <div class="container-fluid">

<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   Add Product

</h1>
</div>
               


<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

<div class="form-group">
    <label for="product-title">Product Title </label>
        <input type="text" name="product_title" class="form-control">
       
    </div>


    <div class="form-group">
           <label for="product-title">Product Description</label>
      <textarea name="product_description" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>



    <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-price">Product Price</label>
        <input type="number" name="product_price" class="form-control" size="60" min="0" step="0.01">
      </div>
    </div>




    
    

</div><!--Main Content-->

<!-- SIDEBAR-->

<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
        <input type="submit" name="addproduct" class="btn btn-primary btn-lg" value="Add Product">
    </div>


     <!-- Product Categories-->

    <div class="form-group">
         <label for="product-title">Product Category</label>
        <select name="product_category" id="" class="form-control">
            <?= adminListCategories(); ?>
           
        </select>


</div>

    <!-- Product Brands-->

    <div class="form-group">
      <label for="product-title">Product Quantity</label>
        <input type="number" min="0" name="product_quantity" class="form-control">
    </div>

<!-- Product Tags -->


    <!-- <div class="form-group">
          <label for="product-title">Product Keywords</label>
        <input type="text" name="product_tags" class="form-control">
    </div> -->


    <div class="form-group">
        <label for="product-title">Short Description</label><br>
        <textarea class="form-control" name="short_desc" id="" cols="67" rows="2" maxlength="123"></textarea>
    </div>


    <!-- Product Image -->
    <div class="form-group">
        <label for="product-title">Product Image</label>
        <input type="file" name="file">
    </div>

</aside><!--SIDEBAR-->
  
</form>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

