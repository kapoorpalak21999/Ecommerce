<!-- <div class="col-md-3">
    <p class="lead">Shop Name</p>
    <div class="list-group">
                    <a href="category.html" class="list-group-item">Category 1</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
    </div>
</div> -->

<div class="card bg-light col-md-3">
                <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i>Shop Name</div>
                <ul class="list-group category_block cat">
                	<?php
                		get_categories();
                    ?>
        
                </ul>
</div>
