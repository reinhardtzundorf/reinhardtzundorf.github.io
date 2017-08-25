<?php

/** ------------------------------------------------------------------ **
 *  Chipa-Tabane Comprehensive High School (CTC)                        *
 *  EduBoard Dashboard                                                  *
 *  ------------------------------------------------------------------- *
 *  Class                   Token.php                                   *
 *  File Path               classes/Token.php                           *
 *  Last Updated            22 March 2017                               *
 *  Author                  Reinhardt Zündorf                           *
 ** ------------------------------------------------------------------ **/
class Token 
{
    public static function generate() 
    {
        return Session::put(Config::get('sessions/token_name'), md5(uniqid()));
    }

    public static function check($token) 
    {
        $tokenName = Config::get('sessions/token_name');

        if(Session::exists($tokenName) && $token === Session::get($tokenName)) 
        {
            Session::delete($tokenName);
            return true;
        }

        return false;
    }
}