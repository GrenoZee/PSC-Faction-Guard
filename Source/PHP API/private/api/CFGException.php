<?php

//====================
// ERROR CONSTANTS
// No error
const FG_ERR_NONE = 0;

// Unknown errors
const FG_ERR_UNKNOWN = 1;

// API Calls errors
const FG_ERR_API_REQUEST_PARSING_ERROR = 1000;
const FG_ERR_API_NO_ACCESS_TOKEN = 1001;

// DB Errors
const FG_ERR_DB_CONNECTION_FAILED = 2000;

//====================
class CFGException extends Exception {
    static protected $arrMessages = array (
            FG_ERR_NONE => "Success"
            , FG_ERR_UNKNOWN => "Unknown error"
            , FG_ERR_API_REQUEST_PARSING_ERROR => "API failed to recognize the Request"
            , FG_ERR_DB_CONNECTION_FAILED => "Failed to connect to " . FG_PROJECT_NAME . " database"
            );
    
    //--------------------
    function __construct(
            $intCode = FG_ERR_NONE
            , $strMessage = ''
            , $objPrevious = NULL
            ) {
        parent::__construct(
                self::$arrMessages[$intCode]
                    . (!empty($strMessage)
                            ? "; $strMessage"
                            : ""
                            )
                , $intCode
                , $objPrevious
                );
    }
    
    //--------------------
    public function Write($enuType = FG_RESPONSE_JSON) {
        $arrResponse = array (
            'code' => $this->getCode()
            , 'error' => array(
                'message' => $this->getMessage()
                , 'file' => $this->getFile()
                , 'line' => $this->getLine()
                )
            );
        $objPrevious = $this->getPrevious();
        
        if (isset($objPrevious)) {
            $arrResponse['error']['previousCode'] = $objPrevious->getCode;
            $arrResponse['error']['previousMessage'] = $objPrevious->getMessage;
            $arrResponse['error']['previousFile'] = $objPrevious->getFile;
            $arrResponse['error']['previousLine'] = $objPrevious->getLine;
        }
        
        $objResponse = new CResponse($arrResponse);
        $objResponse->Write($enuType);
    }
}