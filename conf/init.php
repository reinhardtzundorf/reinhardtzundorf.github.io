<?php
/* ============================================================================ *
 *  Web Folders Online - Initializer Class                                      *
 * ---------------------------------------------------------------------------- */
/* Name                 default.php                                             *
 * Class Type           Configuration Class                                     *
 * Created on           09 June 2017                                            *
 * Author               Reinhardt Zündorf                                       *   
 * ---------------------------------------------------------------------------- *
 * Desc                 Initializes all PHP classes and config containers       *
 *                      Error logging and session/cookie management is also     *
 *                      done in this class. This class is to be included in     *
 *                      all of the controller classes in this project.          *
 * ---------------------------------------------------------------------------- */

/* ========================================================= *
 * Start session                                             *
 * --------------------------------------------------------- */
session_start();

/* ================================================================ *
 * Set error logging to on.                                         *
 * ---------------------------------------------------------------- */
ini_set("log_errors", 1);                  
//ini_set("error_log", "/home/reinwoerstz/Desktop/php_errors.log");      /* custom error log location */

/* ================================================================================ *
 * Config for the database connection, cookies & storing sessions                   *
 * -------------------------------------------------------------------------------- */
$GLOBALS['config'] = ['mysql'    => ['host' => 'localhost', 'username' => 'root', 'password' => '16538xxr', 'db' => 'webfogpe_db'],
                      'remember' => ['cookie_name' => 'hash', 'cookie_expiry' => 604800 ],
                      'sessions' => ['session_name' => 'user', 'token_name'   => 'token']];

/* ================================================================= *
 * Autload for class includes/requires                               *
 * ----------------------------------------------------------------- */
spl_autoload_register(function ($class)
{
    require_once './classes/' . $class . '.php';        /* require all classes in the 'classes'folder */
});

/* ----------------------------------------------------------------- *
 * Cookies & Session checks                                          *
 * ----------------------------------------------------------------- */
/*if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('sessions/session_name')))
{
    $hash      = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

    if($hashCheck->count())
    {
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }
} */