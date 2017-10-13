<?php
class CFacGuard {
	private
		$objDB;

	//--------------------
	public function __construct() {
		//TODO - Set $objDB to database connection and login
	}
	
	//--------------------
	public function GetMissionList($strRequest) {
		$objRequest = $this->ParseRequest($strRequest);
		
		if (is_null($objRequest))
			return ;
	}

	//--------------------
	public function Login($strRequest) {
		$objRequest = $this->ParseRequest($strRequest);
		
		if (is_null($objRequest))
			return ;
	}

	//--------------------
	protected function ParseRequest($strRequest) {
		$objRequest = json_decode($strRequest);
	}
}