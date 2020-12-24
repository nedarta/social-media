<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Post]].
 *
 * @see Post
 */
class PostQuery extends \yii\db\ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return Post[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Post|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * find by keyword in the title and body with full text index
     *
     * @param $keyword
     * @return PostQuery
     */
    public function byKeyword($keyword)
    {
        return parent::andWhere("MATCH(title,body) AGAINST (:keyword)", ['keyword' => $keyword]);
    }
}
