<?php

namespace console\migrations;

use yii\db\Migration;

final class M230221134759CreateAuctions extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(
            '{{%auctions}}',
            [
                'id' => $this->primaryKey(11),
                'id_product' => $this->smallInteger(8),
                'id_user' => $this->smallInteger(8),
                'name' => $this->string(),
                'status' => $this->string(),
                'data' => $this->json(),
                'start_time' => $this->time(),
                'end_time' => $this->time(),
                'start_date' => $this->date(),
                'end_date' => $this->date(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'deleted_at' => $this->dateTime(),
            ]
        );

        $this->alterColumn(
            '{{%auctions}}',
            'id',
            $this->smallInteger(8).' NOT NULL AUTO_INCREMENT');

        $this->createIndex('auctions_name_index', '{{%auctions}}', 'name');
        $this->createIndex('auctions_status_index', '{{%auctions}}', 'status');
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%auctions}}');
    }
}
