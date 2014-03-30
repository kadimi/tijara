<?php

require "vendor/scssphp/scss.inc.php";

$scss = new scssc();
// $scss->setFormatter("scss_formatter_compressed");
$scss->setImportPaths("css/scss/main/");

$server = new scss_server("css/scss", null, $scss);
$server->serve();
