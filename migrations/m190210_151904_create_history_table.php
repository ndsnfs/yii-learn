<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%history}}`.
 */
class m190210_151904_create_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%history}}', [
            'id' => $this->primaryKey(),
            'dt' => $this->dateTime()->notNull(),
            'messae' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%history}}');
    }
}
