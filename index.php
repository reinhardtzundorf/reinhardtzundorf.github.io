<?php

/* ==================================================================== *
 * Web Folders Online                                                   *
 * -------------------------------------------------------------------- *
 * Filename                         index.php                           *
 * Type                             Controller Class                    *
 * Date Created                     09 June 2017                        *
 * Author                           Reinhardt Zündorf                   *
 * -------------------------------------------------------------------- */
require './conf/init.php';          /* include configuration file */

/* ==================================================================== *
 * Check if navigation has been selected.                               *
 * -------------------------------------------------------------------- */
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_URL);

switch($action)
{
    case 'home' :
        include './views/default_view.php';      /* landing */
        break;

    case 'contact' :
        include './views/contact_view.php';      /* contact details, enquiry form & static maps API integration */
        break;

    case 'about' :
        include './views/about_view.php';        /* company, history & mission */
        break;

    case 'process' :
        include './views/process_view.php';      /* planning, design, development & review phase outline */
        break;

    case 'products' :
        include './views/process_view.php';      /* packages, products, specials */
        break;

    case 'services' :
        include './views/services_view.php';     /* mosaic/grid layout style overview of services offered */
        break;

    case 'portfolio' :
        include './views/portfolio_view.php';    /* mosaic-block style gallery of projects completed */
        break;

    case 'legal' :
        include './views/legal_view.php';        /* terms & conditions, legal documents, SLA's */
        break;

    case 'login' :
        include './views/login_view.php';        /* takes the user to the client dashboard */
        break;

    default :
        include './views/default_view.php';      /* landing */
        break;
}

/**
 * Future                                                               *
 * ==================================================================== *
 * loadView(viewName, headerOn, FooterOn) 
 * {
 *      include header;
 *      content -->
 *      include footer;
 * }
 */

/* ==================================================================== */