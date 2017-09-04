<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model bttree\smydictionary\models\DictionaryItem */

$this->title = Yii::t('smy.dictionary', 'Create Dictionary Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('smy.dictionary', 'Dictionary Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
