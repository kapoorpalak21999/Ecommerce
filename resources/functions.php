<?php
$upload ="upload";
function last_id(){
global $connection;
return mysqli_insert_id($connection);

}

function set_message($msg){
    if(!empty($msg)){
        $_SESSION['message']=$msg;
    }else{
        $msg = "";
    }

}

// function display_message(){
//     if(isset($_SESSION['message'])){
//         echo ($_SESSION['message']);
//         unset($_SESSION['message']);
//     }
// }

function redirect($location){
	header("Location: $location ");
}

function query($sql){
	global $connection;
	return mysqli_query($connection,$sql);
}

function confirm($result){
    global $connection;
	if(!$result){
        die("Query Failed ".mysqli_error($connection));
                		}
}

function escape_string($string){
	global $connection;
	return mysqli_real_escape_string($connection,$string);
}
 
function fetch_array($result){
	return mysqli_fetch_array($result);
}

/**************************************FRONT END FUNCTIONS****************************/
//get products
function get_products(){
$fetch=query("SELECT * FROM products");
confirm($fetch);
while($row=fetch_array($fetch)){
$product_image= display_image($row['product_image']);
$product = <<<DELIMITER
<div class="col-sm-4 col-lg-4 col-md-4 place">
<div class="thumbnail prod" >
    <a href="item.php?id={$row['product_id']}"><img style="height:200px" src="../resources/{$product_image}" width="320px" height="140px" alt=""></a>
    <div class="caption">

        <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
        </h4>
        <h4 class="text-center">Rs.{$row['product_price']}</h4>
        <p>{$row['short_desc']}</p>
        <div class="text-center">
        <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add To Cart</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
        </div>
    </div>

</div>
</div>
DELIMITER;

echo $product;
	}
}

function get_categories(){

$query=query("SELECT * FROM categories");
confirm($query);
while($row=fetch_array($query)){
    // echo "<li class='list-group-item'><a href='category.html'>".$row['cat_title']."</a></li>";
    if ($row['cat_title'] == "Electronics") {
        $class = "glyphicon glyphicon-headphones";
    }
    else if ($row['cat_title'] == "Mobile") {
        $class = "glyphicon glyphicon-phone";
    }
    else if ($row['cat_title'] == "Furniture") {
        $class = "glyphicon glyphicon-bed";
    }
     else if ($row['cat_title'] == "Sunglasses") {
        $class ="glyphicon glyphicon-sunglasses";
    }
    else if ($row['cat_title'] == "TV") {
        $class ="glyphicon glyphicon-blackboard";
    }
    else if ($row['cat_title'] == "Home Decor") {
        $class ="glyphicon glyphicon-tree-conifer";
    }
    else{
        $class = "glyphicon glyphicon-home";
    }

$category_links = <<<DELIMITER
        
<a href='category.php?id={$row['cat_id']}' style = "text-decoration:none;"><li class='list-group-item'><span class="{$class}"></span>&nbsp;{$row['cat_title']}</li></a>

DELIMITER;
echo $category_links;


    }




}

function get_products_in_cat_page(){
$fetch=query("SELECT * FROM products WHERE product_category_id=" .escape_string($_GET['id']) . " ");
confirm($fetch);
while($row=fetch_array($fetch)){
$product_image= display_image($row['product_image']);

$product = <<<DELIMITER
<div class="col-md-3 col-sm-6">
<div class="thumbnail prod">
<a href="item.php?id={$row['product_id']}"><img style="height:200px" src="../resources/{$product_image}" width="320px" height="120px" alt=""></a>
<div class="caption">

<h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
</h4>
<h4 class="text-center">Rs.{$row['product_price']}</h4>
<p>{$row['short_desc']}</p>
<p>
<a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
</p>
</div>
</div>
</div>

DELIMITER;

echo $product;
    }
}
function get_products_in_shop_page(){
$fetch=query("SELECT * FROM products");
confirm($fetch);
while($row=fetch_array($fetch)){
    $product_image= display_image($row['product_image']);
$product = <<<DELIMITER
<div class="col-md-3 col-sm-6 ">            
<div class="thumbnail prod">
<a href="item.php?id={$row['product_id']}"><img style="height:200px" src="../resources/{$product_image}" width="320px" height="120px" alt=""></a>
<div class="caption">
<h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
</h4>
<h4 class="text-center">Rs.{$row['product_price']}</h4>
<p>{$row['short_desc']}</p>
<a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add To Cart</a>
<a class="btn btn-info" target="_blank" href="item.php?id={$row['product_id']}">More Info</a>
</div>


</div>
</div>
DELIMITER;

echo $product;
    }
}



