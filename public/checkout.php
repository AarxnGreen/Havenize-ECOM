<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
<?php 






?>


    <!-- Page Content -->
    <div class="container">


<!-- /.row --> 

<div class="row">

      <h1>Checkout</h1>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"> 
    <input type="hidden" name="cmd" value="_cart"> 
    <input type="hidden" name="business" value="sb-szvig26695512@business.example.com">
    <input type="hidden" name="currency_code" value="GBP">
    <input type="hidden" name="upload" value="1">
    <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           
     
          </tr>
        </thead>
        <tbody>
       <?= listCart(); ?>
        </tbody>
    </table>
    <?php if(isset($_SESSION['item_quant'])) {
        if($_SESSION['item_quant'] > 0) {
            echo show_paypal();
        } else {
            null;
        }
    }  ?>
</form>



<!--  ***********CART TOTALS*************-->
            
<div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount"><?php echo isset($_SESSION['item_quant']) ? $_SESSION['item_quant'] : $_SESSION['item_quant'] = "0"; ?></span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount">£<?php echo isset($_SESSION['cart_total']) ? $_SESSION['cart_total'] : $_SESSION['cart_total'] = "0"; ?></span></strong> </td>
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->


 </div><!--Main Content-->


           <hr>

           <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>


    </div>
    <!-- /.container -->
