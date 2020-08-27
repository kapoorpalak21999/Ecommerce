<?php require_once("../resources/config.php"); ?>
<?php require(TEMPLATE_FRONT . DS . "header.php") ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">
            </div>
<?php
     if(isset($_SESSION['message'])){
?>
    <h2 class="text-center alert alert-success" role="alert"><?php echo ($_SESSION['message']); ?></h2>
    <?php 
    unset($_SESSION['message']);

}?>


            <?php require(TEMPLATE_FRONT . DS . "side_nav.php") ?>


            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                       <?php require(TEMPLATE_FRONT . DS . "slider.php") ?>
                    </div>

                </div>

                <div class="row">

                    <?php get_products(); ?>

                </div><!--Roe ends here-->

            </div>

        </div>
        


    </div>


<?php require(TEMPLATE_FRONT . DS . "footer.php"); ?>


                    
    <!-- /.container -->
    

