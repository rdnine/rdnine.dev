<?php

if (!isset($_POST["save"])) {
	$nav_tpl = bo3::mdl_load("templates-e/add/nav-tab-item.tpl");
	$nav_content_tpl = bo3::mdl_load("templates-e/add/tab-content-item-input.tpl");
	$option_item_tpl = bo3::mdl_load("templates-e/add/option-item.tpl");
	$tabs = null;
	$nav_content = null;

	$i = 0;
	foreach ($cfg->lg as $index => $lg) {
		if ($lg[0]) {
			$tabs .= bo3::c2r([
				'class' => ($i == 0 ? "show active" : null),
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
				'placeholder-name' => $mdl_lang["label"]["placeholder-name"],
				'placeholder-text' => $mdl_lang["label"]["placeholder-description"],
				"lang-name" => $lg[2]
			], $nav_content_tpl);
			$i++;
		}
	}

	/*------------------------------------------*/

	function recursiveWayGet($id, $i = 0, &$data = []) {
		$a = new c8_category();
		$a->setLangId(1);
		$a->setParentId($id);
		$a = $a->returnChildCategories();

		foreach ($a as $item) {
			$tmp = [];
			$tmp["id"] = $item->id;
			$tmp["title"] = $item->title;
			$tmp["level"] = $i;

			$data[] = $tmp;

			if ($item->nr_sub_cats > 0) {
				recursiveWayGet($item->id, $i+1, $data);
			}
		}
	}

	recursiveWayGet(-1, 0, $data);

	if (!empty($data)) {
		foreach ($data as $item) {
			if (!isset($parent_options)) {
				$parent_options = "";
			}

			$parent_options .= bo3::c2r([
				'option-id' => $item["id"],
				'option' => sprintf("%s> %s", str_repeat("-", $item["level"]), $item["title"])
			], $option_item_tpl);
		}
	}

	/*------------------------------------------*/

	$category_type_options = null;

	$category_types = new c8_category();
	$category_types = $category_types->returnAllSections();

	foreach ($category_types as $item) {
		$category_type_options .= bo3::c2r([
			"option-id" => $item->category_section,
			"option" => ""
		], $option_item_tpl);
	}

	$mdl = bo3::c2r([
		'tabs-categories-name-description' => bo3::c2r( [
			'nav-tabs-items' => $tabs,
			'tab-content-items' => $nav_content
		], bo3::mdl_load("templates-e/add/tabs.tpl")),
		'type' => $mdl_lang["label"]["type"],
		'select-option-type' => $mdl_lang["form"]["option-type"],
		'category-type-options' => $category_type_options,
		'parent' => $mdl_lang["label"]["parent"],
		'select-option-parent' => $mdl_lang["form"]["option-parent"],
		'select-option-parent-no' => $mdl_lang["form"]["option-parent-no"],
		'parent-options' => (isset($parent_options)) ? $parent_options : "",
		'date' => $mdl_lang["label"]["date"],
		'date-placeholder' => $mdl_lang["form"]["date-placeholder"],
		'date-value' => date("Y-m-d H:i:s"),
		'code' => $mdl_lang["label"]["code"],
		'code-placeholder' => $mdl_lang["label"]["code-placeholder"],
		'sort' => $mdl_lang["label"]["sort"],
		'sort-placeholder' => $mdl_lang["label"]["sort-placeholder"],
		'published' => $mdl_lang["label"]["published"],
		'but-submit' => $mdl_lang["label"]["but-submit"]
	], bo3::mdl_load("templates/add.tpl"));
} else {
	$category = new c8_category();

	$category->setContent($_POST["name"], $_POST["content"], $_POST["meta-keywords"], $_POST["meta-description"]);
	$category->setCategorySection($_POST["category-type"]);
	$category->setParentId(isset($_POST["category-parent"]) ? $_POST["category-parent"] : '-1');
	$category->setCode($_POST["code"]);
	$category->setDate($_POST["date"]);
	$category->setDateUpdate();
	$category->setSort($_POST["sort"]);
	$category->setPublished(isset($_POST["published"]) ? $_POST["published"] : 0);
	$category->setUserId($authData->id);

	$textToPrint = "";

	if ($category->insert()) {
		$textToPrint = $mdl_lang["add"]["success"];
		$status = TRUE;

		$obj = $category->returnObject();
		if(!empty($_POST["files-fallback"])) {
			$file = new c4_file();
			$file->fallback($obj['id'], $_POST["files-fallback"]);
		}
	} else {
		$textToPrint = $mdl_lang["add"]["failure"];
		$status = FALSE;
	}

	$mdl = bo3::c2r([
		"content" => (isset($textToPrint)) ? $textToPrint : "",
		"back-list" => $mdl_lang["result"]["back-list"],
		"new-article" => $mdl_lang["result"]["new-category"],
		"edit-mode" => $mdl_lang["result"]["edit-mode"],
		"add-active" => $a != "add" ? "d-none" : "",
		"edit-active" => $a != "edit" ? "d-none" : "",
		"status" => ($status == TRUE) ? "success" : "danger"
	], bo3::mdl_load("templates/result.tpl"));
}

bo3::importPlg ("files", ["module" => "category"]);

include "pages/module-core.php";
