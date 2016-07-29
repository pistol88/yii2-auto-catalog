<?php
namespace pistol88\autocatalog\models;

use Yii;
use yii\helpers\Url;
use pistol88\autocatalog\models\Category;
use pistol88\autocatalog\models\Price;
use pistol88\autocatalog\models\model\ModelQuery;
use yii\db\ActiveQuery;

class Model extends \yii\db\ActiveRecord
{
	function behaviors()
    {
        return [
            'images' => [
                'class' => 'pistol88\gallery\behaviors\AttachImages',
            ],
            'toCategory' => [
                'class' => 'voskobovich\manytomany\ManyToManyBehavior',
                'relations' => [
                    'category_ids' => 'categories',
                ],
            ],
            'field' => [
                'class' => 'pistol88\field\behaviors\AttachFields',
            ],
        ];
	}
	
    public static function tableName()
    {
        return '{{%autocatalog_model}}';
    }
    
	public static function Find()
    {
        $return = new ModelQuery(get_called_class());
        $return = $return->with('category');
        
        return $return;
    }
    
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['category_id', 'mark_id', 'sort'], 'integer'],
            [['text', 'code'], 'string'],
            [['category_ids'], 'each', 'rule' => ['integer']],
            [['name'], 'string', 'max' => 200],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Код (актикул)',
            'category_id' => 'Главная категория',
            'mark_id' => 'Марка',
            'name' => 'Название',
            'text' => 'Текст',
            'images' => 'Картинки',
            'sort' => 'Сортировка',
        ];
    }
    
    public function getId()
    {
        return $this->id;
    }
    
	public function getCategory()
    {
		return $this->hasOne(Category::className(), ['id' => 'category_id']);
	}
    
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
             ->viaTable('{{%autocatalog_model_to_category}}', ['model_id' => 'id']);
    }
	
	public function getMark()
    {
		return $this->hasOne(Mark::className(), ['id' => 'mark_id']);
	}

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

        if(!empty($this->category_id) && !empty($this->id)) {
            if(!(new \yii\db\Query())
            ->select('*')
            ->from('{{%autocatalog_model_to_category}}')
            ->where('model_id ='.$this->id.' AND category_id = '.$this->category_id)
            ->all()) {
                yii::$app->db->createCommand()->insert('{{%autocatalog_model_to_category}}', [
                    'model_id' => $this->id,
                    'category_id' => $this->category_id,
                ])->execute();
            }
        }
        
        return true;
    }
}
