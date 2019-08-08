<?php

namespace app\modules\teacher\models;

use app\modules\teacher\models\Week;
use Yii;
use yii\db\Query;

use app\modules\teacher\models\RatingDates;


/**
 * This is the model class for table "lessons_day".
 *
 * @property integer $id_day
 * @property string $datedars
 * @property string $type
 * @property integer $id_week
 * @property integer $open_close
 *
 * @property Week $idWeek
 */
class LessonsDay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lessons_day';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datedars', 'type', 'id_week'], 'required'],
            [['datedars'],'unique'],
            [['id_week', 'open_close'], 'integer'],
            [['datedars'], 'string', 'max' => 10],
            [['type'], 'string', 'max' => 20],
            [['id_week'], 'exist', 'skipOnError' => true, 'targetClass' => Week::className(), 'targetAttribute' => ['id_week' => 'id_week']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_day' => 'Id Day',
            'datedars' => 'Datedars',
            'type' => 'Type',
            'id_week' => 'Id Week',
            'open_close' => 'Open Close',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdWeek()
    {
        return $this->hasOne(Week::className(), ['id_week' => 'id_week']);
    }
    public static function generator($from_dates,$to_dates){

        $from_date = new \DateTime($from_dates);
        $to_date = new \DateTime($to_dates);
        $to_date->modify('+1 day');

        $period = new \DatePeriod($from_date, new \DateInterval('P1D'), $to_date);
        $arrayOfDates = array_map(
            function($item){return $item->format('Y-m-d');},
            iterator_to_array($period)
        );

        $holiday = Holiday::find()->asArray()->all();
        $i=0;

        foreach($holiday as $row){
            $privlegday[$i]=$row['date'];
            $privlegdayname[$i]=$row['holiday_name'];
            $i++;

        }

        for ($i=0; $i<=Count($arrayOfDates)-1;$i++) {
            $day = strtotime($arrayOfDates[$i]);

            $lessonday = new LessonsDay();
            $lessonday->datedars = $arrayOfDates[$i];

            if (in_array($arrayOfDates[$i], $privlegday)) {

                $key = array_keys($privlegday, $arrayOfDates[$i]);
                $lessonday->type = $privlegdayname[$key[0]];
            }
        elseif(date('w', $day)==0){
                $lessonday->type="истироҳат";
            }
            else{
                $lessonday->type="дарсӣ";
            }
            $lessonday->id_week=date('w',$day);

            if($lessonday->save()){
                //$l=LessonsDay::model()->findByPk(1);
                //echo "Ok <br />";
            }
            //else echo "Hi <br />";
        }

        $query = new Query();
        $results = $query
            ->select('*')
            ->from([LessonsDay::tableName().' as c', Week::tableName().' as w'])
            ->where('datedars between "'.$from_dates.'" and "'.$to_dates.'" and c.id_week=w.id_week order by datedars')
            ->all();


        return $results;

    }
    public static function getDate($lesson_times,$rating_dates){
        $r=0;

        
          $date_on=$rating_dates[0]['date_on'];
          $date_off=$rating_dates[0]['date_off'];
       

        foreach($lesson_times as $lesson_time){
            
                     


            $query = new Query();
            $lesson_day[$r] = $query
                ->select('ld.id_day, ld.datedars, ld.type, w.name_tj,ld.open_close, t.id_lesson_time')
                ->from([LessonsDay::tableName().' as ld', Week::tableName().' as w', LessonTime::tableName().' as t',
                    RatingDates::tableName().' as rt'])
                ->where("ld.id_week=w.id_week and ld.id_week=:id_week and t.id_lesson_time=:id_lesson_time and 
                    ld.`datedars` BETWEEN '".$date_on."' AND '".$date_off."'" ,[':id_week'=>$lesson_time['id_week'],
                    ':id_lesson_time'=>$lesson_time['id_lesson_time']])
                ->GroupBy('datedars')
                ->all();

               



            //$lesson_day[$r] = LessonsDay::find()->where('id_week=:id_week ',[':id_week'=>$lesson_time['id_week']])->asArray()->all();
        $r++;
        }
            // sort($lesson_day);
            
               
        for($i=0;$i<=count($lesson_day[0])-1;$i++){
            for($j=0;$j<=count($lesson_day)-1;$j++){
               
                
                
                $lesson_days[$i][$j]=$lesson_day[$j][$i];

                //

            
            }

        }
       //     debug($lesson_days);
       // exit;
        return $lesson_days;
    }

    
    public function getTime()
    {
        return $this->hasMany(LessonTime::className(), ['id_week' => 'id_week']);
    }
}