function welcome_message(){
     $tool= $_SESSION['email'];
     $subject = "Congratulations Order Placed";
     $message = "We Are Glad To Welcome You On Our Platform...Happy Shopping";
     $header = "From:pkkapoor5109@gmail.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";

     $result= mail($tool,$subject,$message,$header);
     if($result)
     {
        foreach ($_SESSION as $name => $value) 
        {
            if($value>0)
            {
                if(substr($name, 0, 8)=="product_"){
                $length = strlen($name);
                $id = substr($name,8,$length);
                unset($_SESSION['product_'.$id]);

                }
            }
        }
        unset($_SESSION['item_total']);
        unset($_SESSION['item_quantity']);
        unset($_SESSION['billaddress']);

     }
     else
     {
       set_message("Order Not Placed SENT");
       redirect("contact.php"); 
     }
    }

function send_message(){
    if(isset($_POST['submit'])){
     $tool= "kapoorpalak21999@gmail.com";
     $from_name= $_POST['name'];
     $subject = $_POST['subject'];
     $email = $_POST['email'];
     $message = $_POST['message'];
     $header = "From:pkkapoor5109@gmail.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";

     $result= mail($tool,$subject,$message,$header);
     if(!$result){
       set_message("Sorry Message could not be sent");
       redirect("contact.php");


     }else{
       set_message("SENT");
       redirect("contact.php"); 
     }
    }
}

       
/***************************************BACK END FUNCTIONS********************************/



function display_orders(){
$query =query("SELECT * FROM orders");
confirm($query);
$c=0;
while ($row = fetch_array($query)) {
    $c++;
$orders = <<<DELIMITER

<tr>
<td>{$c}</td>
<td>{$row['order_id']}</td>
<td>{$row['order_amount']}</td>
<td>{$row['order_transaction']}</td>
<td>{$row['order_currency']}</td>
<td>{$row['order_status']}</td>
<td><a class="btn btn-danger image_container" href="../../resources/templates/back/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-trash"></span></a></td>
</tr>



DELIMITER;
echo $orders;

}

    
}
/***************** Admin products ************************/

function display_image($picture){
global $upload;
return $upload . DS . $picture;



} 


function get_products_in_admin(){
$fetch=query("SELECT * FROM products");
confirm($fetch);
$c=0;
while($row=fetch_array($fetch)){
    $c++;
$category = get_categories_title($row['product_category_id']);
$product_image= display_image($row['product_image']);
$product = <<<DELIMITER
<tr>
<td>{$c}</td>
<td>{$row['product_id']}</td>
<td>{$row['product_title']} <br>

  <a href="index.php?edit_product&id={$row['product_id']}"><img id="i" src="../../resources/{$product_image}" width='100px' height='120px' alt=""></a>
</td>
<td>{$category}</td>
<td>{$row['product_price']}</td>
<td>{$row['product_quantity']}</td>
<td><a class="btn btn-primary" href="index.php?edit_product&id={$row['product_id']}"><span class="glyphicon glyphicon-edit"></span></a><a class="btn btn-danger image_container" href="../../resources/templates/back/delete_product.php?id={$row['product_id']}"><span class="glyphicon glyphicon-trash"></span></a></td>
</tr>
      

DELIMITER;

echo $product;
    }
}


function get_categories_title($product_category_id){

$category_query = query("SELECT * FROM categories WHERE cat_id = {$product_category_id} " );
confirm($category_query);

while ($category_row = fetch_array($category_query)) {
    return $category_row['cat_title'];



}



}







