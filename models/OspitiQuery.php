<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Ospiti]].
 *
 * @see Ospiti
 */
class OspitiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Ospiti[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Ospiti|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
