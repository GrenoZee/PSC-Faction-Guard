<?php
require_once '../../private/api/init_api.php';

try {
    $objFacGuard = new CFacGuard();
    
    switch ($_REQUEST['module']) {
        case 'auth':
            switch ($_REQUEST['command']) {
                case 'login':
                    $arrResponse = $objFacGuard->Login(file_get_contents("php://input"));
                    break;
                    
                default:
                    ;
                    break;
            }
            
            break;
            
        case 'mission':
            switch ($_REQUEST['command']) {
                case 'getlist':
                    $arrResponse = $objFacGuard->GetMissionList(file_get_contents("php://input"));
                    break;
                
                default:
                    ;
                    break;
            }

        default:
            break;
    }
    
    if (isset($arrResponse)) {
        $objResponse = new CResponse($arrResponse);
        $objResponse->Write();
    }
}

catch (CFGException $e) {
    $e->Write();
}
