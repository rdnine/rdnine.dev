<?php

$query = sprintf(
	"SELECT * FROM %s_0_companies WHERE true",
	$cfg->db->prefix
);

$source = $db->query($query);

while ($data = $source->fetch_object()) {
	if (!isset($list)) {
		$list = "";
		$line_tpl = bo3::mdl_load("templates-e/home/line.tpl");
		$user =  new c9_user();
	}

	$user->setId($data->user_id);
	$this_user = $user->returnOneUser();
	$this_district = c0_basic_crm::getDisctrictById($data->district_id);
	// bo3::dump($user->returnOneUser()); break;

	$list .= bo3::c2r([
		"comercial-name" => $data->comercial_name,
		"email" => $data->email,
		"district" => isset($this_district->name) ? $this_district->name : $data->district_id,
		"date" => date("Y-m-d", strtotime($data->date)),
		"account" => $this_user->username
	], $line_tpl);
}

$mdl = bo3::c2r([
	"lg-name" => $mdl_lang["titles"]["name"],
	"lg-email" => $mdl_lang["titles"]["email"],
	"lg-district" => $mdl_lang["titles"]["district"],
	"lg-date" => $mdl_lang["titles"]["date"],
	"lg-status" => $mdl_lang["titles"]["status"],
	"lg-account" => $mdl_lang["titles"]["account"],

	"list" => isset($list) ? $list : ""
], bo3::mdl_load("templates/home.tpl"));

/*
	bellow you can see an example for breadcrumb.
	only add it just if you want update breadcrumb.
	we don't recommend to usi
*/
$breadcrumb = [
	["name" => "Add", "link" => "{c2r-path-bo}/{c2r-lg}/{c2r-module-folder}/add/"]
];

/*
	You need to put c2r for import works like: {c2r-plg-example}
	bo3::importPlg("example");
*/

include "pages/module-core.php";
