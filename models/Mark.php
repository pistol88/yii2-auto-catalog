<?php
namespace pistol88\autocatalog\models;

use yii\helpers\Url;
use Yii;

class Mark extends \yii\db\ActiveRecord
{
	function behaviors() {
        return [
            'images' => [
                'class' => 'pistol88\gallery\behaviors\AttachImages',
            ],
            'field' => [
                'class' => 'pistol88\field\behaviors\AttachFields',
            ],
        ];
	}

    public static function tableName()
    {
        return '{{%autocatalog_mark}}';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['image', 'text'], 'string'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название марки',
            'text' => 'Текст',
			'image' => 'Картинка',
        ];
    }
}
