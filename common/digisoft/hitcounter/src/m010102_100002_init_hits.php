<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m010102_100002_init_hits.php
 */
class m010102_100002_init_hits extends Migration {

    /**
     * Create table `hits`
     */
    public function up() {
        $this->createTable('{{%hits}}', [
            'hit_id' => Schema::TYPE_PK,
            'user_agent' => Schema::TYPE_STRING . ' NOT NULL',
            'ip' => Schema::TYPE_STRING . ' NOT NULL',
            'target_group' => Schema::TYPE_STRING . ' NOT NULL',
            'target_pk' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    /**
     * Drop table `Comment`
     */
    public function down() {
        $this->dropTable('{{%hits}}');
    }

}
