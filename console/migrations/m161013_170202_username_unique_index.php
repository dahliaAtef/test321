<?php

use yii\db\Schema;
use yii\db\Migration;

class m161013_170202_username_unique_index extends Migration
{
    public function up()
    {
        $this->execute("
               ALTER TABLE base_user DROP INDEX username_UNIQUE;
               ");
    }

    public function down()
    {
        echo "m161013_170202_username_unique_index cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
