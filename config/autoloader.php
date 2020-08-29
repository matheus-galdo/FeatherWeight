<?php

use App\Config\Database;
use App\Config\TwigConfig;

header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('America/Sao_Paulo');



$db = new Database();
$twig = new TwigConfig();


