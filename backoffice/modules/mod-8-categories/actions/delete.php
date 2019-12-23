<?php

	if(isset($id) && !empty($id)) {

		// Return all category info
		$category_obj = new c8_category();
		$category_obj->setId($id);
		$category_result = $category_obj->returnNrChildsCategory();
		$textToPrint = null;

		if (isset($_POST["submit"])) {
			if($category_result->nr_sub_cats == 0) {
				if($category_obj->delete()) {
					$textToPrint = $mdl_lang["delete"]["success"];
					$status = TRUE;
				} else {
					$textToPrint =  $mdl_lang["delete"]["failure"];
					$status = FALSE;
				}
			} else {
				$textToPrint = $mdl_lang["delete"]["failure-2"];
			}

			$mdl = bo3::c2r([
				"content" => $textToPrint,
				"add-active" => $a != "add" ? "d-none" : "",
				"edit-active" => $a != "edit" ? "d-none" : "",
				"back-list" => $mdl_lang["result"]["back-list"],
				"new-article" => $mdl_lang["result"]["new-category"],
				"edit-mode" => $mdl_lang["result"]["edit-mode"],
				"status" => ($status == TRUE) ? "success" : "danger"
			], bo3::mdl_load("templates/result.tpl"));

		} else {
			$category_obj->setLangId($lg);
			$category_info = $category_obj->returnOneCategory();

			$rel_checker = c8_category::checkRel($id);

			$textToPrint = bo3::c2r(
				[
					"id" => $id,

					"phrase" => ($rel_checker != FALSE && $rel_checker > 0) ? $mdl_lang["delete"]["phrase-rel"] : $mdl_lang["delete"]["phrase"],
					"items" => ($rel_checker != FALSE && $rel_checker > 0) ? $rel_checker : "0",
					"title" => $category_info->title,

					"del" => $mdl_lang["delete"]["button-del"],
					"cancel" => $mdl_lang["delete"]["button-cancel"]
				],
				bo3::mdl_load("templates-e/del/form.tpl")
			);

			$mdl = bo3::c2r(["content" => $textToPrint], bo3::mdl_load("templates/del.tpl"));
		}
	} else {
		// if doesn't exist an action response, system sent you to 404
		header("Location: {$cfg->system->path_bo}/0/{$lg_s}/404/");
	}

include "pages/module-core.php";
