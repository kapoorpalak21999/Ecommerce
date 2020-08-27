
<div class="col-md-12">
<div class="row">

<h1 class="page-header text-center">
   All Products

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
           <th>S.N</th>
           <th>Id</th>
           <th>Title</th>
           <th>Category</th>
           <th>Price</th>
           <th>Quantity</th>
      </tr>
    </thead>
    <tbody>
      <?php get_products_in_admin(); ?>
    </tbody>
</table>
</div>










                
                 


             </div>

           