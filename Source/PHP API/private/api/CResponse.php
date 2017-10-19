<?php
require_once 'private/constants.php';

const
    FG_RESPONSE_JSON = 'json'
    , FG_RESPONSE_HTML = 'html'
    ;

//====================
class CResponse {
    protected
        $arrResponse
        , $enuType
        ;

    //--------------------
    public function __construct($arrResponse) {
        $this->arrResponse = $arrResponse;
        
        if (!isset($this->arrResponse['code']))
            $this->arrResponse['code'] = FG_ERR_NONE;
    }
        
    //--------------------
    public function Write($enuType = FG_RESPONSE_JSON) {
        $this->enuType = $enuType;
        header("Access-Control-Allow-Origin: *");
        
        if ($this->enuType == FG_RESPONSE_JSON) {
            header("Content-Type: application/json; charset=UTF-8");
            echo json_encode($arrResponse);
        }
        elseif ($this->enuType == FG_RESPONSE_HTML) {
            header("Content-Type: text/html; charset=utf-8");
            var_dump($this->arrResponse);
        }
    }
}