<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $fiscal_code
 * @property string|null $note
 *
 * @property Practices[] $practices
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['note'], 'string'],
            [['first_name', 'last_name', 'fiscal_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'fiscal_code' => 'Fiscal Code',
            'note' => 'Note',
        ];
    }

    /**
     * Gets query for [[Practices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPractice()
    {
        return $this->hasMany(Practice::class, ['client_id' => 'id'])->inverseOf('client');
    }
}
