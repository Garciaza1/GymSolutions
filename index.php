<?php

require_once("vendor/autoload.php");

use GymSolution\System\Router;

session_start();

Router::dispatch();