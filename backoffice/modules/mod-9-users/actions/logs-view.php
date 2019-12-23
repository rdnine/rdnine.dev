<?php

if (isset($id) && !empty($id)) {
	$log = new c9_user();
	$log->setId($id);
	$log = $log->returnLog();

	$user = new c9_user();
	$user->setId($log->user_id);
	$user = $user->returnOneUser();

	$ip = json_decode($log->description);

	$details = json_decode(file_get_contents("http://ipinfo.io/{$ip->ip}/json"));

	if (!empty($details)) {
		foreach ($details as $i => $item) {
			if (!isset($list)) {
				$list = "";
				$item_tpl = bo3::mdl_load("templates-e/logs/view.tpl");
			}

			$list .= bo3::c2r([
				"title" => $i,
				"value" => $item
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
		"md5-email" => md5($user->email),
		"username" => $user->username,
		"email" => $user->email,
		"rank" => $user->rank,
		"object" => (isset($list)) ? $list : ""
	], bo3::mdl_load("templates/logs-view.tpl"));
} else {
	header('Location: {$cfg->system->path_bo}/{$lg_s}/9-users/logs/');
}

include "pages/module-core.php";
