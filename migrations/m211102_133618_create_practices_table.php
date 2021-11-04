<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%practices}}`.
 */
class m211102_133618_create_practices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%practices}}', [
            'id' => $this->primaryKey(),
            'practice_id' => $this->string(),
            'creation_date' => $this->date(),
            'status' => "ENUM('Open', 'Close')",
            'note' => $this->text(),
            'client_id' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);

        $this->addForeignKey(
            'fk_practices_clients',
            'practices',
            'client_id',
            'clients',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%practices}}');
    }
}
