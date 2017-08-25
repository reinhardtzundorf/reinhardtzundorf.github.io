<?php

namespace wf;

/**
 * Description of PortfolioCard
 *
 * @author reinwoerstz
 */
/* ============================================================ *
 * PortfolioCard Class                                          *
 * -------------------------------------------------------------*/
class PortfolioCard
{
   /* ============================================================ *
    * Attributes                                                   *
    * -------------------------------------------------------------*/
    var $cardId;                        /* unique identifier */
    var $cardSnapPath;                  /* path to the image/snapshot of the portfolio entry  */
    var $cardName;                      /* name of company/institution  */

    public function __construct()
    {
        ;
    }
}

