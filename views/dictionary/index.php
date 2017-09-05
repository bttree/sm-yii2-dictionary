<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('smy.dictionary', 'Dictionaries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('smy.dictionary', 'Create Dictionary'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('smy.dictionary', 'Dictionary Items'),
                    ['/smydictionary/dictionary-item/index'],
                    ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
                             'dataProvider' => $dataProvider,
                             'columns'      => [
                                 'id',
                                 'name',
                                 'slug',
                                 [
                                     'class'    => 'yii\grid\ActionColumn',
                                     'template' => '{list} {update} {delete}',
                                     'buttons'  => [
                                         'list' => function ($url, $model, $key) {
                                             return Html::a(
                                                 Html::tag('span',
                                                           '',
                                                           ['class' => 'glyphicon glyphicon-list']),
                                                 Url::to([
                                                             '/smydictionary/dictionary-item/index',
                                                             'SearchDictionaryItem[dictionary_id]' => $model->id
                                                         ]));
                                         }
                                     ],
                                 ]
                             ],
                         ]); ?>
</div>