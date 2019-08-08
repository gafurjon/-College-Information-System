<?php
/* @var $model app\models\LoginForm */
namespace app\modules\admin\controllers;

use app\modules\admin\models\Journal;
use app\modules\admin\models\News;
use app\models\User;
use app\modules\admin\models\Test;
use app\modules\admin\models\Users;
use app\modules\admin\models\Persons;
use app\modules\admin\models\Faculty;
use app\modules\admin\models\LessonGroup;
use app\modules\admin\models\LessonTime;
use app\modules\admin\models\TeacherLesson;
use app\modules\admin\models\TimeLesson;
use Yii;
use app\modules\admin\models\LessonCategory;
use app\modules\admin\models\Teachers;
use app\modules\admin\models\Students;
use app\modules\admin\models\Lessons;
use app\modules\admin\models\lessonsTable;
use app\modules\admin\models\TeachersDay;
use app\modules\admin\models\GroupStudents;
use app\modules\admin\models\Week;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;


use app\modules\admin\models\LessonsDay;

/**
 * AdminController implements the CRUD actions for LessonCategory model.
 */

class AdminController extends Controller
{

    /**
     * Lists all LessonCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
    

       

        $session=\Yii::$app->session;
        $session['tmp']='1';    

        $user = User::find()->where('id_persons=' . \Yii::$app->user->id)->one();
        $news = News::find()->where(['user_id' => $user['user_id'], 'id_teacher' => 0])->all();

        

        
        return $this->render('index', compact('news'));

    }

    /**
     * Displays a single LessonCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new LessonCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LessonCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_category]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing LessonCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_category]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing LessonCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LessonCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LessonCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LessonCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



    //------------------------Administrator------------


    /**
     * @return string
     */

    public function actionGroup() // Шудаги
    {
        // $data=GroupStudents::find()->all();
        $group = GroupStudents::find()->
        joinWith('profession')->
        joinWith('faculty')->
        orderBy(['year' => SORT_DESC])
            ->all();


        return $this->render('group', compact('group'));
    }// кисман Шудаги 100%


    public function actionGroupStudent()
    {
        $id_group = Yii::$app->request->get('id');


        $group_student = Students::find()
            ->joinWith('person')
            ->joinWith('group')
            ->joinWith('group.faculty')
            ->joinWith('group.profession')
            ->where(['students.id_group' => $id_group])
            ->orderBy(['surname' => SORT_ASC])
            ->all();


        return $this->render('group_students', compact('group_student'));
    }// шудаги 80%


    public function actionProfil()
    {

        $id = 12;

        $teachers = Teachers::find()->where(['id_teacher' => $id])->joinWith('person')->joinWith('person.nations')->
        asArray()->all();

//        echo '<pre>';
//        print_r($teacher);
//        echo '</pre>';

        return $this->render('profil', compact('teachers'));
    }


    public function actionStatus()
    {

        $status = Users::find()->joinWith('persons')->joinWith('menu')->asArray()->
        indexBy('user_id')->all();
        $user = Users::find()->all();
//        echo '<pre>';
//            print_r($status);
//        echo '</pre>';

        return $this->render('Users', compact('status', 'user'));
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }



        public function actionDate_generator()
    {

        return $this->render('date_generator');
    }

    public function actionGenerator($from_date, $to_date)
    {
        $weeks = \app\modules\teacher\models\Week::getAll();


        $lessondays = LessonsDay::generator($from_date, $to_date);

        //$lessondays = LessonsDay::generator($from_date,$to_date);

        if (date('w', strtotime($from_date)) > 0 && date('w', strtotime($to_date)) > 0) {
            $count = (count($lessondays) / count($weeks)) + 1;
        } elseif (date('w', strtotime($from_date)) == 0) {
            $count = (count($lessondays) / count($weeks)) + 1;
        } elseif (date('w', strtotime($from_date)) == 6) {
            $count = (count($lessondays) / count($weeks)) + 2;
        }


        echo "<table class='table table-bordered table-striped dataTable'>";
        echo "<tr><th style='text-align: center'>Рӯзҳо</th>";
        for ($i = 1; $i <= $count; $i++) {
            echo "<th style='text-align: center'>Рузҳо</th>";
        }
        echo "</tr>";
        $r = -1;
        $rr = date('w', strtotime($to_date));
        foreach ($weeks as $week) {

            echo "<tr><td>" . $week['name_tj'] . "</td>";
            if (date('w', strtotime($from_date)) > 0 && $r !== (date('w', strtotime($from_date)) - 1)) {
                echo "<td><br><hr></td>";
                $r++;
            }

            foreach ($lessondays as $lessonday) {

                if ($week['id_week'] === $lessonday['id_week']) {
                    echo "<td nowrap='nowrap' style='text-align: center;";
                    if ($lessonday['type'] <> 'дарсӣ') {
                        echo 'background-color:rgba(255, 0, 0, 0.74);';
                    }
                    echo "'>" . $lessonday['datedars'] . "<br><hr>" . $lessonday['type'] . "</td>";
                }
            }

            if ($rr !== (date('w', strtotime($to_date))) && $week['id_week'] > date('w', strtotime($to_date))) {
                echo "<td><br><hr></td>";
            }
            $rr++;

            echo "</tr>";
        }
        echo "</table>";

    }

}