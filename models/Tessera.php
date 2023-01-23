<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Tessera".
 *
 * @property int $id
 * @property string $dataRilascio
 * @property string $dataUltimoRinnovo
 * @property string $dataScadenza
 * @property string $QRfilename
 * @property string $TSfilename
 *
 * @property Ospiti $id0
 */
class Tessera extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Tessera';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'dataRilascio', 'dataUltimoRinnovo', 'dataScadenza', 'QRfilename', 'TSfilename'], 'required'],
            [['id'], 'integer'],
            [['dataRilascio', 'dataUltimoRinnovo', 'dataScadenza'], 'safe'],
            [['QRfilename', 'TSfilename'], 'string', 'max' => 128],
            [['id'], 'unique'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Ospiti::class, 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dataRilascio' => 'Data Rilascio',
            'dataUltimoRinnovo' => 'Data Ultimo Rinnovo',
            'dataScadenza' => 'Data Scadenza',
            'QRfilename' => 'Q Rfilename',
            'TSfilename' => 'T Sfilename',
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Ospiti::class, ['id' => 'id']);
    }
}
