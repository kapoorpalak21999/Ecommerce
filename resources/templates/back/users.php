<div class="col-lg-12">
<h1 class="page-header">
Users

</h1>
<?php
     if(isset($_SESSION['message'])){
?>
    <h2 class="text-center alert alert-success" role="alert"><?php echo ($_SESSION['message']); ?></h2>
    <?php 
    unset($_SESSION['message']);

}?>


<a href="index.php?add_user" class="btn btn-primary">Add User</a>


<div class="col-md-12">

<table class="table table-hover">
<thead>
<tr>
<th>Id</th>
<th>Username</th>
<th>Email</th>
</tr>
</thead>
<tbody>




<?php show_users_in_admin(); ?>





</tbody>
</table> <!--End of Table-->


</div>
</div>