/*********************** Add Product *******/
 
function add_product(){

if(isset($_POST['publish'])){
$title        =  escape_string($_POST['product_title']);
$price        =  escape_string($_POST['product_price']);
$description  =  escape_string($_POST['product_description']);
$category_id  =  escape_string($_POST['product_category_id']);
$short_desc   =  escape_string($_POST['short_desc']);
$quantity     =  escape_string($_POST['product_quantity']);
$image        =  $_FILES['file']['name'];
$image_temp   =  $_FILES['file']['tmp_name'];

move_uploaded_file($image_temp, UPLOAD_DIRECTORY . DS . $image);

$query=query("INSERT INTO products(product_title,
   product_category_id, product_price, product_quantity, product_description, short_desc, product_image) VALUES('{$title}', '{$category_id}', '{$price}', '{$quantity}', '{$description}', '{$short_desc}', '{$image}')");

$last_id=last_id();
confirm($query);
set_message("{$title} Product Inserted");
redirect("index.php?product");



}





}

function show_categories_add_products(){

$query=query("SELECT * FROM categories");
confirm($query);
while($row=fetch_array($query)){
    // echo "<li class='list-group-item'><a href='category.html'>".$row['cat_title']."</a></li>";
$category_options = <<<DELIMITER
        
     <option value="{$row['cat_id']}">{$row['cat_title']}</option>
DELIMITER;
echo $category_options;


    }




}

/************************ Edit Product *********/

function edit_product(){

if(isset($_POST['update'])){
$title        =  escape_string($_POST['product_title']);
$price        =  escape_string($_POST['product_price']);
$description  =  escape_string($_POST['product_description']);
$category_id  = escape_string($_POST['product_category_id']);
$short_desc   =  escape_string($_POST['short_desc']);
$quantity     =  escape_string($_POST['product_quantity']);
$image        =  $_FILES['file']['name'];
$image_temp   =  $_FILES['file']['tmp_name'];


if(empty($image)){


$get_pic = query("SELECT product_image FROM products WHERE product_id = " . escape_string($_GET['id']). " ");
confirm($get_pic);

while($pic = fetch_array($get_pic)){

$image = $pic['product_image'];
}

}

move_uploaded_file($image_temp, UPLOAD_DIRECTORY . DS . $image);

$query  = "UPDATE products SET ";
$query .= "product_title        = '{$title}', ";
$query .= "product_category_id  = '{$category_id}', "; 
$query .= "product_price        = '{$price}', ";
$query .= "product_quantity     = '{$quantity}', ";
$query .= "product_description  = '{$description}', "; 
$query .= "short_desc           = '{$short_desc}', ";
$query .= "product_image        = '{$image}' ";
$query .=  "WHERE product_id = " . escape_string($_GET['id']);

$send= query($query);
confirm($send);
set_message("Product Updated");
redirect("index.php?product");



}

}

/***********************Categories in admin ****/

function show_categories_in_admin(){
$category_query = query("SELECT * FROM categories");
confirm($category_query);
$c=0;
while($row =fetch_array($category_query)){
$c++;
$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];
$category = <<<DELIMITER
<tr>
<td>{$c}</td>
<td>{$cat_id}</td>
<td>{$cat_title}</td>
<td><a class="btn btn-danger image_container" href="../../resources/templates/back/delete_category.php?id={$cat_id}"><span class="glyphicon glyphicon-trash"></span></a></td>
</tr>
DELIMITER;
echo $category;

}


}

function add_categories(){
if(isset($_POST['add_category'])){
$category_title =$_POST['cat_title'];
if(empty($category_title)){
    set_message("Enter Category");
    redirect("index.php?categories");
}
else{
$insert_query = query("INSERT INTO categories(cat_title) VALUES('{$category_title}') ");
confirm($insert_query);
set_message("Category Inserted");
redirect("index.php?categories");
}
}


}

/********* admin users ****************/


