<?php
use common\models\User;
use common\models\Vacation;

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\VacationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отпуска';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacation-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->isGuest) : ?>
        <?= Html::a('Чтобы добавить отпуск - зарегистрируйтесь','site/login') ?>
    <?php else : ?>
        <?= $this->render('_add',['model'=>$model]) ?>
    <?php endif ?>

    <?php Pjax::begin([
        'id'=>'grid-view-vacation',
        'timeout'=>false,
    ]); ?>

    <?= GridView::widget([
        'pjax'=>true,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'user_id',
                'filter'=>false,
                'content'=>function($model){
                    return $model->user->email??'';
                }
            ],
            [
                'class' => \kartik\grid\EditableColumn::class,
                'attribute'=>'from',
                'readonly' => function($model){
                    if ($model->user_id==Yii::$app->user->id and !$model->fixed==Vacation::FIXED){
                        return false;
                    }
                    return true;
                },
                'editableOptions' => [
                    'inputType' => kartik\editable\Editable::INPUT_DATE,
                    'formOptions' => ['action' => ['/vacation/update-grid']],
                    'asPopover' => false,
                    'options' => [
                        'pluginOptions' => [
                            'format' => 'dd.mm.yyyy',
                            'todayHighlight' => true,
                            'autoclose'=>true,
                        ]
                    ]
                ],
                'filter'=>false,
                'content'=>function($model){
                    return date('d.m.Y',strtotime($model->from));
                }
            ],
            [
                'class' => \kartik\grid\EditableColumn::class,
                'attribute'=>'to',
                'readonly' => function($model){
                    if ($model->user_id==Yii::$app->user->id and !$model->fixed==Vacation::FIXED){
                        return false;
                    }
                    return true;
                },
                'editableOptions' => [
                    'inputType' => kartik\editable\Editable::INPUT_DATE,
                    'formOptions' => ['action' => ['/vacation/update-grid']],
                    'asPopover' => false,
                    'options' => [
                        'pluginOptions' => [
                            'format' => 'dd.mm.yyyy',
                            'todayHighlight' => true,
                            'autoclose'=>true,
                        ]
                    ]
                ],
                'filter'=>false,
                'content'=>function($model){
                    return date('d.m.Y',strtotime($model->to));
                }
            ],
            'title',
            [
                'class' => \kartik\grid\EditableColumn::class,
                'attribute'=>'fixed',
                'readonly' => function($model){
                    if (User::isAdmin()){
                        return false;
                    }
                    return true;
                },
                'editableOptions' => [
                    'data' => [Vacation::NOT_FIXED => 'Не зафиксировано', Vacation::FIXED => 'Зафиксировано'],
                    'inputType' => kartik\editable\Editable::INPUT_RADIO_LIST,
                    'formOptions' => ['action' => ['/vacation/update-grid']],
                    'asPopover' => false,
                ],
                'filter'=>false,
                'content'=>function($model){
                    return ($model->fixed==Vacation::FIXED)?'Зафиксировано':'Не зафиксировано';
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
