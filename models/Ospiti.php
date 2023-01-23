<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Ospiti".
 *
 * @property int $id
 * @property string|null $cognome
 * @property string|null $nome
 * @property string|null $nascita
 * @property string $genere
 * @property string $nazionalita
 *
 * @property Presenze[] $presenzes
 * @property Tessera[] $tesseras
 */
class Ospiti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Ospiti';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'genere', 'nazionalita'], 'required'],
            [['id'], 'integer'],
            [['nascita'], 'safe'],
            [['cognome', 'nome'], 'string', 'max' => 30],
            [['cognome', 'nome'], 'match','pattern' => '/^[a-z]\w*$/i'],
            [['genere'], 'string', 'max' => 1],
            [['nazionalita'], 'string', 'max' => 25],
            [['genere'],'in', 'range' => ['F','M']],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cognome' => 'Cognome',
            'nome' => 'Nome',
            'nascita' => 'Nascita',
            'genere' => 'Genere',
            'nazionalita' => 'Nazionalita',
        ];
    }

    /**
     * Gets query for [[Presenzes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPresenzes()
    {
        return $this->hasMany(Presenze::class, ['id' => 'id']);
    }

    /**
     * Gets query for [[Tesseras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTesseras()
    {
        return $this->hasMany(Tessera::class, ['id' => 'id']);
    }
}
