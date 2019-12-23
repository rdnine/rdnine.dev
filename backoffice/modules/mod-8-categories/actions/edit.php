<?php

if (!isset($_POST["save"])) {
	if (isset($id) && !empty($id)) {

		$nav_tpl = bo3::mdl_load("templates-e/edit/nav-tab-item.tpl");
		$nav_content_tpl = bo3::mdl_load("templates-e/edit/tab-content-item-input.tpl");
		$option_item_tpl = bo3::mdl_load("templates-e/edit/option-item.tpl");
		$tabs = null;
		$nav_content = null;

		// Return all category info
		$category_obj = new c8_category();
		$category_obj->setId($id);
		$category_result = $category_obj->returnOneCategoryAllLanguages();

		$i = 0;

		foreach ($cfg->lg as $index => $lg) {
			if ($lg[0]) {
				$tabs .= bo3::c2r([
					'class' => ($i == 0) ? "active" : null,
					'nr' => $index,
					'lang-name' => $lg[2]
				], $nav_tpl);

				$nav_content .= bo3::c2r([
					'class' => ($i == 0 ? "show active" : null),
					'nr' => $index,
					'label-name' => $mdl_lang["label"]["name"],
					'label-content' => $mdl_lang["label"]["content"],
					'label-meta-keywords' => $mdl_lang["label"]["meta-keywords"],
					'label-meta-description' => $mdl_lang["label"]["meta-description"],
					'place-holder-name' => "",
					'place-holder-text' => "",

					'name-value' => htmlspecialchars($category_result[$index]->title),
					'content-value' => $category_result[$index]->text,
					'meta-keywords-value' => $category_result[$index]->{"meta-keywords"},
					'meta-description-value' => $category_result[$index]->{"meta-description"}
				], $nav_content_tpl);
				$i++;
			}
		}

		$category = new c8_category();
		$category->setLangId(1);
		$category = $category->returnAllCategories();

		/*------------------------------------------*/

		function recursiveWayGet($id, $i){
			global $parent_options, $option_item_tpl, $category_result;

			$a = new c8_category();
			$a->setLangId(1);
			$a->setParentId($id);
			$a = $a->returnChildCategories();
			$i++;

			foreach ($a as $item) {
				if ($item->id != $id) {
					$parent_options .= bo3::c2r([
						'option-id' => $item->id,
						'option' => sprintf("%s> %s", str_repeat("-", $i), $item->title),
						'selected' => $item->id == $category_result[1]->parent_id ? "selected" : ""
					], $option_item_tpl);
				}

				if ($item->nr_sub_cats > 0) {
					recursiveWayGet($item->id, $i);
				}
			}
		}

		$mainCategories = new c8_category();
		$mainCategories->setLangId(1);
		$allCats = $mainCategories->returnAllMainCategories();

		$parent_options = '';
		foreach ($allCats as $item) {
			if ($item->id != $id) {
				$parent_options .= bo3::c2r([
					'option-id' => $item->id,
					'option' => $item->title,
					'selected' => $item->id == $category_result[1]->parent_id ? "selected" : ""
				], $option_item_tpl);
			}
			recursiveWayGet($item->id, 0);
		}

		/*------------------------------------------*/

		$category_type_options = '';

		$category_types = new c8_category();
		$category_types = $category_types->returnAllSections();

		foreach ($category_types as $item) {

			$category_type_options .= bo3::c2r([
				'option-id' => $item->category_section,
				'option' => ""
			], $option_item_tpl);
		}

		$mdl = bo3::c2r([
			'tabs-categories-name-description' => bo3::c2r([
				'nav-tabs-items' => $tabs,
				'tab-content-items' => $nav_content
			], bo3::mdl_load("templates-e/edit/tabs.tpl")),
			'type' => $mdl_lang["label"]["type"],
			'select-option-type' => $mdl_lang["form"]["option-type"],
			'category-type-options' => $category_type_options,
			'type-value' => $category_result[1]->category_section,
			'parent' => $mdl_lang["label"]["parent"],
			'select-option-parent' => $mdl_lang["form"]["option-parent"],
			'select-option-parent-no' => $mdl_lang["form"]["option-parent-no"],
			'selected' => $category_result[1]->parent_id == -1 ? "selected" : "",
			'parent-options' => $parent_options,
			'date' => $mdl_lang["label"]["date"],
			'date-placeholder' => $mdl_lang["form"]["date-placeholder"],
			'date-value' => $category_result[1]->date,
			'code' => $mdl_lang["label"]["code"],
			'code-placeholder' => $mdl_lang["label"]["code-placeholder"],
			'code-value' => $category_result[1]->code,
			'sort' => $mdl_lang["label"]["sort"],
			'sort-placeholder' => $mdl_lang["label"]["sort-placeholder"],
			'sort-value' => $category_result[1]->sort,
			'published' => $mdl_lang["label"]["published"],
			'published-checked' => $category_result[1]->published ? "checked" : '',
			'but-submit' => $mdl_lang["label"]["but-submit"]
			// 'content' => bo3::c2r([], bo3::mdl_load("templates-e/edit/form.tpl"))
		], bo3::mdl_load("templates/edit.tpl"));
	} else {
		// if doesn't exist an action response, system sent you to 404
		header("Location: {$cfg->system->path_bo}/0/{$lg_s}/404/");
	}
} else {

	$category = new c8_category();

	$category->setId($id);
	$category->setContent($_POST["name"], $_POST["content"], $_POST["meta-keywords"], $_POST["meta-description"]);
	$category->setCategorySection($_POST["category-type"]);
	$category->setParentId(isset($_POST["category-parent"]) ? $_POST["category-parent"] : '-1');
	$category->setCode($_POST["code"]);
	$category->setDate($_POST["date"]);
	$category->setDateUpdate();
	$category->setSort($_POST["sort"]);
	$category->setPublished(isset($_POST["published"]) ? $_POST["published"] : 0);

	$textToPrint = '';
	if ($category->update()) {
		$textToPrint = $mdl_lang["edit"]["success"];
		$status = TRUE;
	} else {
		$textToPrint = $mdl_lang["edit"]["failure"];
		$status = FALSE;
	}

	$mdl = bo3::c2r([
		"content" => (isset($textToPrint)) ? $textToPrint : "",
		"back-list" => $mdl_lang["result"]["back-list"],
		"new-article" => $mdl_lang["result"]["new-category"],
		"edit-mode" => $mdl_lang["result"]["edit-mode"],
		"add-active" => $a != "add" ? "d-none" : "",
		"edit-active" => $a != "edit" ? "d-none" : "",
		"id" => $id,
		"status" => ($status == TRUE) ? "success" : "danger"
	], bo3::mdl_load("templates/result.tpl"));
}

bo3::importPlg ("files", ["id" => $id, "module" => "category"]);

include "pages/module-core.php";
