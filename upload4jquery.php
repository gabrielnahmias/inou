<?php
include "foto_upload_script.php";

session_start();

$foto_upload = new Foto_upload;	

//$json['size'] = $_POST['MAX_FILE_SIZE'];
$json['img'] = '';

$dir = "img/users/{$_SESSION['uid']}";

$foto_upload->upload_dir = $dir;
$foto_upload->foto_folder = $dir;
//$foto_upload->thumb_folder = $_SERVER['DOCUMENT_ROOT']."/upload/thumb/";
$foto_upload->extensions = array(".jpg", ".gif", ".png");
$foto_upload->language = "en";
$foto_upload->x_max_size = 480;
$foto_upload->y_max_size = 360;
//$foto_upload->x_max_thumb_size = 120;
//$foto_upload->y_max_thumb_size = 120;

$foto_upload->the_temp_file = $_FILES['ufile']['tmp_name'];
$foto_upload->the_file = $_FILES['ufile']['name'];
$foto_upload->http_error = $_FILES['ufile']['error'];
$foto_upload->rename_file = true; 

rename("$dir/main.jpg", "$dir/".rand().rand().rand().".jpg"); // TEMPORARY FIX.. need to cycle through all photos and make sure this name doesnt exist

/*if ($foto_upload->upload("main.jpg")) {
	$foto_upload->process_image(false, true, true, 80);
	$json['img'] = $foto_upload->file_copy;
}*/

move_uploaded_file($foto_upload->the_temp_file, "$dir/main.jpg") or die("Fuck, didn't upload.");

sleep(1); // just for loading gif

$json['error'] = strip_tags($foto_upload->show_error_string());
echo json_encode($json);
?>