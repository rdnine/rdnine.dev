<?php

$page_tpl = bo3::load("init.tpl");

include "pages-e/header.php";
include "pages-e/footer.php";

/* last thing */
$tpl = bo3::c2r([
	"header" => $header,
	"footer" => $footer,

	"section-hello" => bo3::loade("_init/#hello/section.tpl"),
	"section-whoami" => bo3::loade("_init/#who-am-i/section.tpl")
], $page_tpl);
