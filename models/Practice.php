<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "practices".
 *
 * @property int $id
 * @property string|null $practice_id
 * @property string|null $creation_date
 * @property string|null $status
 * @property string|null $note
 * @property int|null $client_id
 *
 * @property Clients $client
 */
class Practice extends \yii\db\ActiveRecord
{

    public $fiscal_code;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'practices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creation_date'], 'safe'],
            [['status', 'note'], 'string'],
            [['client_id'], 'integer'],
            [['practice_id'], 'string', 'max' => 255],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'practice_id' => 'Practice ID',
            'creation_date' => 'Creation Date',
            'status' => 'Status',
            'note' => 'Note',
            'client_id' => 'Client ID',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::class, ['id' => 'client_id'])->inverseOf('practice');
    }
}
