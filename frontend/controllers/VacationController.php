<?php

namespace frontend\controllers;

use common\models\User;
use common\models\Vacation;
use common\models\VacationSearch;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use yii\helpers\Json;
use yii\web\Response;

/**
 * VacationController implements the CRUD actions for Vacation model.
 */
class VacationController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index','validate','update-grid','create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions() {
        return \yii\helpers\ArrayHelper::merge(parent::actions(), [
            'update-grid' => [
                'class' => \kartik\grid\EditableColumnAction::class,
                'modelClass' => Vacation::class,
                'outputValue' => function ($model, $attribute, $key, $index) {
                    if ($attribute=='from' or $attribute=='to'){
                        return date('d.m.Y',strtotime($model->$attribute));
                    }
                    if ($attribute=='fixed'){
                        return ($model->fixed==Vacation::FIXED)?'Зафиксировано':'Не зафиксировано';
                    }
                },
                'checkAccess' => function($id,$model) {
                    $post=Yii::$app->request->post();
                    if ($post['editableAttribute'] == 'fixed'){
                        if (!User::isAdmin()){
                            throw new ForbiddenHttpException('Запрещено');
                        }
                    }
                    if ($post['editableAttribute'] == 'from' or $post['editableAttribute'] == 'to'){
                        if ($model->user_id!==Yii::$app->user->id or $model->fixed==Vacation::FIXED){
                            throw new ForbiddenHttpException('Запрещено');
                        }
                    }
                },
            ],
        ]);
    }

    /**
     * Lists all Vacation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model=new Vacation();
        $searchModel = new VacationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
        ]);
    }

    public function actionValidate()
    {
        $model=new Vacation();
        $model->load(Yii::$app->request->post());
        return Json::encode(ActiveForm::validate($model));
    }

    /**
     * Displays a single Vacation model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Vacation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vacation();
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->user_id=Yii::$app->user->id;
            return ['success' => $model->save()];
        }
    }

    /**
     * Updates an existing Vacation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Vacation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vacation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vacation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vacation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
