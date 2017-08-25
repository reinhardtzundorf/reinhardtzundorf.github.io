<?php

class Redirect 
{
    public static function to($location = null) 
    {
        if($location) 
        {
            if(is_numeric($location)) 
            {
                switch($location) 
                {
                    case 404:
                        header('HTTP/1.0 404 Not Found');
                        include 'core/modules/error/404.php';
                        break;

                    case 500:
                        header("HTTP/1.0 500 Internal Server Error.");
                        include 'core/modules/error/500.php';
                        break;
                }
            }
            header('Location: '. $location);
            exit();
        }
    }
}