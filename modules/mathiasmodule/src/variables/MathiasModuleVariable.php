<?php
/**
 * mathiasModule module for Craft CMS 3.x
 *
 * Nichts besonderes, ausser besserer Twig-Variablen.
 *
 * @link      josefrenner.ch
 * @copyright Copyright (c) 2021 Josef Renner
 */

namespace modules\mathiasmodule\variables;

use modules\mathiasmodule\MathiasModule;

use Craft;

/**
 * @author    Josef Renner
 * @package   MathiasModule
 * @since     1.0.0
 */
class MathiasModuleVariable
{
    // Public Methods
    // =========================================================================

    /**
     * @param null $optional
     * @return string
     */
    public function exampleVariable($optional = null)
    {
        $result = "And away we go to the Twig template...";
        if ($optional) {
            $result = "I'm feeling optional today...";
        }
        return $result;
    }
}
