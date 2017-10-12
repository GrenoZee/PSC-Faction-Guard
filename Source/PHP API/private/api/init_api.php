<?php
include '../../private/Constants.php';
spl_autoload_register(function($strClassName){include "../../private/api/$strClassName.php";});
