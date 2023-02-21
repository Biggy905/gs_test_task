<?php

namespace common\enums;

enum AuctionStatusEnum: string
{
    case NEW = 'new';
    case RUN = 'run';
    case END = 'end';
}
