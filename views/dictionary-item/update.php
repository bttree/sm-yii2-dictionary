<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model bttree\smydictionary\models\DictionaryItem */

$this->title                   = Yii::t('smy.dictionary', 'Update Dictionary Item:') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('smy.dictionary', 'Dictionary Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
$this->params['breadcrumbs'][] = Yii::t('smy.dictionary', 'Update');
?>
<div class="dictionary-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form',
                      [
                          'model' => $model,
                      ]) ?>

</div>
