<?php
namespace wf;

/* ================================================================ *
 * Web Folders Online                                               *
 * ---------------------------------------------------------------- *
 * Filename                         client.php                      *
 * Page Type                        Class                           *
 * Date Created                     6 August 2017                   *
 * Author                           Reinhardt Zündorf               *
 * ---------------------------------------------------------------- */
class Client
{
    /* ---------------------------------------------------------------- *
     * 	Class variables                                                 *
     * ---------------------------------------------------------------- */
    private $_db, $_data, $_sessionName, $_cookieName, $isLoggedIn;

    /* ----------------------------------------------------------------- *
     * Default Constructor                                               *
     * ----------------------------------------------------------------- */
    public function __construct($member = null)
    {
        $this->_db          = DB::getInstance();
        $this->_sessionName = Config::get('sessions/session_name');
        $this->_cookieName  = Config::get('remember/cookie_name');

        /* -----------------------------------------------------------	*
         * Check whether there is a member in memory                    *
         * -----------------------------------------------------------  */
        if(!$member && Session::exists($this->_sessionName))
        {
            $member = Session::get($this->_sessionName);

            if($this->find($member))
            {
                $this->isLoggedIn = true;
            }
            else
            {
                $this->logout();
            }
        }
        /* -------------------------------------------------------------------- *
         * There is no logged in '
' nor an active session, check the DB 	*
         * -------------------------------------------------------------------- */
        else
        {
            $this->find($member);
        }
    }

    /* ----------------------------------------------------------------------------- *
     * 	Create: creates a new member entry in the database.                          *
     *  Added by Reinhardt Zündorf on 28 March 2017                                  *
     * ----------------------------------------------------------------------------- */
    public function create($fields = array())
    {
        /* ------------------------------------------------------------ * 
         * Insert a new 'Client' into the database.						*
         * ------------------------------------------------------------ */
        if(!$this->_db->insert('member', $fields))
        {
            error_log("EduBoard: Client - Failed to insert new member into DB");
            throw new Exception('Sorry, there was a problem creating your account. Please contact support for assistance.');
        }
    }

    /** ---------------------------------------------------------------------------- **
     * 	Client->update($fieldsArray, $mId)                                  		  *
     *  Added by Reinhardt Zündorf on 25 March 2017									  *
     * 	----------------------------------------------------------------------------- *
     * 	Update a row in 'ctc_admin' with data for each iteration of the '$fields' 	  *
     *  array specified in the arguments. The row is selected by the '$mId'			  *
     * * ---------------------------------------------------------------------------- * */
    public function update($fields = array(), $id = null)
    {

        /* --------------------------------------------------------------------------- 	*
         * Set the this 'Client' object's Id to the $mId set in the second argument 	*
         * --------------------------------------------------------------------------- 	 */
        if(!$id && $this->isLoggedIn())
        {
            $id = $this->data()->mId;
        }

        /* ------------------------------------------------------------------- 	*
         * Try to update & throw error if update failed 						*
         * -------------------------------------------------------------------- */
        if(!$this->_db->update('member', $id, $fields))
        {
            throw new Exception('There was a problem updating');
        }
    }

    /** --------------------------------------------------------------------------- *
     * 	Client->find($member = null)                                                *
     *  Added by Reinhardt Zündorf on 25 March 2017                                 *
     * 	--------------------------------------------------------------------------- */
    public function find($member = null)
    {
        /* -----------------------------------------------------------------------------------  *
         * Set the field to search on as numeric or a string based on the arguments data type   *
         * -----------------------------------------------------------------------------------  */
        if($member)
        {
            $field = (is_numeric($member)) ? 'mId' : 'mUsername';
            $data  = $this->_db->get('member', array($field, '=', $member));

            /* --------------------------------------------------------------------- *
             * 	Check that the '$member' exists in the DB.                           *
             * --------------------------------------------------------------------- */
            if($data->count())
            {
                $this->_data = $data->first();
                return true;
            }
        }

        return false;
    }

