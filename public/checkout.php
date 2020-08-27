<?php
require_once("../resources/config.php");
if (!isset($_SESSION['username'])) {
   redirect("login.php");
 } 

include(TEMPLATE_FRONT . DS . "header.php");
?>

    <!-- Page Content -->
    <div class="container">


<!-- /.row --> 

<div class="row">
            <?php
                 if(isset($_SESSION['message'])){
            ?>
                <h2 class="text-center alert alert-warning" role="alert"><?php echo ($_SESSION['message']); ?></h2>
                <?php 
                unset($_SESSION['message']);

            }?>

      <h1>Checkout</h1>
   
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart" hidden>
<input type="hidden" name="business" value="john123-facilitator@business.example.com" hidden>
<input type="hidden" name="currency_code" value="INR" hidden>
<input type="hidden" name="upload" value="1" hidden>
    <table class="table table-striped table-condensed">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>
     
          </tr>
        </thead>
        <tbody>
           <?php cart(); ?>
        </tbody>
    </table>
   <?php echo show_paypal(); ?>
</form>



<!--  ***********CART TOTALS*************-->
            
<div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>

<table class="table table-bordered" style = "background-color: white;"  cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount">
   <?= isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] :$_SESSION['item_quantity']="0"; ?>


</span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount">Rs.

  <?= isset($_SESSION['item_total']) ? $_SESSION['item_total'] :$_SESSION['item_total']="0"; ?>
    

  </span></strong> </td>
</tr>


</tbody>

</table>


</div><!-- CART TOTALS-->
<?php if (isset($_SESSION['billaddress'])) {
  $user_di=$_SESSION['billaddress'];
  $add = query("SELECT * FROM address WHERE userid = '$user_di' ORDER BY address_id DESC LIMIT 1");
  confirm($add);
  $row = fetch_array($add);
?>

<div class="col-xs-4 pull left ">
<h2>Billing Details</h2>

<table class="table table-bordered" style = "background-color: white;" cellspacing="0">

<tr class="cart-subtotal">
<th>Address:</th>
<td><span class="amount">
   <?= $row['address']; ?>


</span></td>
</tr>
<tr class="shipping">
<th>Pincode</th>
<td><?= $row['pincode']; ?></td>
</tr>

<tr class="order-total">
<th>City</th>
<td><strong><span>

 <?= $row['city']; ?>

  </span></strong> </td>
</tr>

<tr class="order-total">
<th>State</th>
<td><strong><span>

 <?= $row['state']; ?>

  </span></strong> </td>
</tr>
<tr class="order-total">
<th>Phone</th>
<td><strong><span>

 <?= $row['phone']; ?>

  </span></strong> </td>
</tr>
<tr class="order-total">
<th>Email</th>
<td><strong><span>

 <?= $row['email']; ?>

  </span></strong> </td>
</tr>



</tbody>

</table>


</div><!--Address TOTALS-->
<?php }
 ?>

 </div><!--Main Content-->
 <table>
  <tr>
    <td><a href="index.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
    <td><a href="address.php" class="btn btn-success btn-block">Proceed To Enter Your Address <i class="fa fa-angle-right"></i></a></td>
  </tr>

</table>


       

    </div>
    <!-- /.container -->
  <?php require(TEMPLATE_FRONT . DS . "footer.php"); ?>

