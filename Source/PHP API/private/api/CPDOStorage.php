<?php
include_once 'init_api.php';

//====================
class CPDOStorage extends OAuth2\Storage\Pdo {
    protected
        $arrSQL
        ;

    //--------------------
    public function checkUserCredentials($username, $password) {
        $arrResult = $this->QuerySQL_User_UserName($username);
        
        if (!isset($arrResult[0]))
            return FALSE;
        
        $strPasswordHash = password_hash(
                $password
                , PASSWORD_DEFAULT
                );

        if ($strPasswordHash === FALSE)
            throw new CFGException(
                    FG_ERR_UNKNOWN
                    , "Failed to hash the login password"
                    );
                
        $blnResult = $arrResult[0]['PasswordHash'] == $strPasswordHash;
        return $blnResult;
    }
    
    //--------------------
    public function getUserDetails($username) {
        $arrResult = $this->QuerySQL_User_UserName($username);
        
        if (!isset($arrResult[0]))
            return FALSE;
            
        return array('user_id' => $arrResult[0]['__id']);
    }
    
    //--------------------
    protected function QuerySQL_User_UserName($strUserName) {
        if (!isset($this->arrSQL['User_UserName'])) {
            $strSQL =
"SELECT *
FROM User
WHERE
    UserName = :username
     AND
    PasswordHash = :passwordHash"
                ;
                $this->arrSQL['User_UserName'] = $this->db->prepare($strSQL);
        }
        
        $this->arrSQL['User_UserName']->execute(array(':username' => $strUserName));
        return $this->arrSQL['User_UserName']->fetchAll();
    }
}