<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\VacationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'id'=>'vacation-add',
    'action' => '/vacation/create',
    'enableAjaxValidation' => true,
    'validationUrl' => '/vacation/validate',
]); ?>
<div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'from')->widget(DatePicker::class, [
            'options' => ['placeholder' => 'Дата начала отпуска'],
            'pluginOptions' => [
                'format' => 'dd.mm.yyyy',
                'todayHighlight' => true,
                'autoclose'=>true,
            ]
        ])->label(false) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'to')->widget(DatePicker::class, [
            'options' => ['placeholder' => 'Дата конца отпуска'],
            'pluginOptions' => [
                'format' => 'dd.mm.yyyy',
                'todayHighlight' => true,
                'autoclose'=>true,
            ]
        ])->label(false) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'title')->textInput()->label(false) ?>
    </div>
    <div class="col-md-3">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-flat btn-default']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>

<?php
$js=<<<JS
    $(function(){
        $('body').on('beforeSubmit', '#vacation-add', function () {
            var form = $(this);
            if (form.find('.has-error').length) 
            {
                return false;
            }
            $.ajax({
                url    : form.attr('action'),
                type   : 'post',
                data   : form.serialize(),
                success: function (response){ 
                    console.log(response);
                    $('#vacation-from').val('');
                    $('#vacation-to').val('');
                    $('#vacation-title').val('');
                    $.pjax.reload({container:'#grid-view-vacation'});
                },
                error  : function () {
                    console.log('internal server error');
                }
            });
            return false;
        });
    });
JS;
$this->registerJs($js,$this::POS_END);
?>
