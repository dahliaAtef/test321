<?php

use yii\db\Schema;
use yii\db\Migration;

class m161003_132802_model_impressions_clicks extends Migration
{
    public function up()
    {
        $this->execute("
       ALTER TABLE `model` ADD `clicks` INT(10) NOT NULL AFTER `shares`, ADD `impressions` INT(10) NOT NULL AFTER `clicks`;
       ");
    }

    public function down()
    {
        echo "m161003_132802_model_impressions_clicks cannot be reverted.\n";

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
