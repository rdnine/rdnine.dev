<?php

$page_tpl = bo3::load("init.tpl");

include "pages-e/header.php";
include "pages-e/footer.php";
include "pages-e/cta.php";

/* last thing */
$tpl = bo3::c2r([
	"header" => $header,
	"footer" => $footer,

	"section-hello" => bo3::loade("_init/hello/section.tpl"),
	"section-whoami" => bo3::loade("_init/who-am-i/section.tpl"),
	"section-whatido" => bo3::loade("_init/what-i-do/section.tpl"),
	"mdl-cta" => $mdl_cta,
	"section-projects" => bo3::loade("_init/projects/section.tpl"),
	"section-blog" => bo3::loade("_init/blog/section.tpl")
], $page_tpl);
