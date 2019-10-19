<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders_dict_status}}`.
 */
class m191018_182928_create_orders_dict_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders_dict_status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'color' => $this->string()->null(),
            'text_color' => $this->string()->notNull(),
            'parent_id' => $this->integer()->notNull(),
            'alias' => $this->string()->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders_dict_status}}');
    }
}
