<?php

namespace app\models;

use Yii;
use app\models\Movie;
use app\models\Ticket;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "screening".
 *
 * @property int $id
 * @property string $movie_id
 * @property string $day
 * @property string $start
 * @property string $end
 * @property int $price
 */
class Screening extends \yii\db\ActiveRecord
{
    private $minutes = ["00", "15", "30", "45"];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'screening';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['movie_id', 'price', "day", "start"], 'required'],
            [['price'], 'integer'],
            [['movie_id'], 'string', 'max' => 10],
            [['day', 'start'], 'string', 'max' => 255],
            ["day", "checkIfLastSunday", "skipOnEmpty" => false, "skipOnError" =>false],
            ["day", "checkIfInPast", "skipOnEmpty" => false, "skipOnError" =>false],
            ["start", "validateStart", "skipOnEmpty" => false, "skipOnError" =>false]
        ];
    }

    public function validateStart($attribute) {
        if ($this->find()->actualScreening($this->day, $this->$attribute, $this->id)) {
            $this->addError($attribute, "Only one screening at a time.");
        }

        if($this->find()->getLastScreening($this->day, $this->$attribute, $this->id)) {
            $this->addError($attribute, "There must be at least 1 hour gap between screenings.");
        }

        if (!in_array(substr($this->$attribute, -2), $this->minutes)) {
            $this->addError($attribute, "Screening can start only at (00, 15, 30, 45) minutes");
        } 

        if (strtotime($this->$attribute) < strtotime("8:00") || strtotime($this->$attribute) > strtotime("20:00")) {
            $this->addError($attribute, "Screening must start between 8:00 and 20:00.");
        }
    }

    public function checkIfLastSunday($attribute) {
        if (date("Y-m-d",strtotime("last sunday of" . date("M-Y", strtotime($this->$attribute)))) == $this->$attribute) {
            $this->addError($attribute, "There are no screenings on the last Sunday of the month.");
        }
    }

    public function checkIfInPast($attribute) {
        if (strtotime($this->$attribute . $this->start) < time()) {
            $this->addError($attribute, "Screening can not start in the past.");
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'movie_id' => 'Movie',
            'day' => 'Date',
            'start' => 'Start',
            'end' => 'End',
            'price' => 'Ticket price',
        ];
    }

    public function getReservedSeats() {
        $query = $this->hasMany(Ticket::class, ["screening_id" => "id"])->select("seat")->asArray()->all();

        return ArrayHelper::map($query, "seat", "name");
    }

    public function getNumOfTickets() {
        return $this->hasMany(Ticket::class, ["screening_id" => "id"])->count();
    }

    public function getMovie() {
        return $this->hasOne(Movie::class, ["id" => "movie_id"]);
    }

    public function getDuration($id) {
        return Movie::find($id)->one()->duration;
    }

    public function getPrice($numOfTickets = null) {
        if($numOfTickets === null) {
            return Yii::$app->formatter->asCurrency($this->price, "EUR");
        }

        return Yii::$app->formatter->asCurrency(($this->price * $numOfTickets), "EUR");
    }

    public function getExistingMovieTitles() {
        return Movie::find()->select(("id, title"))->asArray()->all();
    }

    public function save($runValidation = true, $attributeNames = null) {
        $this->day = Yii::$app->request->post()["day"];
        $this->start = Yii::$app->request->post()["start"];
        $startTime = strtotime($this->start);

        $movieDuration = Movie::find()->andWhere(["id" => $this->movie_id])->one()->duration;
        $this->end = date("H:i", strtotime("+" . $movieDuration . "minutes", $startTime));

        return parent::save($runValidation, $attributeNames);
    }
    /**
     * {@inheritdoc}
     * @return \app\models\query\ScreeningQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ScreeningQuery(get_called_class());
    }
}
