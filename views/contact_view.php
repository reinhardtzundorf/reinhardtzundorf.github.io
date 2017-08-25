<?php
/* ================================================================ *
 * Web Folders Online                                               *
 * ---------------------------------------------------------------- *
 * Filename                         contact_view.php                *
 * Page Type                        View/Form                       *
 * Date Created                     30 July 2017                    *
 * Author                           Reinhardt Zündorf               *
 * ---------------------------------------------------------------- */

/* ================================================================ *
 * Variables                                                        *
 * ---------------------------------------------------------------- */
$page_type  = "form";
$page_class = "contact";

/* ================================================================ *
 * Header                                                           *
 * ---------------------------------------------------------------- */
include './layout/header.php';

?>
<!-- CONTACT SECTION -->
<section id="contact" class="section">

    <!-- CONTACT: Heading -->
    <header>
        <div class="container text-center">
            <h1>Contact Us</h1>
        </div><!-- /.container -->
    </header><!-- /.header -->

    <!-- CONTACT: Content -->
    <div class="container section-inner">

        <!-- CONTACT: Business Card-->
        <div class="contact-card col-lg-6">
            <div class="row">

                <!-- Symbol/Text -->
                <div class="col-lg-2">
                    <ul class="list-unstyled">
                        <li>Tel</li>
                        <li>Email</li>
                        <li>Skype</li>
                        <li>Postal Address</li>
                    </ul><!-- /.list-unstyled -->
                </div><!-- /.col-lg-6 -->

                <!-- Info -->
                <div class="col-lg-4">
                    <ul class="list-unstyled">
                        <li>43534555</li>
                        <li>infoerbsdfco.za</li>
                        <li>Skype</li>
                        <li>Postal Address</li>
                    </ul><!-- /.list-unstyled -->
                </div><!-- /.col-lg-4 -->

            </div><!-- /.row -->
        </div><!-- /.contact-list -->
    </div><!-- /.container -->
</section><!-- /#contact -->

<?php
/* ================================================================ *
 * Footer                                                           *
 * ---------------------------------------------------------------- */
include './layout/footer.php';
;
