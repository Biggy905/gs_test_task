<?php

namespace console\migrations;

use yii\db\Migration;

final class M230221134734CreateCategories extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(
            '{{%categories}}',
            [
                'id' => $this->string(),
                'id_category' => $this->string(),
                'name' => $this->string(),
                'data' => $this->json(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'deleted_at' => $this->dateTime(),
            ]
        );

        $this->addPrimaryKey('categories_pkey', '{{%categories}}', 'id');

        $this->createIndex('categories_name_index', '{{%categories}}', 'name');
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%categories}}');
    }
}
