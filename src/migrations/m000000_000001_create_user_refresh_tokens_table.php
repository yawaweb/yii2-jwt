<?php

namespace yawaweb\yii2\jwt\migrations;

use yii\db\Migration;

class m000000_000001_create_user_refresh_tokens_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_refresh_tokens}}', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'user_id' => $this->integer(10)->unsigned()->notNull(),
            'token' => $this->string(1000)->notNull(),
            'ip' => $this->string(50)->notNull(),
            'user_agent' => $this->string(1000)->notNull(),
            'created_at' => $this->dateTime()->notNull()->comment('UTC'),
        ], 'COMMENT="For JWT authentication process"');

        $this->addForeignKey('fk-user_refresh_tokens-user_id', '{{%user_refresh_tokens}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        // Drop the foreign key constraint first
        $this->dropForeignKey('fk-user_refresh_tokens-user_id', '{{%user_refresh_tokens}}');

        // Then drop the table
        $this->dropTable('{{%user_refresh_tokens}}');
    }
}