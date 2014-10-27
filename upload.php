<?php
$fn = (isset(getallheaders()['X_FILENAME']) ? getallheaders()['X_FILENAME'] : false);

// print_r($_SERVER);
// print_r(getallheaders()['X_FILENAME']);
// echo "ok";
// die();
if ($fn) {

	// AJAX call
	file_put_contents(
		'uploads/' . $fn,
		file_get_contents('php://input')
	);
	echo "$fn uploaded";
	exit();
	
}else {

	// form submit
	$files = $_FILES['fileselect'];

	foreach ($files['error'] as $id => $err) {
		if ($err == UPLOAD_ERR_OK) {
			$fn = $files['name'][$id];
			move_uploaded_file(
				$files['tmp_name'][$id],
				'uploads/' . $fn
			);
			echo "<p>File $fn uploaded.</p>";
		}
	}

}