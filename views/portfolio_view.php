<?php
/* ================================================================ *
 * Web Folders Online                                               *
 * ---------------------------------------------------------------- *
 * Filename                         default.php                     *
 * Page Type                        View                            *
 * Date Created                     09 June 2017                    *
 * Author                           Reinhardt Zündorf               *
 * ---------------------------------------------------------------- */

/* ================================================================ *
 * Variables                                                        *
 * ---------------------------------------------------------------- */
$page_type  = "view";
$page_class = "index";

/* ================================================================ *
 * Landing page content                                             *
 * ---------------------------------------------------------------- */
include './layout/header.php';                /*  Header      */
include './sections/landing.html';              /*  Brand Hero  */
include './sections/portfolio_basic.html';      /*  Portfolio   */
include './sections/services.html';             /*  About       */
include './layout/footer.php';;                /*  Footer      */

/* ================================================================ */