<?php require_once("../resources/config.php"); 
 ;

$username=$_SESSION['username'];

$sqluser = query("SELECT * FROM users where username = '$username' ");  
confirm($sqluser);
$data = mysqli_fetch_array($sqluser);



if(isset($_POST['update']))
{
    $user    =  $_POST['username'];
    $email   =  $_POST['email'];
    $phone   =  $_POST['phone'];
    $filename = $_FILES['file']['name'];
    $image =  $_FILES['file']['tmp_name'];
    $target_path = $_SESSION['profilepic'];
    
    if(empty($filename))
    {

        $destinationprofile = $target_path;
    } 
    else{
        $destinationprofile =  $filename;
        $un="../resources/upload/".$target_path;
        if($target_path!= 'user.png')
        {
         unlink($un);
        }
    }   

    $sql="UPDATE users SET user_photo = '{$destinationprofile}', username = '{$user}',  email = '{$email}', phone = '{$phone}' WHERE username = '{$username}';";
    
     if(mysqli_query($connection,$sql))
     { 
        move_uploaded_file($image, "../resources/upload/" . $filename);
        $_SESSION['profilepic']= $destinationprofile;
        $_SESSION['username'] = $user;
        redirect("update.php");

     }
     else
     {
        set_message("USERNAME ALREADY EXIST");
     }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    

    
    <link rel="stylesheet" href="css/styles.css">

  
   
 </head>
 
<body>
 <?php   require(TEMPLATE_FRONT . DS . "header.php") ; ?>

    <div >
         <?php
            if(isset($_SESSION['message'])){
        ?>
            <h2 class="text-center alert alert-warning" role="alert"><?php echo $_SESSION['message']; ?></h2>
        <?php 
            unset($_SESSION['message']);

        }?>

        <!-- Sign up form -->
        <section class="signup">
            <div class="container" style="background-color: #fff;">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Update Profile</h2>
                        <form method="post" action=""  enctype="multipart/form-data"  class="register-form" id="register-form" onsubmit="return Validate()" name = "vform" >
                            <div class="input-group mb-3"  id = "uprofile">
                              <div class="input-group-prepend">
                              </div>
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01" name="file" onchange="return ValidateFileUpload()" >
                                Choose Profile Picture
                                
                              </div>
                              <div id="profile_error"></div>
                            </div>
                             <img src="" id="blah" height="100" width="200">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            </div>
                            <div class="form-group" id="update_username">
                                <label for="name"><i class="zmdi zmdi-account-o material-icons-name"></i></label>
                                <input type="text" name="username" id="name" value="<?php  echo $data['username'] ;?>">
                                <div id="upusername"></div>
                            </div>
                          
                            <div class="form-group" id="update_email">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email"  id="email" name ="email" value="<?php  echo $data['email'] ;?>">
                                <div id="uemail"></div>
                            </div>
                           

                        
                            <div class="form-group" id = "update_phone">
                                <label for="num"><i class="zmdi zmdi-phone"></i></label>
                                <input type="number" name="phone" id="phone" value="<?php  echo $data['phone'] ;?>">
                                <div id="uphone"></div>
                            </div>
                            
                          
                            <div class="form-group form-button">
                                <input type="submit" name="update" id="update" class="form-submit" value="Update Profile"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="../resources/upload/<?php echo $_SESSION['profilepic']; ?>" height=300 width = 300 alt="sing up image"></figure>
                    </div>
                </div>
            </div>
        </section>

       
    </div>

    <!-- JS -->
    <script src="jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
<script type="text/JavaScript">
var username = document.forms['vform']['username'];
var email = document.forms['vform']['email'];
var phone = document.forms['vform']['phone'];

var username_error = document.getElementById('upusername');

var phone_error = document.getElementById('uphone');
var email_error = document.getElementById('uemail');

var profile_error = document.getElementById('profile_error');



// SETTING ALL EVENT LISTENERS
username.addEventListener('blur', usernameVerify, true);
email.addEventListener('blur', emailVerify, true);
phone.addEventListener('blur', phoneVerify, true);


// validation function
function ValidateFileUpload() {
    var fuData = document.getElementById('inputGroupFile01');
    var FileUploadPath = fuData.value;
    var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

    if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") 
    {
      profile_error.textContent = "";
        if (fuData.files && fuData.files[0]) 
        {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(fuData.files[0]);
        }

    } 

    else 
    {
        document.getElementById('uprofile').style.color = "red";
        profile_error.textContent = "Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ";
        return false;

    }
}











function Validate() {
  
  // validate username
  if (username.value == "") {
    username.style.border = "1px solid red";
    document.getElementById('update_username').style.color = "red";
    username_error.textContent = "Username is required";
    username.focus();
    return false;
  }
  if (username.value.length < 3) {
    username.style.border = "1px solid red";
    document.getElementById('update_username').style.color = "red";
    username_error.textContent = "Username must be at least 3 characters";
    username.focus();
    return false;
  }
  var letters = /^[0-9a-zA-Z_@]+$/;
  if(!username.value.match(letters))
  {
  document.getElementById('update_username').style.color = "red";
  username_error.textContent ='Username must have alphabet and numbers only';
  username.focus();
  return false;
  }
  if(email.value == "") {
    email.style.border = "1px solid red";
    document.getElementById('update_email').style.color = "red";
    email_error.textContent = "Email is required";
    email.focus();
    return false;
  }
  if(phone.value == "") {
    phone.style.border = "1px solid red";
    document.getElementById('update_phone').style.color = "red";
    phone_error.textContent = "Phone is required";
    phone.focus();
    return false;
  }
  if(phone.value.length < 10 || phone.value.length > 10)
  {
  document.getElementById('update_phone').style.color = "red";
  phone_error.textContent ='Invalid Phone Number';
  phone.focus();
  return false;
  }
  var myphone = /^[0-9]+$/;
  if(!phone.value.match(myphone))
  {
  document.getElementById('update_phone').style.color = "red";
  phone_error.textContent ='Invalid Phone Number';
  phone.focus();
  return false;
  }
  if(address.value == "") {
    address.style.border = "1px solid red";
    document.getElementById('update_address').style.color = "red";
    address_error.textContent = "Address is required";
    address.focus();
    return false;
  }

}
function usernameVerify() {
  if (username.value != "") {
   username.style.border = "1px solid blue";
   document.getElementById('update_username').style.color = "#5e6e66";
   username_error.innerHTML = "";
   return true;
  }
}

function emailVerify() {
  if (email.value != "") {
    email.style.border = "1px solid blue";
    document.getElementById('update_email').style.color = "#5e6e66";
    email_error.innerHTML = "";
    return true;
  }
}
function nameVerify() {
  if (fullname.value != "") {
   fullname.style.border = "1px solid blue";
   document.getElementById('update_name').style.color = "#5e6e66";
   name_error.innerHTML = "";
   return true;
  }
}
function phoneVerify() {
  if (phone.value != "") {
   phone.style.border = "1px solid blue";
   document.getElementById('update_phone').style.color = "#5e6e66";
   phone_error.innerHTML = "";
   return true;
  }
}

</script>