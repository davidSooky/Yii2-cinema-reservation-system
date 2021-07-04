<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Movie;
use app\models\Ticket;
use app\models\Screening;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->view->registerMetaTag([
            "name" => "description",
            "content" => "Main page, where user can select a film to book tickets."
        ]);

        $dataProvider = new ActiveDataProvider([
            "query" => Movie::find()
        ]);

        return $this->render('index', ["dataProvider" => $dataProvider]);
    }

    public function actionMovie($id)
    {
        $movie = Movie::findOne($id);
        $screenings = Screening::find()->getUpcomingScreeningsForMovie($id);
        $title = $movie->title;

        $dataProvider = new ActiveDataProvider([
            "query" => $screenings
        ]);

        return $this->render('movie', [
            "dataProvider" => $dataProvider,
            "title" => $title
        ]);
    }

    public function actionScreening($id)
    {
        $model = Screening::findOne($id);
        $numOfTickets = $model->getNumOfTickets();

        $tickets = new Ticket();

        if(Yii::$app->request->post())
        {
            $postData = Yii::$app->request->post();
            $userInfo = $postData["Ticket"];

            $seats = $postData["seats"] ?? null;

            $name = $userInfo["name"];
            $email = $userInfo["email"];
            $phone = $userInfo["phone_num"];

            if ($seats) {
                foreach ($seats as $seat) {
                    $ticket = new Ticket();
                    $ticket->screening_id = $model->id;
                    $ticket->seat = $seat;
                    $ticket->name = $name;
                    $ticket->email = $email;
                    $ticket->phone_num = $phone;

                    $ticket->save();
                }

                Yii::$app->session->setFlash("success", "Your reservation is ready.");
                return $this->redirect(['site/index']);
            } else {
                Yii::$app->session->setFlash("danger", "Please select at least one seat.");
                return $this->redirect(['site/screening', "id" => $id]);
            }
        }

        return $this->render('//screening/view', [
            "model" => $model,
            "numOfTickets" => $numOfTickets,
            "tickets" => $tickets
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
