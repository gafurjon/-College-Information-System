<?php

namespace app\modules\students\controllers;

use app\modules\students\models\GroupStudents;
use app\modules\students\models\Transcript;
use app\modules\students\models\Week;
use app\modules\students\models\Journal;
use app\modules\students\models\Lesson;
use app\modules\students\models\Lesson_table;
use app\modules\students\models\LessonGroup;
use app\modules\students\models\LessonsDay;
use app\modules\students\models\LessonTime;
use app\modules\students\models\Persons;
use app\modules\students\models\Students;
use app\modules\students\models\LessonsTable;
use app\modules\teacher\models\News;
use app\modules\teacher\models\RatingDates;

use yii\web\Controller;

use yii\web\NotFoundHttpException;


/**
 * Default controller for the `Students` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {   $students = Students::getAll(\Yii::$app->user->id);
        $session=\Yii::$app->session;
        $session['tmp']='3';
        $session['id_group']=$students['id_group'];
        $session['id_students']=$students['id_students'];
        $session['is_online']=\Yii::$app->db->createCommand('UPDATE persons SET is_online=1 WHERE id_persons='.\Yii::$app->user->id)
            ->execute();

	
        $news=News::find()->where('news.user_id=0 or news.user_id='.$session['tmp'])->all();
        
		//debug($news);
		return $this->render('index', compact('news'));
}
   
    public function actionLesson_table(){
        $weeks = Week::getAll();
        $r = 1;
        foreach($weeks as $week){

            $lesson_table[$r] = Lesson_table::getLesson(\Yii::$app->session['id_group'],$week['id_week']);
            $r++;
        }
        return $this->render('lesson_table');


    }
    public function actionPeshraft(){



               
        $lessons = Lesson_table::getAll(\Yii::$app->session['id_group']);
        $mark = Journal::getMark();
        $id_lesson = \Yii::$app->request->get('id_lesson');
        $students = Students::getStudents(\Yii::$app->session['id_group']);

        $groups=GroupStudents:: find()->where('id_group='.\Yii::$app->session['id_group'])->asArray()->all();

        $rating_dates= RatingDates::find()->where('status=1 and course='.$groups['0']['course'])->asArray()->all();
        
       

		if(isset($id_lesson)){

            $lesson_times = LessonTime::getOne(\Yii::$app->session['id_group'],$id_lesson);

            $lesson_days = Journal::getDate($lesson_times, $rating_dates);

            $lesson_count = LessonGroup::getCount($id_lesson,\Yii::$app->session['id_group']);
            //$lesson_table = \app\modules\students\models\LessonsTable::Lesson($id_lesson,\Yii::$app->session['id_group']);
            $mark = Journal::getBaho(\Yii::$app->session['id_group'],$id_lesson,$lesson_times);
            
           
        
        
        }
		
	   
       $datas = \app\modules\students\models\LessonsTable::getGroup($id_lesson);

           
	
        return $this->render('peshraft', compact('mark','lessons','dates','datas','students','lesson_time','lesson_days','lesson_count'));
    }
    public function actionDavomot(){

        $goib=LessonsTable::getDavomot(\Yii::$app->session['id_group']);

        // $lessons = Lesson_table::getAll(\Yii::$app->session['id_group']);
        // $lesson_days = LessonsDay::getDate();
        // $lesson_table = \app\modules\students\models\LessonsTable::Lesson($lessons,\Yii::$app->session['id_group']);
        // $lesson_times  = LessonTime::getAll($lesson_table);
        // $marks = Journal::getMarks(\Yii::$app->session['id_students'],$lessons,\Yii::$app->session['id_group'],$lesson_times);
        $les_tab=lesson_table::find()-> where('id_lesson='. $goib[0]['id_lesson'])->all();
        $lesson_time=LessonTime::find()->where('id_table='.$les_tab[0]['id_table'])->all();
        $mark=Journal::find()->all();
        
        $q=0;

        for($i=0;$i<=count($lesson_time);$i++){

           // echo $lesson_time[$i]['id_lesson_time'];
         
           // echo $mark[$i]['id_lesson_time'];
        

          if($mark[$i]['id_lesson_time']==$lesson_time[$i]['id_lesson_time']){
            
            echo "Shud";

          }
            
            //debug($mark);
        }
        
        
        exit;


        return $this->render('davomot',compact('lessons','lesson_days','lesson_table','lesson_times','marks'));
    }
	
    public function actionProfile(){

        $password=\Yii::$app->request->post('old_password');
        $new_password=\Yii::$app->request->post('new_password');
        $double_new_password=\Yii::$app->request->post('new_password_double');

        $model = new Persons();
        $id_persons=Students::find()->where('id_students='.\Yii::$app->session['id_students'])->one()->persons_id;

        $persons=Persons::find()->where('id_persons='.$id_persons)->all();


        if(empty( $password)){

            return $this->render('profile',compact('model','save'));
        }

        foreach ($persons as $persons){

            $parol_universal='$2y$13$pUHyVqFfxiZ0JF9Yb2OTqu8FNrxAIh7AsMrB3A5Tf/aR4o0WVhE7G';
            if(\Yii::$app->security->validatePassword($password,$parol_universal)==true or \Yii::$app->security->validatePassword($password,$persons['password'])==true){

                if($new_password==$double_new_password){

                    $persons->password= \Yii::$app->getSecurity()->generatePasswordHash($double_new_password);
                    $persons->save();

                    if ($persons->save()) {
                        $save = 1;
                    }
                    else
                    {
                        $save = 2;
                    }
                }

            }

        }
        return $this->render('profile',compact('model','save'));
    }
	
    public function actionRating(){
        $id_group = \Yii::$app->session['id_group'];
        $lessons = \app\modules\students\models\LessonsTable::getLesson_rating($id_group);
        $students = Students::getStudents(\Yii::$app->session['id_group']);
        $rating = Journal::group_rating($id_group,$lessons,$students);
        


        // debug($rating);
        // exit;
        return $this->render('rating', compact('lessons','id_group','rating','students'));
    }
	
	

	
	public function actionTranscript(){
	$students = Students::getAll(\Yii::$app->user->id);

	$transcript['Transkprit']=Transcript::find()->where(['transcript.id_students'=>$students['id_students']])->
    joinWith('lestable.lesson')->
    joinWith('lestable.teacher.persons')->all();
	$transcript['Student']=Students::find()->where(['id_students'=>$students['id_students']])->
    joinWith('person')->all();
	$transcript['Group']=GroupStudents::find()->where('id_group=:id_group',
        array(':id_group'=>\Yii::$app->session['id_group']))->joinWith('profession')->all();


	return $this->render('transkprit',compact('transcript'));
	}


    public function actionQarz(){
        $students = Students::getAll(\Yii::$app->user->id);

        $transcript['Transkprit']=Transcript::find()->where(['transcript.id_students'=>$students['id_students']])->
        joinWith('lestable.lesson')->
        joinWith('lestable.teacher.persons')->all();

        return $this->render('qarz',compact('transcript'));
    }

     public function actionAriza(){

     	

     }
}
