<?php

namespace console\migrations;

use yii\db\Migration;

final class M230221133445CreateProducts extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(
            '{{%products}}',
            [
                'id' => $this->primaryKey(11),
                'id_category' => $this->string(),
                'name' => $this->string(),
                'data' => $this->json(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'deleted_at' => $this->dateTime(),
            ]
        );

        $this->alterColumn(
            '{{%products}}',
            'id',
            $this->smallInteger(8).' NOT NULL AUTO_INCREMENT');

        $this->createIndex('products_name_index', '{{%products}}', 'name');
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%products}}');
    }
}
