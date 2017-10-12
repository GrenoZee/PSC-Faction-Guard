<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-16");

include_once '../../private/api/init_api.php';
$objFacGuard = new CFacGuard();
$objFacGuard->GetMissionList(file_get_contents("php://input"));