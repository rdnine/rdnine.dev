<?php

$page_e_tpl = bo3::loade("footer.tpl");

/* last thing */
$footer = bo3::c2r(["year" => date('Y', time())], $page_e_tpl);
