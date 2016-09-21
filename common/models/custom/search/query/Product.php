<?php

namespace common\models\custom\query;

class Product extends \yii\db\ActiveQuery {

    /**
     * Gets the parents products.
     * @return \yii\db\ActiveQuery the owner
     */
    public function parents() {
        return $this->andWhere(['parent_id' => null]);
    }
    
    /**
     * Gets the childs products.
     * @param int $parentId
     * @return \yii\db\ActiveQuery the owner
     */
    public function childs($parentId = null) {
        return $parentId ? $this->andWhere(['parent_id' => $parentId]) : $this->andWhere(['IS NOT', 'parent_id', null]);
    }
    
    /**
     * Checks the product in stock.
     * @param int $qty
     * @return \yii\db\ActiveQuery the owner
     */
    public function inStock($qty = 1) {
        return $this->andWhere(['>=', 'qty', $qty]);
    }
    
    /**
     * Checks the product is valid to cart.
     * @param int $qty
     * @return \yii\db\ActiveQuery the owner
     */
    public function validToCart($qty = 1) {
        return $this->childs()->inStock($qty);
    }
    
    
    public function defaultOrder() {
        return $this->addOrderBy(['sort' => SORT_ASC, 'id' => SORT_DESC]);
    }

}
