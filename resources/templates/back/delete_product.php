<?php  require_once("../../config.php");

if(isset($_GET['id'])){
	
$delete= query("SELECT * FROM products WHERE product_id = " .escape_string($_GET['id']) . "");
confirm($delete);
$row = fetch_array($delete);
$target_path =  UPLOAD_DIRECTORY . DS . $row['product_image'];
unlink($target_path);

$query = query("DELETE FROM products WHERE product_id = " .escape_string($_GET['id']) . "");
confirm($query);

set_message("Product Deleted");

redirect("../../../public/admin/index.php?product");


}else{

redirect("../../../public/admin/index.php?product");


}


 ?>