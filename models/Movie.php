<?php

namespace app\models;

use Yii;
use app\models\Screening;
/**
 * This is the model class for table "movie".
 *
 * @property int $id
 * @property string $title
 * @property int $year
 * @property string $description
 * @property string $duration
 */
class Movie extends \yii\db\ActiveRecord
{

    public $poster;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'year', 'description', 'duration'], 'required'],
            [['year'], 'integer', "min" => 2018, "max" => 2100],
            [['duration'], 'integer', 
                "min" => 30, "max" => 180, 
                "tooSmall" => "Duration can not be lower then 30 minutes", 
                "tooBig" => "Duration can not be bigger then 180 minutes"
            ],
            [['title'], 'string', 'max' => 150],
            ["poster", "image"],
            [['description'], 'string', 'max' => 500],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'year' => 'Year',
            'description' => 'Description',
            'duration' => 'Duration',
            "poster" => "Movie poster"
        ];
    }

    public function getScreeningsForMovie() {
        return $this->hasMany(Screening::class, ["movie_id" => "id"])->orderBy(["day" => SORT_ASC])->asArray();
    }

    public function afterSave($insert, $changedAttributes) {

        if ($this->poster) {
            $posterPath = Yii::getAlias("@storage/posters/" . $this->clean($this->title) . ".jpg");
            $this->poster->saveAs($posterPath);
        }
    
        return parent::afterSave($insert, $changedAttributes);
    }

    public function beforeDelete()
    {
        $screenings = $this->screeningsForMovie;

        if($screenings) {
            Yii::$app->session->setFlash("danger", "Movies with screenings can not be deleted.");
            return false;

        } else {
            $posterPath = Yii::getAlias("@storage/posters/" . $this->clean($this->title) . ".jpg");
            if (file_exists($posterPath)) {
                unlink($posterPath);
            }

            Yii::$app->session->setFlash("success", "Movie deleted successfully.");
            return parent::beforeDelete();
        }
    }

    public function getPosterLink()
    {
        $localStorage = Yii::getAlias("@storage/posters/" . $this->clean($this->title) . ".jpg");
        $storage = Yii::$app->params["storageURL"];
        $file = $storage . $this->clean($this->title) . ".jpg";

        return file_exists($localStorage) ? $file : $storage . "default.jpg";
    }

    public function getMinutes() {
        return $this->duration . " minutes";
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\MovieQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\MovieQuery(get_called_class());
    }

    private function clean($string) {
        $string = str_replace(' ', '-', $string);
     
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }
}
