<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%departments}}`.
 */
class m190501_110311_create_departments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%departments}}', [
            'id' => $this->primaryKey(),
            'pid' => $this->integer(),
            'name' => $this->string(),
        ]);

        $this->addForeignKey(
            'fk_departments_pid',
            'departments',
            'pid',
            'departments',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%departments}}');
    }
}
