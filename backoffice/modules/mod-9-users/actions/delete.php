<?php
	if (isset($id) && !empty($id)) {

		$mdl_action_list = bo3::c2r([
			"lg-list-btn" => $mdl_lang["list"]["list-btn"],
			"lg-fields-btn" => $mdl_lang["list"]["fields-btn"],
			"lg-add-btn" => $mdl_lang["list"]["add-btn"],
			"lg-add-field-btn" => $mdl_lang["list"]["add-field-btn"],
			"lg-logs-btn" => $mdl_lang["list"]["logs-btn"],
		], bo3::mdl_load("templates-e/action-list.tpl"));

		if ($authData["rank"] == "owner") {
			$user = new c9_user();
			$user->setId($id);
			$toReturn = "";

			if (isset($_POST["submit"])) {
				$checker = c9_user::returnNumOfUsers();

				if($checker > 1) {
					if ($user->delete()) {
						$toReturn = $mdl_lang["delete"]["success"];
						$status = TRUE;
					} else {
						$toReturn =  $mdl_lang["delete"]["failure"];
						$status = FALSE;
					}
				} else  {
					$toReturn =  $mdl_lang["delete"]["failure-2"];
				}

				$mdl = bo3::c2r([
					"content" => $toReturn,
					"back-list" => $mdl_lang["result"]["back-list"],
					"new-user" => $mdl_lang["result"]["new-user"],
					"edit-mode" => $mdl_lang["result"]["edit-mode"],
					"add-active" => $a != "add" ? "d-none" : "",
					"edit-active" => $a != "edit" ? "d-none" : "",
					"status" => ($status == TRUE) ? "success" : "danger"
				], bo3::mdl_load("templates/result.tpl"));
			} else {

				$user = $user->returnOneUser();

				$toReturn = bo3::c2r([
					"id" => $id,

					"phrase" => ($authData["id"] != $id) ? $mdl_lang["delete"]["phrase"] : $mdl_lang["delete"]["phrase-self"] ,
					"name" => $user->username,

					"del" => $mdl_lang["delete"]["button-del"],
					"cancel" => $mdl_lang["delete"]["button-cancel"]
				], bo3::mdl_load("templates-e/delete/form.tpl"));
				$mdl = bo3::c2r(["content" => $toReturn], bo3::mdl_load("templates/del.tpl"));
			}

		} else {
			$status = FALSE;

			$mdl = bo3::c2r([
				"content" => $mdl_lang["access"]["no-permission"],
				"back-list" => $mdl_lang["result"]["back-list"],
				"new-user" => $mdl_lang["result"]["new-user"],
				"edit-mode" => $mdl_lang["result"]["edit-mode"],
				"add-active" => $a != "add" ? "d-none" : "",
				"edit-active" => $a != "edit" ? "d-none" : "",
				"status" => ($status == TRUE) ? "success" : "danger"
			], bo3::mdl_load("templates/result.tpl"));
		}

	} else {
		// if doesn't exist an action response, system sent you to 404
		header("Location: {$cfg->system->path_bo}/0/{$lg_s}/404/");
	}

include "pages/module-core.php";
