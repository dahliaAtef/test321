<?php

use yii\db\Schema;
use yii\db\Migration;

class m160923_213510_EditAuthUsersTBL extends Migration
{
    public function up()
    {
       $this->execute("
       ALTER TABLE `authclient`
       ADD COLUMN `source_data`  longtext NULL AFTER `source_id`;
       ");
    }

    public function down()
    {
        echo "m160923_213510_EditAuthUsersTBL cannot be reverted.\n";

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
