<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model bttree\smydictionary\models\Dictionary */

$this->title                   = Yii::t('smy.dictionary', 'Update Dictionary:') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('smy.dictionary', 'Dictionaries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
$this->params['breadcrumbs'][] = Yii::t('smy.dictionary', 'Update');
?>
<div class="dictionary-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form',
                      [
                          'model' => $model,
                      ]) ?>

</div>
