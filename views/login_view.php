<?php
/* ================================================================ *
 * Web Folders Online                                               *
 * ---------------------------------------------------------------- *
 * Filename                         login.php                       *
 * Page Type                        Form                            *
 * Date Created                     09 June 2017                    *
 * Author                           Reinhardt Zündorf               *
 * ---------------------------------------------------------------- */

/* ---------------------------------------------------------------- *
 * Variables                                                        *
 * ---------------------------------------------------------------- */
$page_type  = "form";
$page_class = "login";

/* ================================================================ *
 * Page content                                                     *
 * ---------------------------------------------------------------- */
include './layout/header.php';            /*  Header  */

if(Input::exists())
{
    /* --------------------------------------------------------------- *
     * If there is input, we proceed to call an instance of the vali-  *
     * date class and check() the username and password format.        *
     * --------------------------------------------------------------- */
    $validate   = new Validate();
    $validation = $validate->check($_POST, array('username' => array('required' => true), 'password' => array('required' => true)));

    /* -------------------------------------------------------------------- *
     *  If validation succeeds                                              *
     * -------------------------------------------------------------------- */
    if($validate->passed())
    {
        error_log("************* DEBUG ****************** - Passed field validation", LOG_ALERT);
        $member = new Member();
//            $remember = (Input::get('remember') === 'on') ? true : false;

        /* -------------------------------------------------------------------------------------- *
         *  Member-> login(). Log the user in.                                                    *
         * -------------------------------------------------------------------------------------- */
        $login = $member->login(Input::get('username'), Input::get('password'), $remember);

        /* ------------------------------------------------------ *
         * If member has successfully been logged in              *
         * ------------------------------------------------------ */
        if($login)
        {
            /* ------------------------------------------------------------------------ *
             * Redirect the user after successful login to the dashboard/index page.    *
             * ------------------------------------------------------------------------ */
//            Redirect::to('index.php');
        }
        else if(Input::get())
        {
            $errorMsg = "<p class='login-box-msg-error'>Incorrect username or password</p>";
        }
    }
}
else
{
    $errorMsg = "<p class='login-box-msg-error'>Please enter your login info to continue.</p>";
}

include './forms/login_form.php';               /*  Login Form */
include './layout/footer.php';                  /*  Footer  */

