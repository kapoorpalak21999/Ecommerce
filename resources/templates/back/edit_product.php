<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   Edit Product

</h1>
</div>
<?php 

if(isset($_GET['id'])){
$query= query("SELECT * FROM products WHERE product_id = ".escape_string($_GET['id']) ." ");
confirm($query);

while($row= fetch_array($query)){
$title        =  escape_string($row['product_title']);
$price        =  escape_string($row['product_price']);
$description  =  escape_string($row['product_description']);
$category_id  =  escape_string($row['product_category_id']);
$short_desc   =  escape_string($row['short_desc']);
$quantity     =  escape_string($row['product_quantity']);
$image        =  escape_string($row['product_image']);


$image=display_image($row['product_image']);

}

edit_product();

}


?>




<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

<div class="form-group">
    <label for="product-title">Product Title </label>
        <input type="text" name="product_title" class="form-control" value="<?php echo $title; ?>">
       
    </div>


    <div class="form-group">
           <label for="product-title">Product Description</label>
      <textarea name="product_description" id="" cols="30" rows="10" class="form-control"><?php echo $description; ?></textarea>
    </div>



    <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-price">Product Price</label>
        <input type="number" name="product_price" class="form-control" size="60" value="<?php echo $price; ?>">
      </div>
    </div>




    
    

</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
       <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
        <input type="submit" name="update" class="btn btn-primary btn-lg" value="Update">
    </div>


     <!-- Product Categories-->

    <div class="form-group">
         <label for="product-title">Product Category</label>
          <select name="product_category_id" class="form-control">
            <option value="<?php echo $category_id; ?>" hidden><?php echo  get_categories_title($category_id) ?></option>
            <?php show_categories_add_products(); ?>

          </select>
</div>





    <!-- Product Brands-->


    <div class="form-group">
      <label for="product-title">Product Quantity</label>
         <input type="number" class="form-control" name="product_quantity" value="<?php echo $quantity; ?>">
    </div>


<!-- Product Tags -->


    <div class="form-group">
          <label for="product-title">Product Short Description</label>
        <textarea type="textarea" name="short_desc" class="form-control"><?php echo $short_desc; ?></textarea>
    </div>

    <!-- Product Image -->
    <div class="form-group">
      
        <label for="product-title">Product Image</label>
        <input type="file" name="file">
        <img id="i" src="../../resources/<?php echo $image; ?>" width='100px' height='120px' alt="">
      
    </div>



</aside><!--SIDEBAR-->


    
</form>



                


