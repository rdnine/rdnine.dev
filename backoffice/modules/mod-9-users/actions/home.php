<?php
/*----------------------------------------------------- FETCHING USER DATA FROM DATABASE - BEGINS -----------------------------------------------------*/

$user = new c9_user();

$user_list = $user->returnAllUsers();
if (count($user_list) != 0) {
	foreach ($user_list as $user) {
		if (!isset($list)) {
			$list = "";
			$item_tpl = bo3::mdl_load("templates-e/home/item.tpl");
		}

		$list .= bo3::c2r([
			"lg-username-title" => $mdl_lang["list"]["username-title"],
			"lg-email-title" => $mdl_lang["list"]["email-title"],
			"lg-rank-title" => $mdl_lang["list"]["rank-title"],
			"lg-status-title" => $mdl_lang["list"]["status-title"],
			"lg-date-title" => $mdl_lang["list"]["date-title"],

			"user-id" => $user->id,
			"md5-mail" => md5($user->email),
			"username" => $user->username,
			"email" => $user->email,
			"rank" => $user->rank,
			"access" => (($user->rank == "owner" && $authData->rank != "owner") || ($authData->rank != "owner" && $user->id != $authData->id)) ? "disabled" : "",
			"active" => (!$user->status) ? "unactive" : "",

			"status" => $user->status ? "Active" : "Inactive",
			"status-label" => $user->status ? 'success' : 'secondary',

			"date" => $user->date
		], $item_tpl);
	}
}

/*----------------------------------------------------- FETCHING USER DATA FROM DATABASE - ENDS	 -----------------------------------------------------*/

$mdl_action_list = bo3::c2r([
	"lg-list-btn" => $mdl_lang["list"]["list-btn"],
	"lg-fields-btn" => $mdl_lang["list"]["fields-btn"],
	"lg-add-btn" => $mdl_lang["list"]["add-btn"],
	"lg-add-field-btn" => $mdl_lang["list"]["add-field-btn"],
	"lg-logs-btn" => $mdl_lang["list"]["logs-btn"],
], bo3::mdl_load("templates-e/action-list.tpl"));

$mdl = bo3::c2r([
	"lg-gravatar-title" => $mdl_lang["list"]["gravatar-title"],
	"lg-username-title" => $mdl_lang["list"]["username-title"],
	"lg-email-title" => $mdl_lang["list"]["email-title"],
	"lg-rank-title" => $mdl_lang["list"]["rank-title"],
	"lg-status-title" => $mdl_lang["list"]["status-title"],
	"lg-date-title" => $mdl_lang["list"]["date-title"],
	"lg-action-title" => $mdl_lang["list"]["action-title"],
	"lg-edit" => $mdl_lang["list"]["edit"],

	"list" => (isset($list)) ? $list : "",
], bo3::mdl_load("templates/home.tpl"));

include "pages/module-core.php";
