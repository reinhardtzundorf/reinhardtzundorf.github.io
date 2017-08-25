<?php
/* ================================================================ *
 * Web Folders Online                                               *
 * ---------------------------------------------------------------- *
 * Filename                         default.php                     *
 * Page Type                        View                            *
 * Date Created                     09 June 2017                    *
 * Author                           Reinhardt Zündorf               *
 * ---------------------------------------------------------------- */

/* ---------------------------------------------------------------- *
 * Variables                                                        *
 * ---------------------------------------------------------------- */
$page_type  = "view";
$page_class = "index";

include './layout/header.php';
?>

<!-- Header -->
<header class="container-fluid" id="maincontent" tabindex="-1">
    <div class="row">
        <div class="col-lg-6">

            <!-- Logo -->
            <img class="img-responsive" src="" alt="">

            <!-- Brand -->
            <div class="intro-text">
                <p class="skills"></p>
            </div>
        </div>
    </div>
</header><!-- /header -->

<!-- Content -->
<?php 

/* ------------------------------------------------------------ *
 * Tiles/Components                                             *
 * ------------------------------------------------------------ */
include './tiles/portfolio.html';   /* Portfolio    */
include './tiles/about.html';       /* About        */
include './forms/contact.php';      /* Contact      */

/* ------------------------------------------------------------ *
 * Footer                                                       *
 * ------------------------------------------------------------ */
include './layout/footer.php';
