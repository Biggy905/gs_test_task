<?php

namespace common\enums;

enum RbacRolesEnums: string
{
    case SYSTEM_ADMIN = 'System Administrator';
    case ADMIN = 'Administrator';
    case MODERATOR = 'Moderator';
    case USER_ACTIVE = 'User';
    case USER_INACTIVE = 'Inactive User';
}
