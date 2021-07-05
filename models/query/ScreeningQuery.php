<?php

namespace app\models\query;

use Yii;

/**
 * This is the ActiveQuery class for [[\app\models\Screening]].
 *
 * @see \app\models\Screening
 */
class ScreeningQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Screening[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Screening|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getScreeningsForToday() {
        return $this
            ->where("day=:day", [":day" => Yii::$app->formatter->asDate('now', 'yyyy-MM-dd')])
            ->andWhere([">", "start", date("H:i", time())]);
    }

    public function getUpcomingScreeningsForMovie($id) {
        $query = $this
            ->where("movie_id=:id", [":id" => $id])
            ->andWhere([">=", "day", Yii::$app->formatter->asDate('now', 'yyyy-MM-dd')])
            ->andWhere([">", "start", date("H:i", strtotime("+ 1 hour", time()))])
            ->orderBy(["day" => SORT_ASC]);

        return $query;
    }

    public function actualScreening($day, $start) {
        $screenings = $this->select("start, end")->where("day=:day", [":day" => $day])->asArray()->all();

        foreach($screenings as $screening) {
            if(strtotime($screening["start"]) <= strtotime($start) && strtotime($screening["end"]) >= strtotime($start)) {
                return true;
            }
        }

        return false;
    }

    public function getLastScreening($day, $start) {
        return $this
            ->where("day=:day", [":day" => $day])
            ->andWhere(["between", "end", date("H:i", strtotime("- 1 hour", strtotime($start))), $start])
            ->asArray()
            ->all();
    }
}
