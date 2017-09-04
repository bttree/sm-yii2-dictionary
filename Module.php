<?php

namespace bttree\smydictionary;

use Yii;

/**
 * Dictionary module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'bttree\smydictionary\controllers';

    public $dictionaryTypes = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (!isset(Yii::$app->i18n->translations['smy.dictionary'])) {
            Yii::$app->i18n->translations['smy.dictionary'] = [
                'class'          => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'ru',
                'basePath'       => '@bttree/smydictionary/messages'
            ];
        }
    }
}