<?php
/* ======================================================================== *
 * Web Folders Online                                                       *
 * ------------------------------------------------------------------------ *
 * Filename                    header.php                                   *
 * Page Type                   Layout                                       *
 * Date Created                09 June 2017                                 *
 * Author                      Reinhardt Zündorf                            *
 * Notes                       Markup for CSS, Meta and start of body       *
 * ------------------------------------------------------------------------ */

/* ======================================================================== *
 * Check that the body tag class variable is not blank, else set it to a    *
 * default value.                                                           *
 * ------------------------------------------------------------------------ */
if(!isset($page_class))
{
    $page_class = "index";
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1, shrink-to-fit=no">
        <!--<meta http-equiv="Cache-Control" content="no-cache" />           * remove this when done testing -->

        <!-- Title -->
        <title>Web Folders | Under Construction</title>

        <!-- CSS -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet">
        <link href="./lib/css/bootstrap.css"       rel="stylesheet"/>
        <link href="./lib/css/font-awesome.css"    rel="stylesheet"/>
        <link href="./lib/css/wf-style-1.6.css"    rel="stylesheet"/>
        <!--<link href="./lib/css/bootstrap-theme.css" rel="stylesheet"/>-->
        <!--<link href="./lib/css/animate-animo.css"   rel="stylesheet"/>-->

        <!-- Meta -->
        <meta name="viewport"    content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="description" content="Web Folders (Pty) Ltd | Web Design, Internet Marketing & Website Development."/>
        <!-- * research meta keywords and the other meta tags -->
        <meta name="keywords"    content="Websites, Web Design, Web Development, SEO, Search Engine Optimization"/>

        <!-- Favico Icon -->
        <link rel="icon" href="./favicon.ico"/>

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
    </head><!-- /head -->

    <!-- BODY -->
    <!-- Note: The body tag's class attribute is set in the $page_class variable of the view/form that includes this file. -->
    <body id="page-top" class="<?php echo $page_class; ?>">

        <!-- NAVIGATION -->
        <!--<nav id="main-nav" class="navbar navbar-default navbar-fixed-top">-->
                <!-- NAVIGATION: Mobile -->
<!--                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="index.php#"><img src="../res/brand/wf-brand-sm.png" alt="Web Folders (Pty) Ltd"/></a>
                </div>-->

                <!-- NAVIGATION: Links -->
                <nav class="nav navbar-top nav-tabs text">
                    <a class="nav-link active" href="index.php?action=default">Home</a>     <!-- active link -->
                    <a class="nav-link" href="index.php?action=about">About</a>
                    <a class="nav-link" href="index.php?action=contact">Contact</a>
                    <a class="nav-link" href="index.php?action=process">Process</a>
                    <a class="nav-link" href="index.php?action=services">Services</a>
                    <a class="nav-link" href="index.php?action=login">Login</a>
                </nav>
            <!--</div>-->
        <!--</nav>-->

        <!-- WRAPPER -->
        <div class="wrapper">




