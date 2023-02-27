<?php

namespace console\migrations;

use yii\db\Migration;

final class M230221134832CreateAuctionUsers extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(
            '{{%auction_users}}',
            [
                'id' => $this->primaryKey(11),
                'first_name' => $this->string(),
                'last_name' => $this->string(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'deleted_at' => $this->dateTime(),
            ]
        );

        $this->alterColumn(
            '{{%auction_users}}',
            'id',
            $this->smallInteger(8).' NOT NULL AUTO_INCREMENT');

        $this->createIndex('auction_users_first_name_index', '{{%auction_users}}', 'first_name');
        $this->createIndex('auction_users_last_name_index', '{{%auction_users}}', 'last_name');
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%auction_users}}');
    }
}
