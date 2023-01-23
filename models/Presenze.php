<?php



namespace app\models;
use Yii;

/**
 * This is the model class for table "Presenze".
 *
 * @property int $id
 * @property string $entrata
 *
 * @property Presenze $id0
 */
class Presenze extends \yii\db\ActiveRecord

{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Presenze';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entrata'], 'required'],
            [['id'], 'integer'],
            [['entrata'], 'safe'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Presenze::class, 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entrata' => 'Entrata',
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Presenze::class, ['id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PresenzeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PresenzeQuery(get_called_class());
    }
}
