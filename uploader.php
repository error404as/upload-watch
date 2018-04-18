<?php

// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif','zip');
$U_DIR = 'my_uploads';

$PATH = getcwd();
$host = $GLOBALS['SERVER_NAME'];
$PATH = 'http://' . substr($PATH, strpos($PATH, $host)) . '/' . $U_DIR . '/';


if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
	$fname = $_FILES['upl']['name'];
	$extension = pathinfo($fname, PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error"}';
		exit;
	}

	// Using: timestamp_filaname.extansion
	$new_name = date("U") . '_' . pathinfo($fname, PATHINFO_FILENAME) . '.' . pathinfo($fname, PATHINFO_EXTENSION);

	if(!is_dir($U_DIR)){ mkdir($U_DIR); }
	if(move_uploaded_file($_FILES['upl']['tmp_name'], $U_DIR.'/'.$new_name)){
		echo '{"status":"success","file": "'.$PATH.$new_name.'" }';
		exit;
	}
}

echo '{"status":"error"}';
exit;