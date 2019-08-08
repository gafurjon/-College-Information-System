<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id_menu
 * @property integer $parent_id
 * @property string $page
 * @property string $url
 * @property integer $menu_status
 * @property integer $order
 * @property string $ico
 * @property integer $status
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'required'],
            [['parent_id', 'menu_status', 'order', 'status'], 'integer'],
            [['page'], 'string', 'max' => 70],
            [['url'], 'string', 'max' => 255],
            [['ico'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_menu' => 'Id Menu',
            'parent_id' => 'Parent ID',
            'page' => 'Page',
            'url' => 'Url',
            'menu_status' => 'Menu Status',
            'order' => 'Order',
            'ico' => 'Ico',
            'status' => 'Status',
        ];
    }


}
