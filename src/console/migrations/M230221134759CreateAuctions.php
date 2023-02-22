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
                'id' => $this->string(),
                'id_product' => $this->string(),
                'id_user' => $this->string(),
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

        $this->addPrimaryKey('auctions_pkey', '{{%auctions}}', 'id');

        $this->createIndex('auctions_name_index', '{{%auctions}}', 'name');
        $this->createIndex('auctions_status_index', '{{%auctions}}', 'status');
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%auctions}}');
    }
}
