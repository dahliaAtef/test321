<?php

use yii\db\Schema;
use yii\db\Migration;

class m161025_162903_AuthLogTbl extends Migration
{
    public function up()
    {
        $this->execute("
        CREATE TABLE `authlog` (
        `id`  int UNSIGNED NOT NULL AUTO_INCREMENT ,
        `user_id`  int UNSIGNED NULL ,
        `provider`  tinyint(1) NULL ,
        `message`  varchar(300) NULL ,
        `authlog`  text NULL ,
        `created`  timestamp NULL ON UPDATE CURRENT_TIMESTAMP ,
        `updated`  timestamp NULL  ,
        PRIMARY KEY (`id`)
        );
        
        ");
    }

    public function down()
    {
        echo "m161025_162903_AuthLogTbl cannot be reverted.\n";

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
