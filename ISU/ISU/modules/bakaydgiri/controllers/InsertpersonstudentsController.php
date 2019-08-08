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


class InsertpersonstudentsController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $region=Regions::find()->all();
        $zoning=Zoning::find()->all();
        $nation=Nations::find()->all();
        $group_students=GroupStudents::find()->joinWith('profession')->orderBy('course')->all();
        
        // debug( $group_students);
        // exit;

        $model = new Insert_Persons();


        if (Yii::$app->request->post()) {

            if ($model->load(Yii::$app->request->post())) {


                $model->picture = UploadedFile::getInstance($model, 'picture');

                $post = Yii::$app->request->post('picture');

                if ($model->picture) {
                    $dir = 'image/donishju/';
                    $path = $model->picture->baseName . '.' . $model->picture->extension;
                    $model->picture->saveAs($dir . md5($path) . "." . $model->picture->extension);
                    $model->picture = $dir . md5($path) . "." . $model->picture->extension;
                }
                $id_persons=Students::getMaxIDStudents();
                $model->surname =Yii::$app->request->post('surname');
                $model->name = Yii::$app->request->post('name');
                $model->middle_name = Yii::$app->request->post('middle_name');


                if($id_persons['ID'] > 0 and $id_persons['ID'] <=9){
                        $model->login ='st1000'.$id_persons['ID'];
                        $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->login);
                }
                elseif($id_persons['ID'] >= 10 and $id_persons['ID'] <= 99){
                    $model->login ='st100'.$id_persons['ID'];
                    $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->login);
                }
                elseif($id_persons['ID'] >= 100 and $id_persons['ID'] <= 999){
                    $model->login ='st10'.$id_persons['ID'];
                    $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->login);
                }
                elseif($id_persons['ID'] >= 1000 and $id_persons['ID'] <= 9999){
                    $model->login ='st1'.$id_persons['ID'];
                    $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->login);
                }

                $model->user_id = 3;
                $model->brithday = Yii::$app->request->post('s_tav');
                $model->gender=Yii::$app->request->post('jins');
                $model->id_regions = Yii::$app->request->post('viloyat');
                $model->id_zoning = Yii::$app->request->post('nohiya');
                $model->adress = Yii::$app->request->post('suroga');
                $model->id_nation = Yii::$app->request->post('millat');
                $model->telefon = Yii::$app->request->post('telefon');


                $model->persons_status=1;
                //$model->save();
                //debug($model);

            }
            $model->save();
            if ($model->save()) {
                $save = 1;

                $id=Students::getMaxIDPersons();

                $students = new Students();
                $students->id_students=$id['ID'];
                $students->user_id=3;
                $students->bujet=Yii::$app->request->post('bujet');
                $students->id_group=Yii::$app->request->post('group');
                $students->status_st=Yii::$app->request->post('tahsil');


                $students->save();
            }
        }

        $students = Students::find()->asArray()
        ->joinWith('person')
        ->orderBy(['persons.id_persons' => SORT_DESC])
            ->all();

            // debug($teachers);
            // exit;


        return $this->render('index',compact('model', 'save', 'region', 'zoning','nation','group_students','students'));
    }



        public function actionStudents($amal='')
    {
        $id_students=Yii::$app->request->post('id');

        if(Yii::$app->request->post('oper')==true && Yii::$app->request->post('oper')=='edit'){

            $teacher=Students::find()->where(['students.id_students'=>$id_students])->one();
            $person=Persons::find()->where(['persons.id_persons'=>$teacher['id_students']])->one();

            // echo '<pre>';
            //     print_r($person);
            // echo '</pre>';
            // exit;

            $teacher->bujet=Yii::$app->request->post('work');
            $teacher->status_st=Yii::$app->request->post('daraja');


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

            $persons=Yii::$app->db->createCommand('SELECT MAX(login) as login  FROM persons WHERE user_id=3')->queryOne();

            $person= New Persons();

            $person->surname=Yii::$app->request->post('fio_surname');
            $person->name=Yii::$app->request->post('fio_name');
            $person->middle_name=Yii::$app->request->post('fio_middlename');
            $person->adress=Yii::$app->request->post('fio_middlename');
            $person->telefon=Yii::$app->request->post('telefon');
            $person->save();

            echo 'Маълумот нав дохил карда шуд!!!';}





             if(Yii::$app->request->post('oper')==true && Yii::$app->request->post('oper')=='del'){

            
            $students=Students::find()->where(['students.id_students'=>$id_students])->one();
            //$students=Students::find()->where(['students.id_students='.$id_students])->all();

            
            // echo '<pre>';
            //     print_r($students);
            // echo '</pre>';
            // exit;

          
            $students->status=0;
            $students->save();
           

            echo 'Маълумот иваз карда шуд!!!';
        }



    }

    




}
