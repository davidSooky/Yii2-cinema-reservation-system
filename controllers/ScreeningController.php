<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Screening;
use app\models\Ticket;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ScreeningController implements the CRUD actions for Screening model.
 */
class ScreeningController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                "only" => ["index", "create", "update", "delete", "all"],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
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

    /**
     * Lists all Screening models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Screening::find()->getScreeningsForToday(),
        ]);

        $title = "Upcoming screenings for " . Yii::$app->formatter->asDate(time(), "long");

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            "title" => $title
        ]);
    }

    public function actionAll()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Screening::find(),
        ]);

        $title = "Screenings";

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            "title" => $title
        ]);
    }

    /**
     * Displays a single Screening model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {   
        $model = $this->findModel($id);
        $numOfTickets = $model->getNumOfTickets();

        return $this->render('view', [
            'model' => $model,
            "numOfTickets" => $numOfTickets,
        ]);
    }

    /**
     * Creates a new Screening model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Screening();
        $movies = $model->getExistingMovieTitles();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash("success", "Screening has been created successfully.");
            return $this->redirect(['all']);
        }

        return $this->render('create', [
            'model' => $model,
            "movies" => $movies
        ]);
    }

    /**
     * Updates an existing Screening model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $movies = $model->getExistingMovieTitles();
        $title = $model->getMovieTitle($model->movie_id) . " / " . $model->day;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['all']);
        }

        return $this->render('update', [
            'model' => $model,
            "movies" => $movies,
            "title" => $title
        ]);
    }

    /**
     * Deletes an existing Screening model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['all']);
    }

    /**
     * Finds the Screening model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Screening the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Screening::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
