<?php

session_start();
require "../vendor/autoload.php";
require "../routes/web.php";

use App\RMVC\App as App;

App::run();