<?php
namespace Tanvir\Sabre\Rest;
class Token {
    private static $token = null;
    
    private static $expirationDate = 0;
    
    public static function getToken() {
        
        if (Token::$token == null || time() > Token::$expirationDate) {
            $authCall = new Auth();
            Token::$token = $authCall->callForToken();
            Token::$expirationDate = time() + Token::$token->expires_in;
            
        }
        return Token::$token;
    }
}
