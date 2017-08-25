<?php

/* -------------------------------------------------------------------- *
 *  Web Folders - CMS Backend 						*
 *  ------------------------------------------------------------------- *
 *  Library Class			Config.php 	 		*
 *  Last Updated			29 June 2017                    *
 *  Author 				Reinhardt Zündorf               *
 * -------------------------------------------------------------------- */
class Config
{
    /** ----------------------------------------------------------- **
     * Config::get($path) 											 *
     * Check the session variable and return true if the user has a  *
     * active session                                                *
     *  > Updated 11/03/2017 by Reinhardt                            *
     * ------------------------------------------------------------ * */
    public static function get($path = null)
    {

        if($path)
        {
            $config = $GLOBALS['config'];
            $path   = explode('/', $path);

            foreach($path as $bit)
            {
                if(isset($config[$bit]))
                {
                    $config = $config[$bit];
                }
            }
            return $config;
        }
        return false;
    }

}


?>