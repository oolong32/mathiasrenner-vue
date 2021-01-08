<?php
/**
 * mathiasModule module for Craft CMS 3.x
 *
 * Nichts besonderes, ausser besserer Twig-Variablen.
 *
 * @link      josefrenner.ch
 * @copyright Copyright (c) 2021 Josef Renner
 */

namespace modules\mathiasmodule\assetbundles\mathiasmodule;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Josef Renner
 * @package   MathiasModule
 * @since     1.0.0
 */
class MathiasModuleAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@modules/mathiasmodule/assetbundles/mathiasmodule/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/MathiasModule.js',
        ];

        $this->css = [
            'css/MathiasModule.css',
        ];

        parent::init();
    }
}
