<?php

function clean($string) {
	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	$string =  str_replace('--', '-', $string);
	return preg_replace('/[^A-Za-z0-9.\-]/', '', $string); // Removes special chars.
}

function upload($post, $files = []) {
	global $auth, $authData;

	$toReturn = [
		"status" => false,
		"message" => "",
		"object" => []
	];

	$clean_file_name = clean($files["name"]);
	$clean_file_name = date("Y-m-d-H-i-s-").$clean_file_name;
	$newFilePath = "../uploads/{$clean_file_name}";

	if (move_uploaded_file($files["tmp_name"], $newFilePath)) {
		$extension = pathinfo($files['name'], PATHINFO_EXTENSION);

		$file = new c4_file();
		$file->setFile($clean_file_name);
		$file->setType((!in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'svg'])) ? 'doc' : 'img');
		$file->setModule((isset($post["module"])) ? $post["module"] : "");
		$file->setIdAss((isset($post["id"])) ? $post["id"] : "");
		$file->setDescription("");
		$file->setSort(0);
		$file->setUserId($authData->id);

		$file->setDate();

		if ($file->insert()) {
			$toReturn["status"] = true;
			array_push($toReturn["object"], $file->returnObject());
		}
	}

	return json_encode($toReturn);
}

function getList ($id, $module) {
	$toReturn = [
		"status" => false,
		"message" => "",
		"object" => []
	];

	$file = new c4_file();
	$file->setIdAss($id);
	$file->setModule($module);
	$toReturn["object"] = $file->returnFilterList();

	if (!empty($toReturn["object"])) {
		if (is_array($toReturn["object"]) && count($toReturn["object"]) > 0) {
			$toReturn["status"] = true;
		}
	}

	return json_encode($toReturn);
}

function update ($id, $post) {
	$toReturn = [
		"status" => false,
		"message" => "",
		"object" => []
	];

	$file = new c4_file();
	$file->setId($id);
	$file->setDescription($post["description"]);
	$file->setCode($post["code"]);
	$file->setSort($post["sort"]);

	$toReturn["status"] = $file->simpleUpdate();

	return json_encode($toReturn);
}

function delete ($id) {
	$toReturn = [
		"status" => false,
		"message" => "",
		"object" => []
	];

	$file = new c4_file();
	$file->setId($id);
	$toReturn["status"] = $file->delete();

	return json_encode($toReturn);
}

function restricted ($a) {
	$file_path = "../uploads/restricted/{$a}";

	if (file_exists($filename)) {
		$file_name = basename($file_path);

		if (@is_array(getimagesize($file_path)) && !isset($_GET["download"])) {
			header("Content-Type: " . mime_content_type($file_path));
			header("Content-Length: " . filesize($file_path));

			$file = @fopen($file_path, "rb");
			fpassthru($file);
		} else {
			header("Content-Type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"$file_name\"");
			header("Pragma: public");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

			$file = @fopen($file_path, "rb");

			while (!feof($file)) {
				print(@fread($file, 1024 * 8));
				ob_flush();
				flush();
			}
		}
		exit();
	} else {
		$tpl = "File does not exist! Sorry m8!";
	}

	return isset($tpl) ? $tpl : "";
}

switch ($_GET["r"]) {
	case 'upload':
		$tpl = upload( $_POST, isset($_FILES["file"]) ? $_FILES["file"] : []);
		break;
	case 'getList':
		$tpl = getList($id, $_GET["module"]);
		break;
	case 'update':
		$tpl = update($id, $_POST);
		break;
	case 'delete':
		$tpl = delete($id);
		break;
	case 'restricted':
		$tpl = restricted($a);
		break;
	default:
		$tpl = "";
		break;
}
