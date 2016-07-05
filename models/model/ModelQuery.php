<?php
namespace pistol88\autocatalog\models\model;

use pistol88\autocatalog\models\Category;
use yii\db\ActiveQuery;

class ModelQuery extends ActiveQuery
{
    public function category($childCategoriesIds)
    {
         return $this->andwhere(['category_id' => $childCategoriesIds]);
    }
}