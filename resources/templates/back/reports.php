
<div class="col-md-12">
<div class="row">

<h1 class="page-header text-center">
   All Reports

</h1>
<?php
     if(isset($_SESSION['message'])){
?>
    <h2 class="text-center alert alert-success" role="alert"><?php echo ($_SESSION['message']); ?></h2>
    <?php 
    unset($_SESSION['message']);

}?>
</div>
<div class="row">
<table class="table table-hover">


    <thead>

      <tr>
           <th>S.No</th>
          
           <th>Order Id</th>
           <th>Product</th>
           <th>Product ID</th>
           <th>Price</th>

           <th>Quantity</th>
           <th>Address</th>
      </tr>
    </thead>
    <tbody>
    <?php get_reports_in_admin(); ?>
    </tbody>
</table>
</div>
             </div>

           