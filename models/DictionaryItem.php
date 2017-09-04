<?php

namespace bttree\smydictionary\models;

use bttree\smywidgets\behaviors\ConstArrayBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%dictionary_item}}".
 *
 * @property integer    $id
 * @property integer    $dictionary_id
 * @property integer    $status
 * @property string     $name
 * @property string     $slug
 * @property string     $value
 * @property string     $description
 *
 * @property Dictionary $dictionary
 *
 * @method array  getConstArray(string $attribute)
 * @method string getTitleValue(string $attribute)
 */
class DictionaryItem extends ActiveRecord
{
    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE   = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dictionary_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dictionary_id', 'status', 'name', 'slug', 'value'], 'required'],
            [['dictionary_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['name', 'slug', 'value'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [
                ['dictionary_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Dictionary::className(),
                'targetAttribute' => ['dictionary_id' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class'         => SluggableBehavior::className(),
                'attribute'     => 'name',
                'slugAttribute' => 'slug',
                'ensureUnique'  => true
            ],
            [
                'class'  => ConstArrayBehavior::className(),
                'arrays' => [
                    'status' => [
                        self::STATUS_ACTIVE   => Yii::t('smy.dictionary', 'Active'),
                        self::STATUS_DISABLED => Yii::t('smy.dictionary', 'Disabled'),
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => Yii::t('smy.dictionary', 'ID'),
            'dictionary_id' => Yii::t('smy.dictionary', 'Dictionary'),
            'status'        => Yii::t('smy.dictionary', 'Status'),
            'name'          => Yii::t('smy.dictionary', 'Name'),
            'slug'          => Yii::t('smy.dictionary', 'Slug'),
            'value'         => Yii::t('smy.dictionary', 'Value'),
            'description'   => Yii::t('smy.dictionary', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDictionary()
    {
        return $this->hasOne(Dictionary::className(), ['id' => 'dictionary_id']);
    }
}
