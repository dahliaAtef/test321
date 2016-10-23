<?php

use yii\db\Schema;
use yii\db\Migration;

class m161023_121408_remove_email_unique extends Migration
{
    public function up()
    {
        $this->execute("
               ALTER TABLE base_user DROP INDEX email_UNIQUE;
               ");
    }

    public function down()
    {
        echo "m161023_121408_remove_email_unique cannot be reverted.\n";

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
