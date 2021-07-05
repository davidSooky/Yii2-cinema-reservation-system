<?php

namespace app\models;

use Yii;
use app\models\Screening;
use app\models\Movie;

/**
 * This is the model class for table "ticket".
 *
 * @property int $id
 * @property int $screening_id
 * @property string $seat
 * @property string $name
 * @property string $phone_num
 * @property string $email
 *
 * @property Screening $screening
 */
class Ticket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['screening_id', 'seat', 'name', 'phone_num', 'email'], 'required'],
            [['screening_id'], 'integer'],
            ["email", "email"],
            ["name", "match", "pattern" => '/^[a-zA-Z\s]+$/', "message" => "Invalid characters in name."],
            [['name', 'email'], 'string', 'max' => 30],
            ["phone_num", "string", "max" => 10],
            ["phone_num", "match", "pattern" => '/^[0-9]+$/', "message" => "Phone number should contain only numbers."],
            [['screening_id'], 'exist', 'skipOnError' => true, 'targetClass' => Screening::class, 'targetAttribute' => ['screening_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'screening_id' => 'Movie',
            'seat' => 'Seat',
            'name' => 'Name',
            'phone_num' => 'Phone number',
            'email' => 'Email',
        ];
    }

    /**
     * Gets query for [[Screening]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\ScreeningQuery
     */
    public function getScreening()
    {
        return $this->hasOne(Screening::class, ['id' => 'screening_id']);
    }

    public function getMovie() {
        return $this->screening->hasOne(Movie::class, ["id" => "movie_id"]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\TicketQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\TicketQuery(get_called_class());
    }
}
