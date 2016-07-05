<?php
namespace pistol88\autocatalog\models\category;

use yii\db\ActiveQuery;
class CategoryQuery extends ActiveQuery
{
    public function popular()
    {
         return $this->andWhere(['is_popular' => 'yes']);
    }
}