 <h1 class="page-header">
      Add User
      <small>Page</small>
  </h1>
  <div class="col-md-6 user_image_box">
    
<span id="user_admin" class='fa fa-user fa-4x'></span>

</div>
<?php
     if(isset($_SESSION['message'])){
?>
    <h2 class="text-center alert alert-warning" role="alert"><?php echo ($_SESSION['message']); ?></h2>
    <?php 
    unset($_SESSION['message']);

}?>

<?php add_user(); ?>





<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-6">
   <div class="form-group">
     
      <input type="file" name="file">
         
     </div>

<div class="form-group">
    <label for="product-title">Username </label>
        <input type="text" name="username" class="form-control" required>
       
    </div>


    <div class="form-group">
           <label for="product-title">Email</label>
          <input type="email" name="email" class="form-control" required>
       
    </div>



    <div class="form-group row">

      <div class="col-xs-4">
        <label for="product-price">Password</label>
        <input type="password" id="myInput" name="password" class="form-control" size="60">
        <input type="checkbox" onclick="myfunction()">Show Password
      </div>
    
     
     <script>
       function myfunction() {
         var x = document.getElementById('myInput');
         if(x.type === "password"){
          x.type = "text";
         }else {
          x.type = "password";
         }
       }
     </script>

    <div class="form-group row">

    <div class="col-xs-4">
        <label for="product-price">Confirm Password</label>
        <input type="password" name="confirm" class="form-control" size="60">
      </div>
    </div>




    
    




     
     <div class="form-group">
       <a id="user-id" class="btn btn-danger btn-lg" href="">Delete</a>

        <input type="submit" name="add" class="btn btn-primary btn-lg pull-right" value="ADD">
    </div>






    
</form>



                


