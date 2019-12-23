<?php

$mdl_action_list = bo3::c2r([
	"lg-list-btn" => $mdl_lang["list"]["list-btn"],
	"lg-fields-btn" => $mdl_lang["list"]["fields-btn"],
	"lg-add-btn" => $mdl_lang["list"]["add-btn"],
	"lg-add-field-btn" => $mdl_lang["list"]["add-field-btn"],
	"lg-logs-btn" => $mdl_lang["list"]["logs-btn"],
], bo3::mdl_load("templates-e/action-list.tpl"));

if (isset($_POST["submit"])) {
	if (c9_user::insertField(
		$_POST["name"],
		$_POST["value"],
		$_POST["placeholder"],
		"text",
		$_POST["sort"],
		(isset($_POST["required"])) ? TRUE : FALSE,
		(isset($_POST["status"])) ? TRUE : FALSE
	)) {
		$message = $mdl_lang["fields"]["success"];
		$status = TRUE;
	} else {
		$message = $mdl_lang["fields"]["Failure"];
		$status = FALSE;
	}

	$mdl = bo3::c2r([
		"content" => $message,
		"back-list" => $mdl_lang["result"]["back-list"],
		"new-user" => $mdl_lang["result"]["new-user"],
		"edit-mode" => $mdl_lang["result"]["edit-mode"],
		"add-active" => $a != "add" ? "d-none" : "",
		"edit-active" => $a != "edit" ? "d-none" : "",
		"status" => ($status == TRUE) ? "success" : "danger"
	], bo3::mdl_load("templates/result.tpl"));

	header("Refresh:5; url={$cfg->system->path_bo}/{$lg_s}/9-users/fields/");

} else {

	$mdl = bo3::c2r([
		"name" => $mdl_lang["fields"]["name"],
		"value" => $mdl_lang["fields"]["value"],
		"placeholder" => $mdl_lang["fields"]["placeholder"],
		"type" => $mdl_lang["fields"]["type"],
		"required" => $mdl_lang["fields"]["required"],
		"sort" => $mdl_lang["fields"]["sort"],
		"status" => $mdl_lang["fields"]["status"],
		"but-submit" => $mdl_lang["fields"]["but-submit"]
	], bo3::mdl_load("templates/fields-add.tpl"));
}


include "pages/module-core.php";
