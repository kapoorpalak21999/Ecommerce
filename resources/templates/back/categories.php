
<h1 class="page-header">
  Product Categories

</h1>
<?php
     if(isset($_SESSION['message'])){
?>
    <h2 class="text-center alert alert-success" role="alert"><?php echo ($_SESSION['message']); ?></h2>
    <?php 
    unset($_SESSION['message']);

}?>

<?php add_categories(); ?>
<div class="col-md-4">
    
    <form action="" method="post">
    
        <div class="form-group">
            <label for="category-title">Title</label>
            <input name="cat_title" type="text" class="form-control" >
        </div>

        <div class="form-group">
            
            <input name="add_category" type="submit" class="btn btn-primary" value="Add Category" >
        </div>      


    </form>


</div>


<div class="col-md-8">

    <table class="table">
            <thead>

        <tr>
            <th>S.No</th>
            <th>id</th>
            <th>Title</th>
        </tr>
            </thead>


    <tbody>
        <?php show_categories_in_admin(); ?>
       
    </tbody>

        </table>

</div>



                











