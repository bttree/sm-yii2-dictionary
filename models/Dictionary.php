<?php

namespace bttree\smydictionary\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%dictionary}}".
 *
 * @property integer          $id
 * @property string           $name
 * @property string           $slug
 * @property string           $description
 *
 * @property DictionaryItem[] $dictionaryItems
 */
class Dictionary extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dictionary}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['description'], 'string'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('smy.dictionary', 'ID'),
            'name'        => Yii::t('smy.dictionary', 'Name'),
            'slug'        => Yii::t('smy.dictionary', 'Slug'),
            'description' => Yii::t('smy.dictionary', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDictionaryItems()
    {
        return $this->hasMany(DictionaryItem::className(), ['dictionary_id' => 'id']);
    }

    /**
     * @param integer|null $id
     * @return array
     */
    public static function getAllArrayForSelect($id = null)
    {
        $query = self::find()->select(['id', 'name' => 'CONCAT(name, " (", slug, ")")']);
        if (!empty($id)) {
            $query->where(['!=', 'id', $id]);
        }

        return ArrayHelper::map($query->orderBy('id')->all(), 'id', 'name');
    }

    /**
     * @param array   $slugs
     * @param boolean $activeItems
     * @return array DictionaryItem[]
     */
    public static function getItemsByDictionaries($slugs = [], $activeItems = true)
    {
        $query = self::find()
                     ->joinWith('dictionaryItems di')
                     ->where([
                                 'dictionary.slug' => $slugs
                             ]);

        if ($activeItems) {
            $query->andWhere(['di.status' => DictionaryItem::STATUS_ACTIVE]);
        }

        /** @var $dictionaries Dictionary[] */
        $dictionaries = ArrayHelper::index($query->all(), 'slug');

        $items = [];
        foreach ($slugs as $slug) {
            if (!empty($dictionaries[$slug])) {
                $items[$slug] = $dictionaries[$slug]->dictionaryItems;
            } else {
                $items[$slug] = [];
            }
        }

        return $items;
    }

    /**
     * @param array   $slugs
     * @param boolean $activeItems
     * @return array Dictionary[]
     */
    public static function getDictionariesWithItems($slugs = [], $activeItems = true)
    {
        $query = self::find()
                     ->joinWith('dictionaryItems di')
                     ->where([
                                 'dictionary.slug' => $slugs
                             ]);

        if ($activeItems) {
            $query->andWhere(['di.status' => DictionaryItem::STATUS_ACTIVE]);
        }

        /** @var $dictionaries Dictionary[] */
        $dictionaries = ArrayHelper::index($query->all(), 'slug');

        return $dictionaries;
    }
}