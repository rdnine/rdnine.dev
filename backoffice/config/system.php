<?php

$cfg->system = new stdClass();

$cfg->system->minify = TRUE;
$cfg->system->pub = FALSE;
$cfg->system->restricted = TRUE;
$cfg->system->timezone = "Europe/Lisbon"; // to disable set with FALSE

$cfg->system->sitename = "Rafael Duarte | Freelance Web Developer";
$cfg->system->owner = "";

$cfg->system->protocol = "https"; // you can use http instead
$cfg->system->domain = "rdnine.dev";
$cfg->system->path = "";
$cfg->system->path_bo = "{$cfg->system->path}/backoffice";
$cfg->system->start = "init";

$cfg->system->version = "3.5.0";
$cfg->system->sub_version = "RC";

$cfg->system->key = "GJTBpKregE9WgXc";

$cfg->system->cookie = "rd_choco_cookie";
$cfg->system->cookie_time = 86400; // 86400 represents 1 day, 60 seconds * 60 minutes * 24 hours.

$cfg->system->analytics = '<script src="https://www.googletagmanager.com/gtag/js?id=UA-107417879-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag(\'js\', new Date());

  gtag(\'config\', \'UA-107417879-1\');
</script>';
