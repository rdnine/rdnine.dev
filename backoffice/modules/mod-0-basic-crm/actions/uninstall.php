<?php

if (isset($_POST["submitUninstall"]) && c9_user::isOwner($authData)) {
	$query = bo3::c2r([
		'mod-folder' => $cfg->mdl->folder,
		'prefix' => $cfg->db->prefix
	], bo3::mdl_load("db/uninstall.sql"));

	if ($db->multi_query($query) != FALSE) {
		while ($db->more_results() && $db->next_result()) {;} // flush multi_queries

		/*
			Here you need to send commands to delete those files you copy on install

			unlink("class/class.0-example.php");

			This is mandatory. All copied files need to bee removed during the uninstall.
		*/

		$mdl = bo3::c2r([
			'lg-message' => $lang["uninstall"]["success"]
		], bo3::mdl_load("templates-e/uninstall/message.tpl"));
	} else {
		$mdl = bo3::c2r([
			'lg-message' => $lang["uninstall"]["failure"]." : ".$db->error
		], bo3::mdl_load("templates-e/uninstall/message.tpl"));
	}
} else {
	$mdl = bo3::c2r([
		'lg-message' => $lang["uninstall"]["failure"]
	], bo3::mdl_load("templates-e/uninstall/message.htpl"));
}

include "pages/module-core.php";
