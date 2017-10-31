<?php
include_once 'init_api.php';

//====================
class CFacGuard {
	protected
		$arrResponse
		, $objDB
	    ;

    //--------------------
	protected function DBConnect() {
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
		}
		
		catch (PDOException $objException) {
		    throw new CFGException(
		            FG_ERR_DB_CONNECTION_FAILED
		            , ''
		            , $objException
		            );
		}
	}
	
	//--------------------
	public function GetMissionList($strRequest) {
		$this->DBConnect();
	    $objRequest = $this->ParseRequest($strRequest);
	}

	//--------------------
	public function Login($strRequest) {
	    $this->DBConnect();
	    $objUserCredentials = new CUserCredentials($this->objDBO);
	    
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
		    throw new CFGException(
		        FG_ERR_API_REQUEST_PARSING_ERROR
                , ''
		        , $objException
		        );
		}
		    
		if (!isset($objRequest->accessToken)) {
		    throw new CFGException(
		            FG_ERR_API_NO_ACCESS_TOKEN
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
}