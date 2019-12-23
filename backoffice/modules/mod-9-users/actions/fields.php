<?php

$fields = c9_user::getAllFields();

if (!empty($fields)) {
	foreach ($fields as $i => $item) {
		if (!isset($list)) {
			$list = "";
			$item_tpl = bo3::mdl_load("templates-e/fields/item.tpl");
		}

		$list .= bo3::c2r([
			"id" => $item->id,
			"name" => $item->name,
			"value" => $item->value,
			"placeholder" => $item->placeholder,
			"required" => ($item->required) ? "check" : "times",
			"sort" => $item->sort,
			"status" => ($item->status) ? "check" : "times",
			"date-created" => $item->date,
			"date" => $item->date_update,
			"but-edit" => $mdl_lang["fields"]["but-edit"],
			"but-delete" => $mdl_lang["fields"]["but-delete"]
		], $item_tpl);
	}
}

if (!isset($list)) {
	$message = bo3::c2r(["message" => $mdl_lang["message"]["empty"]], bo3::mdl_load("templates/message.tpl"));
}

$mdl_action_list = bo3::c2r([
	"lg-list-btn" => $mdl_lang["list"]["list-btn"],
	"lg-fields-btn" => $mdl_lang["list"]["fields-btn"],
	"lg-add-btn" => $mdl_lang["list"]["add-btn"],
	"lg-add-field-btn" => $mdl_lang["list"]["add-field-btn"],
	"lg-logs-btn" => $mdl_lang["list"]["logs-btn"],
], bo3::mdl_load("templates-e/action-list.tpl"));

$mdl = bo3::c2r([
	"add-field" => $mdl_lang["fields"]["add"],
	"name" => $mdl_lang["fields"]["name"],
	"value" => $mdl_lang["fields"]["value"],
	"placeholder" => $mdl_lang["fields"]["placeholder"],
	"type" => $mdl_lang["fields"]["type"],
	"required" => $mdl_lang["fields"]["required"],
	"sort" => $mdl_lang["fields"]["sort"],
	"status" => $mdl_lang["fields"]["status"],
	"date" => $mdl_lang["fields"]["date"],
	"list" => (isset($list)) ? $list : $message
], bo3::mdl_load("templates/fields.tpl"));

include "pages/module-core.php";
