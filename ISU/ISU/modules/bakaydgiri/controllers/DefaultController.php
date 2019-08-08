<?php

namespace app\modules\bakaydgiri\controllers;

use app\models\User;
use app\modules\admin\models\News;
use Yii;
use yii\web\Controller;

use app\modules\bakaydgiri\models\TeachersUpload;
use app\modules\bakaydgiri\models\StudentsUpload;
use app\modules\bakaydgiri\models\Teachers;
use app\modules\bakaydgiri\models\Students;
use app\modules\admin\models\Persons;
/**
 * Default controller for the `bakaydgiri` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $session=\Yii::$app->session;
        $session['tmp']='9';
        $session['is_online']=\Yii::$app->db->createCommand('UPDATE persons SET is_online=1 WHERE id_persons='.\Yii::$app->user->id)
            ->execute();


        $user = User::find()->where('id_persons=' . \Yii::$app->user->id)->one();


        $news = News::find()->where(['user_id' => $user['user_id'], 'id_teacher' => 0])->all();

        return $this->render('index', compact('news'));

    }


    public function actionLogout()
    {
        $user = User::find()->where('id_persons=' . \Yii::$app->user->id)->one();
        // $user->tmp = '';
        // $user->save();
        Yii::$app->user->logout();

        return $this->goHome();
    }



        public function actionImport()
    {
        
        // $import=TeachersUpload::find()->Asarray()->indexBy('id')->all();
        $import=StudentsUpload::find()->Asarray()->indexBy('id')->all();

        // debug($import);
        // echo 
        // exit;

         $count=count($import);
        

        
        
        
        if (!empty($import)) { 

            

            for ($i = 1; $i <= $count; $i++) {

                $id_persons=Students::getMaxIDStudents();

            // echo $id_persons['ID'].'<br>';     
            // exit;


            //echo $i;                 

                $model[$i] = new Persons();

                // if($id_teacher['ID'] > 0 and $id_teacher['ID'] <=9){
                //         $model[$i]->login ='pr1000'.$id_teacher['ID'];
                //         $model[$i]->password = Yii::$app->getSecurity()->generatePasswordHash('pr1000'.$id_teacher['ID']);
                // }
                // elseif($id_teacher['ID'] >= 10 and $id_teacher['ID'] <=99){
                //     $model[$i]->login ='pr100'.$id_teacher['ID'];
                //     $model[$i]->password = Yii::$app->getSecurity()->generatePasswordHash('pr100'.$id_teacher['ID']);
                // }
                // elseif($id_teacher['ID'] >= 100 and $id_teacher['ID'] <=999){
                //     $model[$i]->login ='pr10'.$id_teacher['ID'];
                //     $model[$i]->password = Yii::$app->getSecurity()->generatePasswordHash('pr10'.$id_teacher['ID']);
                // }
                // elseif($id_teacher['ID'] >= 1000 and $id_teacher['ID'] <=9999){
                //     $model[$i]->login ='pr1'.$id_teacher['ID'];
                //     $model[$i]->password = Yii::$app->getSecurity()->generatePasswordHash('pr1'.$id_teacher['ID']);
                // }

                if($id_persons['ID'] <> 0 and $id_persons['ID'] <=9){
                        $model[$i]->login ='st1000'.$id_persons['ID'];
                        $model[$i]->password = Yii::$app->getSecurity()->generatePasswordHash('st1000'.$id_persons['ID']);
                }
                elseif($id_persons['ID'] >= 10 and $id_persons['ID'] <= 99){
                    $model[$i]->login ='st100'.$id_persons['ID'];
                    $model[$i]->password = Yii::$app->getSecurity()->generatePasswordHash('st100'.$id_persons['ID']);
                }
                elseif($id_persons['ID'] >= 100 and $id_persons['ID'] <= 999){
                    $model[$i]->login ='st10'.$id_persons['ID'];
                    $model[$i]->password = Yii::$app->getSecurity()->generatePasswordHash('st10'.$id_persons['ID']);
                }
                elseif($id_persons['ID'] >= 1000 and $id_persons['ID'] <= 9999){
                   $model[$i]->login ='st1'.$id_persons['ID'];
                    $model[$i]->password = Yii::$app->getSecurity()->generatePasswordHash('st1'.$id_persons['ID']);
                }

                $model[$i]->surname =$import[$i]['nasab'];
                $model[$i]->name = $import[$i]['nom'];
                $model[$i]->middle_name = $import[$i]['nomi_padar'];

                $model[$i]->user_id = 3;
                $model[$i]->brithday = $import[$i]['soli_tavallud'];
                
                if($import[$i]['jins']==='М'){
                     $model[$i]->gender=0;
                }
                else $model[$i]->gender=1;

               
                $model[$i]->id_regions = 1;
                $model[$i]->id_zoning = 1;
                $model[$i]->adress = $import[$i]['suroga'];
                $model[$i]->id_nation = 1;
                $model[$i]->telefon = $import[$i]['telefon'];
                $model[$i]->persons_status=1;
              
            
           
            $model[$i]->save();


                $id=Students::getMaxIDPersons();

                $students[$i] = new Students();
                $students[$i]->persons_id=$id['ID'];
                $students[$i]->user_id=3;
                $students[$i]->namudi_tahsil=$import[$i]['namudi_tahsil'];
                $students[$i]->guruh=$import[$i]['guruh'];
                $students[$i]->status_st=1;


                $students[$i]->save();

               //  $teacher[$i] = new Teachers();
               //  $teacher[$i]->work= 'Омӯзгор';
               //  $teacher[$i]->unvon= $import[$i]['malumot'];
               // $teacher[$i]->persons_id=$id_teacher['ID'];
                
               //  if($import[$i]['kafedra']==='таҳсилоти ибтидоӣ'){
               //      $teacher[$i]->id_kafedra=1;
               //  }
               //  else 
               //      $teacher[$i]->id_kafedra=2;
                
               //  $teacher[$i]->teacher_stat_register=1;

               //  //debug(Yii::$app->request->post());
               //  $teacher[$i]->save();


            }

            }
        



        

       

        }
        

        
    


}

