/* ======================================================================== *
 * Web Folders Online                                                       *
 * ------------------------------------------------------------------------ *
 * Filename                         wf-default-1.1.js                       *
 * File Type                        General JS Handler                      *
 * Date Created                     5 August 2017                           *
 * Author                           Reinhardt Zündorf                       *
 * ------------------------------------------------------------------------ */

/* ==================================================================== *
 * Page Scroll (* jQuery easing plugin required)                        *
 * -------------------------------------------------------------------- */
(function($) 
{
    "use strict";               /* start of use strict */

    /* ==================================================================== *
     * Page Scroll (* jQuery easing plugin required)                        *
     * -------------------------------------------------------------------- */
    $('.page-scroll a').bind('click', function(event) 
    {
        var $anchor = $(this);
        
        $('html, body').stop().animate(
        {
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        
        event.preventDefault();
    });

    /* ==================================================================== *
     * Highlight the top nav when the user scrolls about the page           *
     * -------------------------------------------------------------------- */
    $('body').scrollspy(
    {
        target: '.navbar-top',
        offset: 51
    });

    /* ==================================================================== *
     * Close the responsive menu item when the user clicks the button       *
     * -------------------------------------------------------------------- */
    $('.navbar-collapse ul li a').click(function()
    { 
        $('.navbar-toggle:visible').click();
    });

    // Offset for Main Navigation
    $('#mainNav').affix(
    {
        offset: { top: 100 }
    });

    /* ==================================================================== *
     * Contact: floating labels for the contact form                        *
     * -------------------------------------------------------------------- */
    $(function() 
    {
        $("body").on("input propertychange", ".floating-label-form-group",         
        function(e) 
        {
            $(this).toggleClass("floating-label-form-group-with-value", !!$(e.target).val());
        }).on("focus", ".floating-label-form-group",         
        function() 
        {
            $(this).addClass("floating-label-form-group-with-focus");
        }).on("blur", ".floating-label-form-group",         
        function() 
        {
            $(this).removeClass("floating-label-form-group-with-focus");
        });
    });
}) (jQuery); 

/* ======================================================================== */
