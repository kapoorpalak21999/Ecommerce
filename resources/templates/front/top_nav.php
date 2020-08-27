
        <div class="container">
                <div class="navbar-header">
                        <a href="index.php" class="pull-left visible-md visible-lg">
                        <div id ="logo-img" alt="Logo Image"></div>
                    </a>

                    <div class="navbar-brand">

                        <a href="index.php" style="text-decoration: none;"><h1 style=" font-family: Comic Sans MS">E-Commerce</h1></a>
                    </div>
                    <button id="navbarToggle" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapsable-nav" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="collapsable-nav" class="collapse navbar-collapse">
                    <ul id="nav-list" class="nav navbar-nav navbar-right">
                         <li>
                           
                             <a href="index.php">
                                 <span class="glyphicon glyphicon-home"></span> <br class="hidden-xs">
                           Home</a>
                        </li>
                        <hr class="visible-xs">
                        <li>
                           
                             <a href="shop.php">
                                 <span class="glyphicon glyphicon-gift"></span> <br class="hidden-xs">
                           Shop</a>
                        </li>
                        <hr class="visible-xs">
        
                        <li>
                            <a href="checkout.php">
                                 <span class="glyphicon glyphicon-shopping-cart"></span> <br class="hidden-xs">
                            Checkout</a>
                        </li>

                        <hr class="visible-xs">
                        <li>
                             
                            <a href="contact.php">
                                 <span class="glyphicon glyphicon-envelope"></span> <br class="hidden-xs">
                            Contact</a>
                        </li>
                         <hr class="visible-xs">
                        <li>
                             
                            <a href="admin/logout.php">
                                 <span class="glyphicon glyphicon-off"></span> <br class="hidden-xs">
                            Logout</a>
                        </li>
                         <hr class="visible-xs">
                        <li>
                             
                             <a href="update.php">
                                <div class= "hidden-xs">
                                    <img src="../resources/upload/<?php echo $_SESSION['profilepic']; ?>" height=40 width = 40>
                                 </div>
                            <?php echo $_SESSION['username']; ?></a>
                        </li>
                    </ul><!-- #nav-list -->
                </div><!-- .collapse .navbar-collapse -->
                             
                            
        
            </div><!-- .container -->
