<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('smy.dictionary', 'Dictionary Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('smy.dictionary', 'Create Dictionary Item'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('smy.dictionary', 'Dictionaries'),
                    ['/smydictionary/dictionary/index'],
                    ['class' => 'btn btn-info']) ?>
    </p>
    <?= GridView::widget([
                             'dataProvider' => $dataProvider,
                             'columns'      => [
                                 'id',
                                 [
                                     'attribute' => 'dictionary_id',
                                     'format'    => 'raw',
                                     'value'     => function ($data) {
                                         return Html::a($data->dictionary->name,
                                                        Url::to([
                                                                    '/smydictionary/dictionary/update',
                                                                    'id' => $data->dictionary->id
                                                                ]));
                                     },
                                 ],
                                 'status',
                                 'name',
                                 'slug',
                                 'value',
                                 [
                                     'class'    => 'yii\grid\ActionColumn',
                                     'template' => '{update} {delete}'
                                 ]
                             ],
                         ]); ?>
</div>
