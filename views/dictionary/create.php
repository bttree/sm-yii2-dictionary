<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model bttree\smydictionary\models\Dictionary */

$this->title = Yii::t('smy.dictionary', 'Create Dictionary');
$this->params['breadcrumbs'][] = ['label' => Yii::t('smy.dictionary', 'Dictionaries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
