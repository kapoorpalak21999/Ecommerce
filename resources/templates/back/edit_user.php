<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   Edit User

</h1>
<?php
     if(isset($_SESSION['message'])){
?>
    <h2 class="text-center alert alert-warning" role="alert"><?php echo ($_SESSION['message']); ?></h2>
    <?php 
    unset($_SESSION['message']);

}?>

</div>
<?php 

if(isset($_GET['id'])){
$query= query("SELECT * FROM users WHERE user_id = ".escape_string($_GET['id']) ." ");
confirm($query);

while($row= fetch_array($query)){
$user_id     =  escape_string($row['user_id']);
$username    =  escape_string($row['username']);
$email       =  escape_string($row['email']);
$image       =  escape_string($row['user_photo']);


$image=display_image($row['user_photo']);

}

edit_user();

}


?>




<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

<div class="form-group">
    <label for="product-title">Username </label>
        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
       
    </div>


    <div class="form-group">
           <label for="product-title">Email</label>
      <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
    </div>



    <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-price">Password</label>
        <input type="password" name="password" class="form-control" size="60">
      </div>
    </div>

    <div class="form-group row">

    <div class="col-xs-4">
        <label for="product-price">Confirm Password</label>
        <input type="password" name="confirm" class="form-control" size="60">
      </div>
    </div>



     
    <div class="form-group">
        <input type="submit" name="update" class="btn btn-primary btn-lg pull-right" value="Update">
    </div>

    <!-- Product Image -->
    <div class="form-group">
      
        <label for="product-title">User Image</label>
        <img id="i" src="../../resources/<?php echo $image; ?>" width='100px' height='120px' alt="">
        <input type="file" name="file">
        
      
    </div>



    
</form>

