<?php

$message_tpl = bo3::mdl_load("templates-e/message.tpl");

if (isset($_POST["submit"])) {

	$message = "";

	$user = new c9_user();
	$user->setId($authData->id);

	// Email Confirmation
	if (isset($_POST["email"]) && !empty($_POST["email"])) {
		if ($_POST["email"] == $_POST["checkemail"]) {
			$user->setEmail($_POST["email"]);
			$email_success = true;
		} else {
			$message .= bo3::c2r([
				"lg-message" => $mdl_lang["email"]["check_failure"]
			], $message_tpl);
		}
	} else {
		$user->setEmail($authDat->email);
		$email_success = true;
	}

	// Password Confirmation
	if (!empty($_POST["oldPassword"])) {
		if (c9_user::getSecurePassword($_POST["oldPassword"]) == $authData->password) {
			if(!empty($_POST["newPassword"])) {
				if($_POST["newPassword"] == $_POST["checkPassword"]){
					$user->setPassword($_POST["newPassword"]);
					$pw_success = true;
				}else {
					$message = bo3::c2r([
						"message-type" => "danger",
						"lg-message" => $mdl_lang["password"]["check_pw_failure"]
					], $message_tpl);
				}
			} else {
				$message = bo3::c2r([
					"message-type" => "danger",
					"lg-message" => $mdl_lang["password"]["empty"]
				], $message_tpl);
			}
		} else {
			$message = bo3::c2r([
				"message-type" => "danger",
				"lg-message" => $mdl_lang["password"]["old_pw_failure"]
			], $message_tpl);
		}
	} else {
		$user->setOldPassword($authData->password);
		$pw_success = true;
	}

	//other informations
	if (isset($pw_success) && isset($email_success)) {
		$user->setUsername(
			(isset($_POST["username"]) && !empty($_POST["username"])) ? $_POST["username"] : $authData->username
		);
		$user->setRank($authData->rank);
		$user->setCode(
			(isset($_POST["info"]) && !empty($_POST["info"])) ? json_encode($_POST["info"], JSON_UNESCAPED_UNICODE) : ""
		);
		$user->setStatus($authData->status);
		$user->setUserKey();
		$user->setDate($authData->date);
		$user->setDateUpdate();

		if ($user->update()) {
			$message = bo3::c2r([
				"message-type" => "sucess",
				"lg-message" => $mdl_lang["account"]["success"]
			], $message_tpl);

			$userData = $user->returnOneUser();

			$value = "{$authData->id}.{$userData->password}";

			setcookie (
				$cfg->system->cookie,
				$value,
				time() + (3600 * $cfg->system->cookie_time),
				(!empty($cfg->system->path_bo)) ? $cfg->system->path_bo : "/"
			);
		} else {
			$message = bo3::c2r([
				"message-type" => "danger",
				"lg-message" => sprintf($mdl_lang["account"]["failure"], $cfg->email->support)
			], $message_tpl);
		}

		$mdl = bo3::c2r([
			"content" => $message
		], bo3::mdl_load("templates/result.tpl"));

		header("Refresh:5");
	}
} else {
	$data = new c9_user();
	$data->setId($authData->id);
	$data = $data->returnUserLastLog();

	if (!empty($data)) {
		$ip = json_decode($data->description);
	}

	if (!empty($authData->code)) {
		$code = json_decode($authData->code);
	}

	$fields = c9_user::getFields();

	if (is_array($fields) && count($fields) > 0) {
		foreach ($fields as $f => $field) {
			if(!isset($list)) {
				$list = "";
				$item_tpl = bo3::mdl_load("templates-e/item.tpl");
			}

			$field_name = strtolower($field->name);

			$list .= bo3::c2r([
				"name" => $field->name,
				"lg-name" => $mdl_lang["label"]["{$field_name}"],
				"value" => (isset($code) && !empty($code->{$field_name})) ? $code->{$field_name} : "",
				"ph" => $mdl_lang["placeholder"]["{$field_name}"],
				"required" => ($field->required) ? "required" : ""
			], $item_tpl);
		}
	}

	$mdl = bo3::c2r([
		"return-message" => (isset($message) && !empty($message)) ? $message : null,
		"lg-username" => $mdl_lang["account"]["rank"],
		"username" => $authData->rank,
		"lg-username" => $mdl_lang["account"]["username"],
		"username" => $authData->username,
		"lg-email" => $mdl_lang["account"]["email"],
		"email" => $authData->email,
		"lg-rank" => $mdl_lang["account"]["rank"],
		"rank" => $authData->rank,
		"lg-date" => $mdl_lang["account"]["date"],
		"date" => date('Y-m-d', strtotime($authData->date)),
		"full-date" => $authData->date,
		"lg-password" => $mdl_lang["account"]["password"],
		"lg-email-change" => $mdl_lang["account"]["email_change"],
		"lg-save" => $lang["common"]["save"],
		"lg-cancel" => $lang["common"]["cancel"],
		"lg-login" => $mdl_lang["account"]["login"],
		"ip" => (isset($ip->ip)) ? $ip->ip : "",
		"login-date" => (!empty($data)) ? $data->date : "",
		"md5-email" => md5($authData->email),
		"lg-auth" => $mdl_lang["account"]["auth"],
		"lg-info" => $mdl_lang["account"]["info"],
		"lg-username-change" => $mdl_lang["account"]["username_change"],
		"info-active" => (is_array($fields) && count($fields) > 0) ? "d-block" : "d-none",
		"lg-information-change" => $mdl_lang["account"]["other_info"],

		//placeholders
		"username-ph" => $mdl_lang["placeholder"]["username"],
		"email-ph" => $mdl_lang["placeholder"]["email"],
		"email-confirm-ph" => $mdl_lang["placeholder"]["email-confirm"],
		"address-ph" => $mdl_lang["placeholder"]["address"],
		"company-ph" => $mdl_lang["placeholder"]["company"],
		"phone-ph" => $mdl_lang["placeholder"]["phone"],
		"old-password-ph" => $mdl_lang["placeholder"]["old-password"],
		"password-ph" => $mdl_lang["placeholder"]["password"],
		"password-confirm-ph" => $mdl_lang["placeholder"]["password-confirm"],

		//labels
		"lg-address" => $mdl_lang["label"]["address"],
		"lg-phone" => $mdl_lang["label"]["phone"],
		"lg-company" => $mdl_lang["label"]["company"],

		//custom fields values
		"list" => (isset($list)) ? $list : ""
	], bo3::mdl_load("templates/home.tpl"));
}

include "pages/module-core.php";
