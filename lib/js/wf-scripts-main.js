/* 
 * Bootstrap Accordion - Services
 * -------------------------------------------------------------------------
 * Desc     Clickable collapse/expand sections for the services section.
 * Date     19 June 2017
 * Author   Reinhardt Zündorf
 * -------------------------------------------------------------------------
 */
$(document).ready(function ()
{
    $('.collapse').collapse();
})


/* 
 *  Scrollspy Function
 *  ------------------------------------------------------------------------
 *  Desc    Enables smooth scrolling for one-page long format websites.
 *  Date    26 May 2017
 *  Author  Reinhardt Zündorf
 * ------------------------------------------------------------------------- */
$(document).ready(function ()
{
    $('body').scrollspy({
        target: '#navbar-collapsible',
        offset: 50
    });
    /* smooth scrolling sections */
    $('a[href*=#]:not([href=#])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - 50
                }, 1000);
                return false;
            }
        }
    }
    );
});

/* 
 *  Google Analytics 
 *  ------------------------------------------------------------------------
 *  Desc    Links the page to your the Google Analytics Console.
 *  26 May 2017 by Reinhardt Zündorf
 * ------------------------------------------------------------------------- */
//(function (i, s, o, g, r, a, m) {
//    i['GoogleAnalyticsObject'] = r;
//    i[r] = i[r] || function () {
//        (i[r].q = i[r].q || []).push(arguments)
//    }, i[r].l = 1 * new Date();
//    a = s.createElement(o),
//            m = s.getElementsByTagName(o)[0];
//    a.async = 1;
//    a.src = g;
//    m.parentNode.insertBefore(a, m)
//})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
//ga('create', 'UA-40413119-1', 'bootply.com');
//ga('send', 'pageview');