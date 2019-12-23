<?php

	if (isset($id) && !empty($id)) {
		// Return all category info
		$article = new c7_article();
		$article->setId($id);
		$toReturn = "";

		if (isset($_POST["submit"])) {
			if ($article->delete()) {
				$toReturn = $mdl_lang["delete"]["success"];
				$status = TRUE;
			} else {
				$toReturn =  $mdl_lang["delete"]["failure"];
				$status = FALSE;
			}

			$mdl = bo3::c2r([
				"content" => $toReturn,
				"add-active" => $a != "add" ? "d-none" : "",
				"edit-active" => $a != "edit" ? "d-none" : "",
				"back-list" => $mdl_lang["result"]["back-list"],
				"new-article" => $mdl_lang["result"]["new-article"],
				"edit-mode" => $mdl_lang["result"]["edit-mode"],
				"status" => ($status == TRUE) ? "success" : "danger"
			], bo3::mdl_load("templates/result.tpl"));

		} else {
			$article->setLangId($lg);
			$article = $article->returnOneArticle();

			$toReturn = bo3::c2r(
				[
					"id" => $id,

					"phrase" => $mdl_lang["delete"]["phrase"],
					"title" => $article->title,

					"del" => $mdl_lang["delete"]["button-del"],
					"cancel" => $mdl_lang["delete"]["button-cancel"]
				],
				bo3::mdl_load("templates-e/delete/form.tpl")
			);

			$mdl = bo3::c2r(["content" => $toReturn], bo3::mdl_load("templates/del.tpl"));
		}

	} else {
		// if doesn't exist an action response, system sent you to 404
		header("Location: {$cfg->system->path_bo}/0/{$lg_s}/404/");
	}

include "pages/module-core.php";
