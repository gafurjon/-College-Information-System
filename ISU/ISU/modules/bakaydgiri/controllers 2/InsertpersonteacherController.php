<?php

namespace app\modules\bakaydgiri\controllers;


use app\modules\admin\models\GroupStudents;
use app\modules\admin\models\Insert_Persons;
use app\modules\admin\models\Persons;
use app\modules\admin\models\Kafedra;
use app\modules\bakaydgiri\models\Teachers;
use app\modules\bakaydgiri\models\Nations;
use app\modules\bakaydgiri\models\Regions;
use app\modules\bakaydgiri\models\Students;
use app\modules\bakaydgiri\models\Zoning;
use Yii;
use yii\web\UploadedFile;




class InsertpersonteacherController extends \yii\web\Controller
{
    public function actionIndex()
    {
         

        $region=Regions::find()->all();
        $zoning=Zoning::find()->all();
        $nation=Nations::find()->all();
        $kafedra=Kafedra::find()->all();

        $model = new Insert_Persons();
        if (Yii::$app->request->post()) {

            if ($model->load(Yii::$app->request->post())) {


                $model->picture = UploadedFile::getInstance($model, 'picture');

                $post = Yii::$app->request->post('picture');

                if ($model->picture) {
                    $dir = 'image/users/';
                    $path = $model->picture->baseName . '.' . $model->picture->extension;
                    $model->picture->saveAs($dir . md5($path) . "." . $model->picture->extension);
                    $model->picture = $dir . md5($path) . "." . $model->picture->extension;
                }
                 $id_persons=Teachers::getMaxIDPersons();
                 $id_teacher=Teachers::getMaxIDTeacher();
                $model->surname =Yii::$app->request->post('surname');
                $model->name = Yii::$app->request->post('name');
                $model->middle_name = Yii::$app->request->post('middle_name');


                if($id_teacher['ID'] > 0 and $id_teacher['ID'] <=9){
                        $model->login ='pr1000'.$id_teacher['ID'];
                        $model->password = Yii::$app->getSecurity()->generatePasswordHash('pr1000'.$id_teacher);
                }
                elseif($id_teacher['ID'] >= 10 and $id_teacher['ID'] <=99){
                    $model->login ='pr100'.$id_teacher['ID'];
                    $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->login);
                }
                elseif($id_teacher['ID'] >= 100 and $id_teacher['ID'] <=999){
                    $model->login ='pr10'.$id_teacher['ID'];
                    $model->password = Yii::$app->getSecurity()->generatePasswordHash('pr10'.$id_teacher);
                }
                elseif($id_teacher['ID'] >= 1000 and $id_teacher['ID'] <=9999){
                    $model->login ='pr1'.$id_teacher['ID'];
                    $model->password = Yii::$app->getSecurity()->generatePasswordHash('pr1'.$id_teacher);
                }

                $model->user_id = 2;
                $model->brithday = Yii::$app->request->post('s_tav');
                $model->gender=Yii::$app->request->post('jins');
                $model->id_regions = Yii::$app->request->post('viloyat');
                $model->id_zoning = Yii::$app->request->post('nohiya');
                $model->adress = Yii::$app->request->post('suroga');
                $model->id_nation = Yii::$app->request->post('millat');
                $model->telefon = Yii::$app->request->post('telefon');


                $model->persons_status=1;
                //$model->save();*/
               // debug($id_persons);

            }
            $model->save();
            if ($model->save()) {
                $save = 1;

                $id=Teachers::getMaxIDPersons();

                $teacher = new Teachers();
                $teacher->work= 'Омӯзгор';
                $teacher->unvon= Yii::$app->request->post('unvon');
                $teacher->id_teacher=$id['ID'];
                $teacher->id_kafedra=Yii::$app->request->post('kafedra');
                $teacher->teacher_stat_register=1;

                //debug(Yii::$app->request->post());
                $teacher->save();
            }
        }

        $teachers = Teachers::find()->asArray()
        ->joinWith('person')
        ->orderBy(['persons.id_persons' => SORT_DESC])
            ->all();
       

        return $this->render('index',compact('model', 'save', 'region', 'zoning','nation','kafedra','teachers'));
    }


    public function actionTeachers($amal='')
    {
        $id_teacher=Yii::$app->request->post('id');

        if(Yii::$app->request->post('oper')==true && Yii::$app->request->post('oper')=='edit'){

            $teacher=Teachers::find()->where(['teachers.id_teacher'=>$id_teacher])->one();
            $person=Persons::find()->where(['persons.id_persons'=>$teacher['id_teacher']])->one();

            // echo '<pre>';
            //     print_r($person);
            // echo '</pre>';
            // exit;

            $teacher->work=Yii::$app->request->post('work');
            $teacher->unvon=Yii::$app->request->post('daraja');


            $person->surname=Yii::$app->request->post('fio_surname');
            $person->name=Yii::$app->request->post('fio_name');
            $person->middle_name=Yii::$app->request->post('fio_middlename');
            $person->adress=Yii::$app->request->post('fio_middlename');
            $person->telefon=Yii::$app->request->post('telefon');

            $teacher->save();
            $person->save();

            echo 'Маълумот иваз карда шуд!!!';
        }

        if(Yii::$app->request->post('oper')==true && Yii::$app->request->post('oper')=='add') {

            $persons=Yii::$app->db->createCommand('SELECT MAX(login) as login  FROM persons WHERE user_id=2')->queryOne();

            $person= New Persons();

            $person->surname=Yii::$app->request->post('fio_surname');
            $person->name=Yii::$app->request->post('fio_name');
            $person->middle_name=Yii::$app->request->post('fio_middlename');
            $person->adress=Yii::$app->request->post('fio_middlename');
            $person->telefon=Yii::$app->request->post('telefon');
            $person->save();

            echo 'Маълумот нав дохил карда шуд!!!';}



            if(Yii::$app->request->post('oper')==true && Yii::$app->request->post('oper')=='del'){

            
            //$students=Students::find()->where(['students.id_students'=>$id_teacher])->one();
            $students=Students::find()->where('students.id_students'=>$id_teacher)->all();

            
            echo '<pre>';
                print_r($students);
            echo '</pre>';
            exit;

          
            $students->status=0;
            $students->save();
           

            echo 'Маълумот иваз карда шуд!!!';
        }




    }






}
