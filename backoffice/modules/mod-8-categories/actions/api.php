<?php

function update ($id) {
	$toReturn = [
		"status" => false,
		"message" => "",
		"object" => []
	];

	$category = new c8_category();
	$category->setId($id);

	$toReturn["status"] = $category->updatePublished();

	return json_encode($toReturn);
}


switch ($_GET["r"]) {
	case 'update':
		$tpl = update($id);
		break;
	default:
		$tpl = "";
		break;
}
