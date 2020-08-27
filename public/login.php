<?php require_once("../resources/config.php");
// if (isset($_POST['reset_pass'])) {
//         $email = $_POST["reset_email"];

//         $emailquery = query("select * from users where email = '$email' ");
//         confirm($emailquery);

//         $emailcount = mysqli_num_rows($emailquery);

//         if($emailcount)
//         {
//             $userdata = fetch_array($emailquery);

//             $token = $userdata['token'];

//             $subject = "Password reset";
//             $body = "http://localhost/ecommerce/public/recover_password.php?token=$token";
//              $header = "From:pkkapoor5109@gmail.com \r\n";
//          $header .= "MIME-Version: 1.0\r\n";
//          $header .= "Content-type: text/html\r\n";



//                 if(mail($email , $subject , $body , $header))
//                 {
//                     //redirect('login.html');
//                     set_message("Password reset link has been successfully sent to mail.");
//                     redirect("login.php");
//                 }
//                 else
//                 {
//                     set_message("Email sending failed ....");
//                     redirect("login.php");
//                 }


//         }
//         else
//         {
//             echo "No user found registered with this email ";
//         }

//     }
if (isset($_POST['sign_up'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pass = $_POST['passwords'];
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
    $query = query("INSERT INTO users(username,email,phone,password,token) VALUES('{$name}', '{$email}', '{$phone}', '{$pass}', '{$tok}') ");
    confirm($query);
    if(!confirm($query)){
        redirect("login.php");
    }
    else{
        set_message("Username already registered");
    }
}

if(isset($_POST['submit'])){
   $username = $_POST['username'];
   $password = $_POST['password'];
   $query_login = query("SELECT username,password FROM users WHERE username = '{$username}' AND password = '{$password}' ");
   confirm($query_login);
   $row=fetch_array($query_login);

   if(mysqli_num_rows($query_login) == 0){
        set_message("Incorrect Username and Password!");

        
   }
   else
   {
        $_SESSION['username']=$row['username'];
        redirect("index.php");
        
    }




}

 require(TEMPLATE_FRONT . DS . "header.php"); ?>

    <!-- Page Content -->
    <div class="container">

      <header>
            <h1 class="text-center">Login</h1>
            <?php
                 if(isset($_SESSION['message'])){
            ?>
                <h2 class="text-center alert alert-warning" role="alert"><?php echo ($_SESSION['message']); ?></h2>
                <?php 
                unset($_SESSION['message']);

            }?>
        <div class="login-wrap">
             <div class="login-html">
                <form class="" action="" method="post" enctype="multipart/form-data">
                
                    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
                    <input id="tab-2" type="radio" name="tab" class="for-pwd"><label for="tab-2" class="tab">Sign Up</label>
                    <div class="login-form">
                        <div class="sign-in-htm">
                            <div class="group">
                                <label for="user" class="label">Username or Email</label>
                                <input id="user" type="text" class="input form-control" name="username"  autocomplete="off">
                            </div>
                            <div class="group">
                                <label for="pass" class="label">Password</label>
                                <input id="pass" type="password" name="password" class="input form-control" data-type="password">
                            </div>
                            <div class="group">
                                <input type="submit" class="button" name="submit" value="Sign In">
                            </div>
                            <div class="hr"></div>
                        </div>
                        <div class="for-pwd-htm">
                            <div class="group">
                                <label for="user" class="label">UserName</label>
                                <input id="username" name = "name" type="name" class="input">
                            </div>
                             <div class="group">
                                <label for="user" class="label">Email</label>
                                <input id="useremail" name = "email" type="email" class="input">
                            </div>
                            <div class="group">
                                <label for="user" class="label">Phone</label>
                                <input id="userpone" name = "phone" type="phone" class="input">
                            </div>
                             <div class="group">
                                <label for="pass" class="label">Password</label>
                                <input id="password" type="password" name="passwords" class="input form-control">
                            </div>
                           
                            <div class="group">
                                <input type="submit" name = "sign_up" class="button" value="Sign Up">
                            </div>
                            <div class="hr"></div>
                        </div>

                        
                    </div>

                </form>

            </div>
        </div>
    </header>
</div>
    <!-- /.container -->
    <?php require(TEMPLATE_FRONT . DS . "footer.php"); ?>


