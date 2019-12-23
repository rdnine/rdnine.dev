<?php
$message_tpl = bo3::mdl_load("templates-e/message.tpl");

$user = new c9_user();

/*FILLS USER INFO ON THE LEFT SIDE MENU - BEGINS*/
$user->setId($id);
$userData = $user->returnOneUser();

if (($userData->rank == "owner" && $authData->rank != "owner") || ($authData->rank != "owner" && $userData->id != $authData->id)) {
	header("Location: {$cfg->system->path_bo}/{$lg_s}/9-users/");
}

if ($userData->rank == "owner") {
	$rank = "Owner";
	$ownerSelected = "selected";
} else if ($userData->rank == "manager") {
	$rank = "Manager";
	$managerSelected = "selected";
} else {
	$rank = "Member";
	$memberSelected = "selected";
}

/*FILLS USER INFO ON THE LEFT SIDE MENU - ENDS*/

/*USER CHANGES - BEGINS*/

if (isset($_POST["save"])) {
	if ($_POST["inputName"] != null || $_POST["inputEmail"] != null || $_POST["inputNewpass"] != null || $_POST["inputConfirm"] != null) {
		if (!isset($_POST["inputStatus"]) || empty($_POST["inputStatus"])) {
			$_POST["inputStatus"] = "0";
		}

		$user->setUsername($_POST["inputName"]);
		$user->setEmail($_POST["inputEmail"]);
		$user->setRank(strtolower($_POST['inputRank']));
		$user->setCode((isset($_POST["info"]) && !empty($_POST["info"])) ? json_encode($_POST["info"], JSON_UNESCAPED_UNICODE) : "");
		$user->setStatus($_POST["inputStatus"]);
		$user->setUserKey($userData->user_key);
		$user->setDate($userData->date);
		$user->setDateUpdate();

		if (isset($_POST["inputNewpass"]) && !empty($_POST["inputNewpass"])) {
			if (isset($_POST["inputConfirm"]) && !empty($_POST["inputConfirm"]) && $_POST["inputConfirm"] == $_POST["inputNewpass"]) {
				$user->setPassword($_POST["inputNewpass"]);
			} else {
				$returnMessage = bo3::c2r([
					"message-type" => "danger",
					"lg-message" => $mdl_lang["edit"]["no-match"]
				], $message_tpl);
			}
		}

		if ($user->update()) {
			$userData = $user->returnOneUser();

			$returnMessage = bo3::c2r([
				"message-type" => "success",
				"lg-message" => $mdl_lang["edit"]["success"]
			], $message_tpl);
		} else {
			$returnMessage = bo3::c2r([
				"message-type" => "danger",
				"lg-message" => $mdl_lang["edit"]["fail"]
			], $message_tpl);
		}
	}
}

if (!empty($userData->code)) {
	$infos = json_decode($userData->code);
}

$fields = c9_user::getFields();

if (!empty($fields)) {
	foreach ($fields as $f => $field) {
		if(!isset($list)) {
			$list = "";
			$item_tpl = bo3::mdl_load("templates-e/edit/item.tpl");
		}

		$field_name = strtolower($field->name);

		$list .= bo3::c2r([
			"name" => strtolower($field->name),
			"lg-name" => $field->name,
			"value" => (isset($infos) && !empty($infos->{$field_name})) ? $infos->{$field_name} : "",
			"ph" => $field->placeholder,
			"required" => ($infos->required) ? "required" : ""
		], $item_tpl);
	}
}

/* USER CHANGES - ENDS */

$mdl_action_list = bo3::c2r([
	"lg-list-btn" => $mdl_lang["list"]["list-btn"],
	"lg-fields-btn" => $mdl_lang["list"]["fields-btn"],
	"lg-add-btn" => $mdl_lang["list"]["add-btn"],
	"lg-add-field-btn" => $mdl_lang["list"]["add-field-btn"],
	"lg-logs-btn" => $mdl_lang["list"]["logs-btn"],
], bo3::mdl_load("templates-e/action-list.tpl"));

$mdl = bo3::c2r([
	"return-message" => (isset($returnMessage)) ? $returnMessage : "",
	"md5-mail" => md5($userData->email),
	"user-id" => $id,
	"lg-check-remove" => $mdl_lang["edit"]["sure"],
	"lg-remove" => $mdl_lang["edit"]["remove"],

	"form" => bo3::c2r([
		"lg-name" => $mdl_lang["edit"]["name"],
		"lg-email" => $mdl_lang["edit"]["email"],
		"lg-newpass" => $mdl_lang["edit"]["new_pass"],
		"lg-confirm" => $mdl_lang["edit"]["confirm"],
		"lg-rank" => $mdl_lang["edit"]["rank"],
		"lg-owner" => $mdl_lang["edit"]["owner"],
		"lg-manager" => $mdl_lang["edit"]["manager"],
		"lg-member" => $mdl_lang["edit"]["member"],
		"lg-code" => $mdl_lang["edit"]["code"],
		"lg-status" => $mdl_lang["edit"]["status"],
		"btn-save" => $mdl_lang["edit"]["save"],
		"lg-check-remove" => $mdl_lang["edit"]["sure"],
		"lg-remove" => $mdl_lang["edit"]["remove"],
		"lg-auth" => $mdl_lang["edit"]["auth"],
		"lg-info" => $mdl_lang["edit"]["info"],

		"owner-selected" => (isset($ownerSelected)) ? $ownerSelected : "",
		"manager-selected" => (isset($managerSelected)) ? $managerSelected : "",
		"member-selected" => (isset($memberSelected)) ? $memberSelected : "",

		"username" => htmlspecialchars($userData->username),
		"email" => htmlspecialchars($userData->email),
		"code" => htmlspecialchars($userData->code),
		"status-checked" => ($userData->status) ? "checked" : "",
		"other-info" => (isset($list)) ? $list : ""
	], bo3::mdl_load("templates-e/edit/form.tpl"))
], bo3::mdl_load("templates/edit.tpl"));

include "pages/module-core.php";
