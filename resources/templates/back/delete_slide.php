<?php  require_once("../../config.php");

if(isset($_GET['id'])){
$delete= query("SELECT * FROM slides WHERE slide_id = " .escape_string($_GET['id']) . "");
confirm($delete);
$row = fetch_array($delete);
$target_path =  UPLOAD_DIRECTORY . DS . $row['slide_image'];
unlink($target_path);

$query = query("DELETE FROM slides WHERE slide_id = " .escape_string($_GET['id']) . "");
confirm($query);


set_message("Slide Deleted");

redirect("../../../public/admin/index.php?slides");


}else{

redirect("../../../public/admin/index.php?slides");


}


 ?>