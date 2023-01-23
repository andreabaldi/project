<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[osp]].
 *
 * @see osp
 */
class ospQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return osp[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return osp|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
