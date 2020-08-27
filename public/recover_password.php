<?php require_once("../resources/config.php"); ?>
<?php require(TEMPLATE_FRONT . DS . "header.php");









$token = $_GET['token'];
$tokenquery = query("select * from users where token = '$token' ");
confirm($tokenquery);
$tokencount = mysqli_num_rows($tokenquery);
if($tokencount)
        {
            if(isset($_POST['submit']))
            {
            
            $password = $_POST['password'];
            $updatequery = query("update users set password = '$password' where token = '$token'");

            confirm($updatequery);

                if(!confirm($updatequery))
                {
                    
                    $t=16; 
                    function getToken($t) { 
                        $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
                        $random = ''; 
      
                        for ($i = 0; $i < $t; $i++) { 
                        $index1 = rand(0, strlen($char) - 1); 
                        $random .= $char[$index1]; 
                        } 
      
                        return $random; 
                    } 

                    $tok = getToken($t);
                    // saving token to db 
                    $updatequery = query("update users set token = '$tok' where token = '$token'");
                    confirm($updatequery);
                    set_message("password updated Successfully");
                    redirect("login.php");
            
                }
                else
                {
                    set_message("failed to update password ");
                    redirect("login.php");
                }
            }
        }   
else
{
    die("Link Expired Unable to update the password");
    //echo "Link Expired Unable to update the password";
}





 ?>

    <!-- Page Content -->
    <div class="container">

      <header>
            <h1 class="text-center">Login</h1>
       

        <div class="login-wrap">
             <div class="login-html">
                <form class="" action="" method="post" enctype="multipart/form-data">

                    <label for="tab-2" class="tab text-center">New Password</label>
                    
                    
                              
                                <input id="pass" type="password" name="password" class="input form-control" data-type="password">
                           
                                <input type="submit" class="button" name="submit" value="Update Password">
                           
                </form>
            </div>
        </div>
    </header>
</div>
    <!-- /.container -->
    <?php require(TEMPLATE_FRONT . DS . "footer.php") ?>


