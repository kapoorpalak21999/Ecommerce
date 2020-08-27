<?php require_once("../resources/config.php");

if (isset($_POST['submit'])) {
$username = $_SESSION['username'];
$query = query("SELECT * FROM users WHERE username = '$username'");
confirm($query);
$add = query("SELECT * FROM address ORDER BY address_id DESC LIMIT 1");
confirm($add);
$r = fetch_array($add);
$add_row = $r['address_id'] + 1;

$_SESSION['addrow'] = $add_row;

$row=fetch_array($query);
$userid = $row['user_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$_SESSION['email'] = $email;
$_SESSION['billaddress']=$userid;
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$phone = $_POST['phone'];
$pincode = $_POST['pincode'];

$insert = query("INSERT INTO address(userid,name,email,address,city,state,phone,pincode) VALUES('{$userid}','{$name}','{$email}','{$address}','{$city}','{$state}','{$phone}','{$pincode}')");
confirm($insert);
redirect("checkout.php");
}



include(TEMPLATE_FRONT . DS . "header.php") ;

if(isset($_SESSION['message'])){
	?>

<h1 class="bg bg-alert"><?php echo $_SESSION['message']; ?>
	<button ></button>
</h1>
	<?php
} 
unset($_SESSION['message']);?>

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-4 pull-right ">
<h2 style="text-align: center;font-weight: bold;">Cart Totals</h2>

<table class="table table-bordered" style = "background-color: white;" cellspacing="0">

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

                <div class="col-lg-8 col-xs-12">
                    <h1 style="text-align: center;font-weight: bold;">Enter Your Address</h1>
                    <div class="well well-sm">
                    <form name="sentMessage" id="contactForm" method="post" >

                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                	Name
                                    <input type="text" name="name" class="form-control" placeholder="Your Name *" id="name" required>
                               
                                </div>
                                <div class="form-group">
                                	Email
                                    <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                    <input type="email" name="email" class="form-control" placeholder="Your Email *" id="email" required >
                   
                                </div>
                                </div>
                                <div class="form-group">
                                	Address
                                    <input name="address" type="text" class="form-control" placeholder="Address" required>
                                  
                                </div>
                                 <div class="form-group">
                                	City
                                    <input name="city" type="text" class="form-control" placeholder="City" required>
                                  
                                </div>
                                
                              
                            </div>
                            <div class="col-md-6">
                            	<div class="form-group">
                                	State
                                    <input name="state" type="text" class="form-control" placeholder="State"  required>
                                  
                                </div>
                                 <div class="form-group">
                                	Pincode
                                    <input name="pincode" type="text" class="form-control" placeholder="Pincode"  required>
                                  
                                </div>

                                <div class="form-group">
                                	Phone
                                    <input name="phone" type="number" class="form-control" placeholder="Phone" required>
                                  
                                </div>
                                
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button name="submit" type="submit" class="btn btn-primary">Place Order</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>


    </div>
    <!-- /.container -->


  <?php include(TEMPLATE_FRONT . DS . "footer.php"); ?> 