function show_users_in_admin(){
$category_query = query("SELECT * FROM users");
confirm($category_query);
while($row =fetch_array($category_query)){
$user_id = $row['user_id'];
$username = $row['username'];
$email = $row['email'];
$product_image= display_image($row['user_photo']);
$user = <<<DELIMITER
<tr>

<td>{$user_id}</td>
<td>{$username}<br>
<a href="index.php?edit_user&id={$row['user_id']}"><img id="i" src="../../resources/{$product_image}" width='100px' height='120px' alt="photo"></a>
</td>
<td>{$email}</td>
<td><a class="btn btn-primary" href="index.php?edit_user&id={$row['user_id']}"><span class="glyphicon glyphicon-edit"></span></a><a class="btn btn-danger image_container" href="../../resources/templates/back/delete_users.php?id={$user_id}"><span class="glyphicon glyphicon-trash"></span></a></td>
</tr>
DELIMITER;
echo $user;

}


}
function add_user(){
if(isset($_POST['add'])){
$username =escape_string($_POST['username']);
$email    =escape_string($_POST['email']);
$password =md5(escape_string($_POST['password']));
$confirm  =md5(escape_string($_POST['confirm']));
$user_photo = $_FILES['file']['name'];
$photo_temp = $_FILES['file']['tmp_name'];


move_uploaded_file($photo_temp, UPLOAD_DIRECTORY . DS . $user_photo);
if($password !== $confirm){
        set_message("Password Not Matched");
        redirect("index.php?add_user");

}else{
        $insert_query = query("INSERT INTO users(username,email,password,user_photo) VALUES('{$username}', '{$email}', '{$password}', '{$user_photo}' )");
        confirm($insert_query);
        set_message("User Inserted");
        redirect("index.php?users");
        }
    }
}

function edit_user(){

if(isset($_POST['update'])){
$username    =  escape_string($_POST['username']);
$email       =  escape_string($_POST['email']);
$password =md5(escape_string($_POST['password']));
$confirm  =md5(escape_string($_POST['confirm']));
$image        =  $_FILES['file']['name'];
$image_temp   =  $_FILES['file']['tmp_name'];


if(empty($image)){


$get_pic = query("SELECT user_photo FROM users WHERE user_id = " . escape_string($_GET['id']). " ");
confirm($get_pic);

while($pic = fetch_array($get_pic)){

$image = $pic['user_photo'];
}

}

move_uploaded_file($image_temp, UPLOAD_DIRECTORY . DS . $image);

if($password !== $confirm){
set_message("Password Not Matched");
redirect("index.php?edit_user&id={$_GET['id']}");

}
else{
$query  = "UPDATE users SET ";
$query .= "username        = '{$username}', ";
$query .= "email           = '{$email}', "; 
$query .= "password        = '{$password}', ";
$query .= "user_photo   = '{$image}' ";
$query .=  "WHERE user_id = " . escape_string($_GET['id']);

$send= query($query);
confirm($send);
set_message("User Updated");
redirect("index.php?users");

}

}

}

function get_reports_in_admin(){
$fetch=query("SELECT * FROM reports");
confirm($fetch);
$c=0;
while($row=fetch_array($fetch)){
    $order = query("SELECT * FROM orders WHERE  order_id = {$row['order_id']}");
    confirm($order);
    $row_order = fetch_array($order);
    $address = query("SELECT * FROM address WHERE address_id = {$row_order['address_id']}");
    confirm($address);
    $row_add = fetch_array($address);

$c++;
$report = <<<DELIMITER
<tr>
<td>{$c}</td>


<td>{$row['order_id']}</td>
<td>{$row['product_title']}</td>
<td>{$row['product_id']}</td>
<td>Rs.{$row['product_price']}</td>
<td>{$row['product_quantity']}</td>
<td>{$row_add['address']}</td>
<td><a class="btn btn-danger image_container" href="../../resources/templates/back/delete_report.php?id={$row['report_id']}"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;<a class="btn btn-success " href="view_address.php?id={$row_add['address_id']}"><span class="glyphicon glyphicon-eye-open">&nbsp;View Address</span></a></td>
</tr>
      

DELIMITER;

echo $report;
    }
}

