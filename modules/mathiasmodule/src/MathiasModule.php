<?php
/**
 * mathiasModule module for Craft CMS 3.x
 *
 * Nichts besonderes, ausser besserer Twig-Variablen.
 *
 * @link      josefrenner.ch
 * @copyright Copyright (c) 2021 Josef Renner
 */

namespace modules\mathiasmodule;

use modules\mathiasmodule\assetbundles\mathiasmodule\MathiasModuleAsset;
use modules\mathiasmodule\variables\MathiasModuleVariable;

use Craft;
use craft\events\RegisterTemplateRootsEvent;
use craft\events\TemplateEvent;
use craft\i18n\PhpMessageSource;
use craft\web\View;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;
use yii\base\InvalidConfigException;
use yii\base\Module;

/**
 * Class MathiasModule
 *
 * @author    Josef Renner
 * @package   MathiasModule
 * @since     1.0.0
 *
 */
class MathiasModule extends Module
{
    // Static Properties
    // =========================================================================

    /**
     * @var MathiasModule
     */
    public static $instance;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function __construct($id, $parent = null, array $config = [])
    {
        Craft::setAlias('@modules/mathiasmodule', $this->getBasePath());
        $this->controllerNamespace = 'modules\mathiasmodule\controllers';

        // Translation category
        $i18n = Craft::$app->getI18n();
        /** @noinspection UnSafeIsSetOverArrayInspection */
        if (!isset($i18n->translations[$id]) && !isset($i18n->translations[$id.'*'])) {
            $i18n->translations[$id] = [
                'class' => PhpMessageSource::class,
                'sourceLanguage' => 'en-US',
                'basePath' => '@modules/mathiasmodule/translations',
                'forceTranslation' => true,
                'allowOverrides' => true,
            ];
        }

        // Base template directory
        Event::on(View::class, View::EVENT_REGISTER_CP_TEMPLATE_ROOTS, function (RegisterTemplateRootsEvent $e) {
            if (is_dir($baseDir = $this->getBasePath().DIRECTORY_SEPARATOR.'templates')) {
                $e->roots[$this->id] = $baseDir;
            }
        });

        // Set this as the global instance of this module class
        static::setInstance($this);

        parent::__construct($id, $parent, $config);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$instance = $this;

        if (Craft::$app->getRequest()->getIsCpRequest()) {
            Event::on(
                View::class,
                View::EVENT_BEFORE_RENDER_TEMPLATE,
                function (TemplateEvent $event) {
                    try {
                        Craft::$app->getView()->registerAssetBundle(MathiasModuleAsset::class);
                    } catch (InvalidConfigException $e) {
                        Craft::error(
                            'Error registering AssetBundle - '.$e->getMessage(),
                            __METHOD__
                        );
                    }
                }
            );
        }

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('mathiasModule', MathiasModuleVariable::class);
            }
        );

        Craft::info(
            Craft::t(
                'mathias-module',
                '{name} module loaded',
                ['name' => 'mathiasModule']
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================
}
