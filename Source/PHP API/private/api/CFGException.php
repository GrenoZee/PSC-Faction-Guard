<?php
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
            $arrResponse['error']['exceptionCode'] = $objPrevious->getCode();
            $arrResponse['error']['exceptionMessage'] = $objPrevious->getMessage();
            $arrResponse['error']['exceptionFile'] = $objPrevious->getFile();
            $arrResponse['error']['exceptionLine'] = $objPrevious->getLine();
        }
        
        $objResponse = new CResponse($arrResponse);
        $objResponse->Write($enuType);
    }
}