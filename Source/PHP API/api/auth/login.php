<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../private/api/init_api.php';
$objFacGuard = new CFacGuard();
$objFacGuard->Login(file_get_contents("php://input"));
