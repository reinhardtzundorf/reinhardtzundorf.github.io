<?php

/**
 * Description of Util
 *
 * @author Reinhardt Zündorf
 * @category Helper
 * @version 1.0
 */
class Util
{
    function escape($string)
    {
        return htmlentities($string, ENT_QUOTES, 'UTF-8');
    }

}

