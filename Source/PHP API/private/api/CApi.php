<?php
include_once 'init_api.php';

//====================
class CApi {
	protected
		$arrResponse
		, $objDB
		, $objOAuth2Server
		, $objOAuth2Storage
	    ;

	//--------------------
	public function __construct() {
	    $this->DBConnect();
	    $this->InitOAuth();
	}
	    
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
	    $objRequest = $this->ParseRequest($strRequest);
	}
	
	//--------------------
	protected function InitOAuth () {
	    if (isset($this->objDB)) {
        	    $this->objOAuth2Storage = new CPDOStorage($this->objDB);
	        $this->objOAuth2Server = new OAuth2\Server($this->objOAuth2Storage);
	    }
	}

	//--------------------
	public function Login() {
	    $this->objOAuth2Server->addGrantType(new OAuth2\GrantType\ClientCredentials($this->objOAuth2Storage));
	    $objRequest = $this->ParseRequest($strRequest);
	    $this->objOAuth2Server->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();
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