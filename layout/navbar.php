<?php
/* ================================================================ *
 * Navbar Layout Fragment                                           *
 * ---------------------------------------------------------------- */ 
?> 

<!-- NAVIGATION -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">

        <!-- Navigation Toggle -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>

            <!-- Brand Logo -->
            <a class="navbar-brand" href="#page-top">
                <img class="img-rounded" src="./res/brand/wf-brand-sm.png" alt="Web Folders (Pty) Ltd" />
            </a><!-- /.navbar-brand -->
        </div><!-- /.navbar-header -->

        <!-- Navbar -->
        <div class="collapse navbar-collapse navbar-custom" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="page-scroll">
                    <a href="index.php?action=about">Company</a>
                </li>
                <li class="page-scroll">
                    <a href="index.php?action=portfolio">Portfolio</a>
                </li>
                <li class="page-scroll">
                    <a href="index.php?action=services">Services</a>
                </li>
                <li class="page-scroll">
                    <a href="index.php?action=contact">Contact</a>
                </li>
            </ul><!-- /.navbar-nav -->
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav><!-- /.navbar-default --> 