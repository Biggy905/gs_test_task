<?php

namespace common\components;

use common\helpers\DateTimeHelpers;
use yii\rbac\Assignment;
use yii\rbac\DbManager;

final class RbacManager extends DbManager
{
    protected function addItem($item): bool
    {
        $time = DateTimeHelpers::createDateTime();

        if ($item->createdAt === null) {
            $item->createdAt = $time;
        }

        if ($item->updatedAt === null) {
            $item->updatedAt = $time;
        }

        $this->db->createCommand()
            ->insert($this->itemTable, [
                'name' => $item->name,
                'type' => $item->type,
                'description' => $item->description,
                'rule_name' => $item->ruleName,
                'data' => $item->data === null ? null : serialize($item->data),
                'created_at' => $item->createdAt,
                'updated_at' => $item->updatedAt,
            ])->execute();

        $this->invalidateCache();

        return true;
    }

    public function assign($role, $userId): Assignment
    {
        $assignment = new Assignment([
            'userId' => $userId,
            'roleName' => $role->name,
            'createdAt' => DateTimeHelpers::createDateTime(),
        ]);

        $this->db->createCommand()
            ->insert($this->assignmentTable, [
                'user_id' => $assignment->userId,
                'item_name' => $assignment->roleName,
                'created_at' => $assignment->createdAt,
            ])->execute();

        unset($this->checkAccessAssignments[(string) $userId]);

        return $assignment;
    }
}
