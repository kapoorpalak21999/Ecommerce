
<div class="col-md-12">
<div class="row">
<h1 class="page-header text-center">
   All Orders

</h1>

<?php
     if(isset($_SESSION['message'])){
?>
    <h2 class="text-center alert alert-danger" role="alert"><?php echo ($_SESSION['message']); ?></h2>
    <?php 
    unset($_SESSION['message']);

}?>
</div>

<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>S.N</th>
           <th>Order Id</th>
           <th>Amount</th>
           <th>Transaction</th>
           <th>Currency</th>
           <th>Status</th>
      </tr>
    </thead>
    <tbody>
        <?php  display_orders(); ?>
        

    </tbody>
</table>
</div>
