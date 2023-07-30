<?php 
if (isset($_GET['id'])) {

    $id = escape_string($_GET['id']);

    $result = query("SELECT * FROM products WHERE product_id = " . escape_string($id));
    while ($row = fetchArray($result)) {

        $currentName = $row['product_name'];
        $currentCategory = $row['product_category_id'];
        $currentPrice = $row['product_price'];
        $currentQuantity = $row['product_quantity'];
        $currentDescription = $row['product_description'];
        $currentImage = $row['product_image'];
        $currentShortDesc = $row['product_short_description'];

    }

    adminEditProduct($id);

} ?>




<div id="page-wrapper">

<div class="container-fluid">

<div class="col-md-12">

<div class="row">
<h1 class="page-header">
Edit Product

</h1>
</div>
       


<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

<div class="form-group">
<label for="product-title">Product Name </label>
<input type="text" name="product_title" class="form-control" value="<?=$currentName?>">

</div>


<div class="form-group">
   <label for="product-title">Product Description</label>
<textarea name="product_description" id="" cols="30" rows="10" class="form-control"><?=$currentDescription?></textarea>
</div>



<div class="form-group row">

<div class="col-xs-3">
<label for="product-price">Product Price</label>
<input type="number" name="product_price" class="form-control" size="60" min="0" step="0.01" value="<?=$currentPrice?>">
</div>
</div>







</div><!--Main Content-->

<!-- SIDEBAR-->

<aside id="admin_sidebar" class="col-md-4">


<div class="form-group">
<input type="submit" name="editproduct" class="btn btn-primary btn-lg" value="Edit Product">
</div>


<!-- Product Categories-->

<div class="form-group">
 <label for="product-title">Product Category</label>
<select name="product_category" id="" class="form-control">
    <?= adminListEditCategories($currentCategory); ?>
   
</select>


</div>

<!-- Product Brands-->

<div class="form-group">
<label for="product-title">Product Quantity</label>
<input type="number" min="0" name="product_quantity" class="form-control" value="<?=$currentQuantity?>">
</div>

<!-- Product Tags -->


<!-- <div class="form-group">
  <label for="product-title">Product Keywords</label>
<input type="text" name="product_tags" class="form-control">
</div> -->


<div class="form-group">
<label for="product-title">Short Description</label><br>
<textarea class="form-control" name="short_desc" id="" cols="67" rows="2" maxlength="123"><?=$currentShortDesc?></textarea>
</div>


<!-- Product Image -->
<div class="form-group">
<label for="product-title">Product Image</label>
<input type="file" name="file">
<hr>
<label for="product-title">Current Image</label><br>
<img src="../../resources/templates/uploads/<?=$currentImage?>" width='260.48' height='122.09'" alt="">
</div>

</aside><!--SIDEBAR-->

</form>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


