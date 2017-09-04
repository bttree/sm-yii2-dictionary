<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use bttree\smywidgets\widgets\SlugWidget;

/* @var $this yii\web\View */
/* @var $model bttree\smydictionary\models\Dictionary */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dictionary-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'slug')->widget(SlugWidget::className(),
                                                     [
                                                         'sourceFieldSelector' => '#dictionary-name',
                                                         'url'                 => ['/smydictionary/dictionary/get-model-slug'],
                                                         'options'             => ['class' => 'form-control']
                                                     ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('smy.dictionary', 'Create') :
                                   Yii::t('smy.dictionary', 'Update'),
                               ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