    /** ---------------------------------------------------------------------------- **
     * 	Client->login($username, $password, $remember)	                      		  *
     *  Added by Reinhardt Zündorf on 25 March 2017									  *
     * ------------------------------------------------------------------------------ *
     * 	Log the member in and create a new 'Session'. Create a cookie to remember 	  * 
     *  the member's session information (if specified).							  *
     * 	---------------------------------------------------------------------------- * */
    public function login($username = null, $password = null, $remember = false)
    {
        if(!$username && !$password && $this->exists())
        {
            Session::put($this->_sessionName, $this->data()->mId);
        }
        else
        {
            /* -----------------------------------------------------------------------------------  *
             * Call Client->find('$username') - check whether the username of the user attempting   *
             * to login is valid.                                                                   *
             * -----------------------------------------------------------------------------------  */
            $member = $this->find($username);

            /* -----------------------------------------------------------------------------------  *
             * If the username was found in the database, proceed to add the member to the session  *
             * -----------------------------------------------------------------------------------  */
            if($member)
            {
                // if($this->data()->mPassword === Hash::make($password, $this->data()->mSalt)) 
                // {

                /* ---------------------------------------------------------------  * 
                 * Add user to Session and start the session                        *
                 * ---------------------------------------------------------------  */
                error_log("Added user to session.");
                Session::put($this->_sessionName, $this->data()->mId);


                /* ---------------------------------------------------------------------------------------- *
                 *  If 'remember me' checkbox has been ticked by the user, we store the session             *
                 * ---------------------------------------------------------------------------------------- */
                // if($remember) 
                // {
                // 	error_log("EduBoard: member.php (168) - Remember me checkbox has been ticket. Save the session and cookie.", LOG_INFO);
                // $hash      = Hash::unique();
                // 	$hashCheck = $this->_db->get('member_session', array('mId', '=', $this->data()->mId));

                /* ----------------------------------------------------------------------------- *
                 * 	If the Hash does not already exist in 'member_session', then we insert one   *
                 * 	into the DB and add it to the 'Cookie'.										 *
                  //  * ----------------------------------------------------------------------------- */
                // if(!$hashCheck->count()) 
                // {

//                $this->_db->insert('member_session', array('mId'   => $this->data()->mId,
//                    'sHash' => '123123'));
                // } 
                // else 
                // {
                // 	$hash = $hashCheck->first()->hash;
                // }

                /* ----------------------------------------------------------------------------- *
                 * Add Hash to cookies.														     *
                 * ----------------------------------------------------------------------------- */
                // Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
                // }

                return true;
            }
            else
            {
                error_log("Client.php -  Could not find the username in the DB.");
            }
        }

        return false;
    }

    /* ------------------------------------------------------------------------------ *
     * 	Client->hasPermission($key)			                              *
     *  Added by Reinhardt Zündorf on 25 March 2017                                   *					   
     * ------------------------------------------------------------------------------ */
    public function hasPermission($key)
    {
        /* ----------------------------------------------------------------------- *
         * Get group permissions from 'ctc_admin' database 			   *   
         * ----------------------------------------------------------------------- */
        $group = $this->_db->get('group', array('mId', '=', $this->data()->mGroup));

        if($group->count())
        {
            $permissions = json_decode($group->first()->permissions, true);
            return !empty($permissions[$key]);
        }
        if(!isset($group))
        {
            error_log("Client is not in any group and therefore lacks permission data. ");
        }

        return false;
    }

    /** ---------------------------------------------------------------------------- **
     * 	Client->exists()															  *
     *  Added by Reinhardt Zündorf on 25 March 2017									  *
     * * ---------------------------------------------------------------------------- * */
    public function exists()
    {
        return (!empty($this->_data)) ? true : false;
    }

    /** ---------------------------------------------------------------------------- **
     * 	Client-> logout()															  *
     *  Added by Reinhardt Zündorf on 25 March 2017									  *
     * ------------------------------------------------------------------------------ *
     *  Check whether a session exists in the database as well as in the 'Session' &  *
     *  the 'Cookie' classes, if exists, delete the session from the aforementioned   *
     *  classes to log the member out.												  *
     * * ---------------------------------------------------------------------------- * */
    public function logout()
    {
        $this->_db->delete('member_session', array('mId', '=', $this->data()->mId));

        /* -------------------------------------------------------------------------- */

        Session::delete($this->_sessionName);
        Cookie::delete($this->_cookieName);
    }

    /** ---------------------------------------------------------------------------- **
     * 	Client-> data() 		Accessor Method										  *
     *  Added by Reinhardt Zündorf on 25 March 2017									  *
     * * ---------------------------------------------------------------------------- * */
    public function data()
    {
        return $this->_data;
    }

    /** ---------------------------------------------------------------------------- **
     * 	Client-> isLoggedIn()				Accessor Method							  *
     * * ---------------------------------------------------------------------------- * */
    public function isLoggedIn()
    {
        return $this->isLoggedIn;
    }

    /** ---------------------------------------------------------------------------- **
     * 	Client-> formatDataHTML()			Test									  *
     * * ---------------------------------------------------------------------------- * */
    public function formatDataHTML()
    {
        /* ---------------------------------------------------------------- *
         * 	Format member '$data' and return as a string to the front-end 	*
         * ---------------------------------------------------------------- */
        if(isset($_data))
        {
            $fData = "<table class='table table-bordered>'" .
                    "	<tr>" .
                    "		<td>Username</td>" .
                    "		<td>{$_data->mUsername}</td>" .
                    "	</tr>" .
                    "	<tr>" .
                    "		<td>Email</td>" .
                    "		<td>{$_data->mEmail}</td>" .
                    "	</tr>" .
                    "	<tr>" .
                    "		<td>Name</td>" .
                    "		<td>{$_data->mName}</td>" .
                    "	</tr>" .
                    "	<tr>" .
                    "		<td>Surname</td>" .
                    "		<td>{$_data->mSurname}</td>" .
                    "	</tr>" .
                    "</table>";
        }
        else
        {
            $fData = "No data.";
        }

        return $fData;
    }

}

