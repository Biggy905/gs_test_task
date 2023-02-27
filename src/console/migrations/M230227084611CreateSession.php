<?php

namespace console\migrations;

use yii\db\Migration;
use yii\db\mysql\Schema;

final class M230227084611CreateSession extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(
            '{{%session}}',
            [
                'id' => $this->char(40),
                'expire' => $this->integer(),
                'data' => Schema::TYPE_BINARY,
            ]
        );

        $this->addPrimaryKey('session_pkey', '{{%session}}', 'id');
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%session}}');
    }
}
