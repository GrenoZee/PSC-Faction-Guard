<?php
use OAuth2\Storage\UserCredentialsInterface;

include_once 'init_api.php';

//====================
class CUserCredentials implements UserCredentialsInterface {
    protected
        $objDBO
        ;
    
    //--------------------
    public function __construct($objDBO) {
        $this->objDBO = $objDBO;
    }
    
    //--------------------
    public function checkUserCredentials($username, $password) {
        ;
    }
    
    //--------------------
    public function getUserDetails($param) {
        ;
    }
}