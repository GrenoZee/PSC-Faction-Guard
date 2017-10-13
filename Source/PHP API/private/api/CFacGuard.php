<?php
include_once '../../private/api/init_api.php';

class CFacGuard {
	protected
		$arrResponse
		, $objDB;

	//--------------------
	public function __construct() {
		//TODO - Set $objDB to database connection and login
		try {
			$this->objDB = new PDO(
					"mysql:host=" . FG_DB_SERVER . ";dbname=" . FG_DB_NAME
					, FG_DB_USER
					, FG_DB_PASSWORD
					);
			$this->objDB->setAttribute(
					PDO::ATTR_ERRMODE
					, PDO::ERRMODE_EXCEPTION
					);
		} catch (PDOException $objException) {
		    $this->SetError(
		            FG_ERR_DB_CONNECTION_FAILED
		            , $objException
		            , TRUE
		            );
		}
	}
	
	//--------------------
	public function GetMissionList($strRequest) {
		$objRequest = $this->ParseRequest($strRequest);
	}

	//--------------------
	public function Login($strRequest) {
		$objRequest = $this->ParseRequest($strRequest);
	}

	//--------------------
	protected function ParseRequest($strRequest) {
		$objRequest = json_decode($strRequest);
		
		if (
		        is_null($objRequest)
		         and
		        json_last_error() != JSON_ERROR_NONE
		        ) {
		    $objException = new Exception(
		            json_last_error_msg()
		            , json_last_error()
		            );
		    $this->SetError(
		        FG_ERR_API_REQUEST_PARSING_ERROR
		        , $objException
		        , TRUE
		        );
		}
		    
		if (!isset($objRequest->accessToken)) {
		    $this->SetError(
		            FG_ERR_API_NO_ACCESS_TOKEN
		            , NULL
		            , TRUE
		            );
		}
		
		$strSQL =
		    'SELECT Count(*)'
		    . ' FROM APISession'
		    . ' WHERE'
		        . ' User_ID = ' . $objRequest->accessToken
		            . ' AND'
		        . ' Expiry > ' . time
		    ;
		$this->objDB->prepare($strSQL);
	}

	//--------------------
	protected function SetError(
			$intFGErrorCode = FG_ERR_NONE
			, $objException = NULL
            , $blnClose = FALSE
            ) {
		$this->arrResponse['error']['code'] = $intFGErrorCode;
		$this->arrResponse['error']['message'] = FG_ERRORS[$intFGErrorCode];

		if (isset($objException)) {
			$this->arrResponse['error']['exceptionCode'] = $objException->getCode;
			$this->arrResponse['error']['exceptionMessage'] = $objException->getMessage;
			$this->arrResponse['error']['exceptionFile'] = $objException->getFile;
			$this->arrResponse['error']['exceptionLine'] = $objException->getLine;
		}
		
		if ($blnClose) {
		    $this->WriteResponse();
		    throw new CExit();
		}
	}

	//--------------------
	protected function WriteResponse() {
	    if (!isset($this->arrResponse['error']['code'])) 
			$this->SetError(FG_ERR_NONE);
			
		echo json_encode($this->arrResponse);
	}
}