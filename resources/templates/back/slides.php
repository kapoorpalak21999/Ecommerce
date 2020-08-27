

  <div class="row">
 <h1 class="page-header text-center">
   Slides

</h1>

<?php
     if(isset($_SESSION['message'])){
?>
    <h2 class="text-center alert alert-success" role="alert"><?php echo ($_SESSION['message']); ?></h2>
    <?php 
    unset($_SESSION['message']);

}?>

<?php add_slide(); ?>
 <div class="col-md-4 col-xs-12">

 <form action="" method="post" enctype="multipart/form-data">
  
<div class="form-group">

<input type="file" name="file" required>

</div>

<div class="form-group">
<label for="title">Slide Title</label>
<input type="text" name="slide_title" class="form-control" required>

</div>

<div class="form-group">

<input class="btn btn-primary" type="submit" name="add_slide">

</div>

 </form>

 </div>



 <div class="col-md-8 col-xs-12">

<?php get_current_slide(); ?>
 </div>

</div><!-- ROW-->

<hr>

<h1>Slides Available</h1>

<div class="row">
  
<?php  get_slide_thumbnail(); ?>


</div>


