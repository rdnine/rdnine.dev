<?php

$item_tpl = bo3::mdl_load("templates-e/home/item.tpl");

$file = new c4_file();
$files = $file->returnFiles("TRUE");

if(!empty($files)) {
	foreach ($files as $index => $file) {
		if (!isset($list)) {
			$list = "";
		}

		$list .= bo3::c2r([
			"id" => $file->id,
			"file" => $file->file,
			"module" => $file->module,
			"id-ass" => $file->id_ass,
			"sort" => $file->sort,
			"date-update" => $file->date_update,
		], $item_tpl);
	}
}

$mdl = bo3::c2r([
	"lg-id" => $mdl_lang["title"]["id"],
	"lg-file" => $mdl_lang["title"]["file"],
	"lg-module" => $mdl_lang["title"]["module"],
	"lg-id-ass" => $mdl_lang["title"]["id-ass"],
	"lg-sort" => $mdl_lang["title"]["sort"],
	"lg-date" => $mdl_lang["title"]["date"],
	"list" => (isset($list)) ? $list : ""
], bo3::mdl_load("templates/home.tpl"));

bo3::importPlg ("files", []);

include "pages/module-core.php";