/*************** Slides Function ******************/

function add_slide(){

if(isset($_POST['add_slide'])){
$slide_title = escape_string($_POST['slide_title']);
$slide_image = $_FILES['file']['name'];
$slide_loc = $_FILES['file']['tmp_name'];

move_uploaded_file($slide_loc, UPLOAD_DIRECTORY . DS . $slide_image);

$insert_slide = query("INSERT INTO slides(slide_title, slide_image) VALUES('{$slide_title}', '{$slide_image}')");
confirm($insert_slide);
set_message("Slide Added");
redirect("index.php?slides");
}

}

function get_current_slide(){

$query= query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
confirm($query);

while($row = fetch_array($query)){
$slide_image = display_image($row['slide_image']);

$slide_active= <<<DELIMITER

<img id="current" class="img-responsive" src="../../resources/{$slide_image}" alt="">

DELIMITER;
echo $slide_active;

}
}
function get_active_slide(){

$query= query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
confirm($query);

while($row = fetch_array($query)){
$slide_image = display_image($row['slide_image']);

$slide_active= <<<DELIMITER
<div class="item active">
<img id="active" class="slide-image" src="../resources/{$slide_image}" alt="">
</div>
DELIMITER;
echo $slide_active;
}
}


function get_slides(){

$query= query("SELECT * FROM slides ORDER BY slide_id ASC LIMIT 5");
confirm($query);

while($row = fetch_array($query)){
$slide_image = display_image($row['slide_image']);

$slides= <<<DELIMITER
<div class="item">
<img id="slide" class="slide-image" src="../resources/{$slide_image}" width ='800px' height='300px' alt="">
</div>
DELIMITER;
echo $slides;

}
}


function get_slide_thumbnail(){

$query= query("SELECT * FROM slides ORDER BY slide_id ASC");
confirm($query);

while($row = fetch_array($query)){
$slide_image = display_image($row['slide_image']);

$slides= <<<DELIMITER
<div class="col-md-3 col-xs-6" >
<div class="caption text-center">
<h4>{$row['slide_title']}</h4>

</div>
<a href="">
<img class="slide-image " src="../../resources/{$slide_image}" alt="">
</a> 
<div>
<a class="btn btn-danger" href="../../resources/templates/back/delete_slide.php?id={$row['slide_id']}"><span class="glyphicon glyphicon-trash"></span></a> 
</div>
</div>
DELIMITER;
echo $slides;

}

}

function display_orders_in_admin_content(){
$query =query("SELECT * FROM orders");
confirm($query);
while ($row = fetch_array($query)) {
$orders = <<<DELIMITER

<tr>
    <td>{$row['order_id']}</td>
    <td>{$row['order_amount']}</td>
    <td>{$row['order_transaction']}</td>
    <td>{$row['order_currency']}</td>
    <td>{$row['order_status']}</td>
    
</tr>



DELIMITER;
echo $orders;
}

    
}

function get_reports_in_admin_content(){
$fetch=query("SELECT * FROM reports");
confirm($fetch);
while($row=fetch_array($fetch)){
$report = <<<DELIMITER
<tr>
<td>{$row['report_id']}</td>
<td>{$row['product_id']}</td>
<td>{$row['order_id']}</td>
<td>{$row['product_title']}</td>
<td>Rs.{$row['product_price']}</td>
<td>{$row['product_quantity']}</td>
</tr>
      

DELIMITER;

echo $report;
    }
}

function get_category_count(){
$fetch=query("SELECT * FROM categories");
confirm($fetch);
$row_count = mysqli_num_rows($fetch);
$_SESSION['row_categories']=$row_count;
}

function get_product_count(){
$fetch=query("SELECT * FROM products");
confirm($fetch);
$row_product = mysqli_num_rows($fetch);
$_SESSION['row_count']=$row_product;
}

function get_orders_count(){
$fetch=query("SELECT * FROM orders");
confirm($fetch);
$row_order = mysqli_num_rows($fetch);
$_SESSION['row_orders']=$row_order;
}

?>



