<?php
require_once('../private/OAuth2/Autoloader.php');
OAuth2\Autoloader::register();

require_once '../private/constants.php';
spl_autoload_register(function($strClassName){include "../private/web/$strClassName.php";});
