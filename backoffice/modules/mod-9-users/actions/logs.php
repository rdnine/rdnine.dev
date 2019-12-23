<?php

$logs = new c9_user();
$logs = $logs->returnLogs();

if (!empty($logs)) {
	foreach ($logs as $i => $log) {
		if (!isset($logs_list)) {
			$logs_list = "";
			$item_tpl = bo3::mdl_load("templates-e/logs/item.tpl");
		}

		$description = json_decode($log->description);

		$logs_list .= bo3::c2r([
			"id" => $log->id,
			"user" => $log->user_id,
			"ip" => $description->ip,
			"date" => $log->date
		], $item_tpl);
	}
}

$mdl_action_list = bo3::c2r([
	"lg-list-btn" => $mdl_lang["list"]["list-btn"],
	"lg-fields-btn" => $mdl_lang["list"]["fields-btn"],
	"lg-add-btn" => $mdl_lang["list"]["add-btn"],
	"lg-add-field-btn" => $mdl_lang["list"]["add-field-btn"],
	"lg-logs-btn" => $mdl_lang["list"]["logs-btn"],
], bo3::mdl_load("templates-e/action-list.tpl"));

$mdl = bo3::c2r([
	"lg-user" => $mdl_lang["logs"]["user"],
	"lg-ip" => $mdl_lang["logs"]["ip"],
	"lg-date" => $mdl_lang["logs"]["date"],
	"lg-actions" => $mdl_lang["logs"]["actions"],
	"list" => (isset($logs_list)) ? $logs_list : "",

	"but-view" => $mdl_lang["logs"]["but-view"]
], bo3::mdl_load("templates/logs.tpl"));

include "pages/module-core.php";
