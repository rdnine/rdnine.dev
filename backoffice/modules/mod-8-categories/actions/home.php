<?php

$cat_obj = new c8_category();
$cat_obj->setLangId($lg);
$categories = $cat_obj->returnAllMainCategories();

foreach ($categories as $category) {
	if (!isset($list)) {
		$list = "";
		$item_tpl = bo3::mdl_load("templates-e/home/item.tpl");
	}

	$list .= bo3::c2r([
		'id' => $category->id,
		'title' => $category->title,
		'category-section' => $category->category_section,
		'parent-nr' => $category->nr_sub_cats,
		'published' => ($category->published) ? "checked=\"true\"" : "",
		'sort' => $category->sort,
		'date' => $category->date,
		'date-updated' => $category->date_update,

		'but-view' => $mdl_lang["label"]["but-view"],
		'hide-but' => $category->nr_sub_cats > 0 ? null : "d-none",
		'show-but' => $category->nr_sub_cats == 0 ? null : "d-none",
		'but-edit' => $mdl_lang["label"]["but-edit"],
		'but-delete' => $mdl_lang["label"]["but-delete"]
	], $item_tpl);
}

if (!isset($list)) {
	$message = bo3::c2r(["message" => $mdl_lang["message"]["empty"]], bo3::mdl_load("templates/message.tpl"));
}

$mdl_action_list = bo3::c2r([
	"label-add-category" => $mdl_lang["label"]["add-category"]
], bo3::mdl_load("templates-e/action-list.tpl"));

$mdl = bo3::c2r([
	'lg-id' => $mdl_lang["label"]["id"],
	'lg-name' => $mdl_lang["label"]["name"],
	'lg-section' => $mdl_lang["label"]["type"],
	'lg-parent-nr' => $mdl_lang["label"]["parent-nr"],
	'lg-published' => $mdl_lang["label"]["published"],
	'lg-sort' => $mdl_lang["label"]["sort"],
	'lg-date' => $mdl_lang["label"]["date"],
	'lg-date-updated-label' => $mdl_lang["label"]["date-updated"],

	'list' => isset($list) ? $list : $message
], bo3::mdl_load("templates/home.tpl"));

include "pages/module-core.php";
