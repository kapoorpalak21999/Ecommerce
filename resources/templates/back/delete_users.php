<?php  require_once("../../config.php");

if(isset($_GET['id'])){
$delete= query("SELECT * FROM users WHERE user_id = " .escape_string($_GET['id']) . "");
confirm($delete);
$row = fetch_array($delete);
$target_path =  UPLOAD_DIRECTORY . DS . $row['user_photo'];
unlink($target_path);

$query = query("DELETE FROM users WHERE user_id = " .escape_string($_GET['id']) . "");
confirm($query);

set_message("User Deleted");

redirect("../../../public/admin/index.php?users");


}else{

redirect("../../../public/admin/index.php?users");


}


 ?>