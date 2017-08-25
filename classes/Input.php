<?php

/** ------------------------------------------------------------------ **
 *	Chipa-Tabane Comprehensive High School (CTC)						*
 *	Administration Portal 												*
 *  ------------------------------------------------------------------- *
 *	Controller Class		DB.php 	 									*
 *	File Path 				classes/DB.php  		  					*
 *	Last Updated			25 March 2017		(orig. 22/03/2017)		*
 *	Author 					Reinhardt Zündorf							*
 ** ------------------------------------------------------------------ **/
class Input 
{
	/** ------------------------------------------------------------------ **
 	 * Exists. Checks whether there is input.                               *
 	 * Updated              28 March 2017					*
 	 * Author		Reinhardt Zündorf                               *
 	 ** ------------------------------------------------------------------ **/
	public static function exists($type = 'post') 
	{
		switch ($type) {
			case 'post':
				return (!empty($_POST)) ? true : false;
				break;
			case 'get':
				return (!empty($_GET)) ? true : false;
				break;
			default:
				return false;
				break;
		}
	}

	/** ------------------------------------------------------------------ **
 	 *	Input::get($item)              Static Method						*
 	 *	Updated   	28 March 2017											*
 	 *	Author		Reinhardt Zündorf										*
 	 ** ------------------------------------------------------------------ **/
	public static function get($item) 
	{
		if(isset($_POST[$item])) 
		{
			return $_POST[$item];
		} 
		else if(isset($_GET[$item])) 
		{
			return $_GET[$item];
		}

		return '';
	}
}