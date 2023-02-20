<?php

namespace common\helpers;

use common\enums\DateTimeEnums;
use common\enums\TimeZoneEnums;
use DateTimeInterface;
use DateTimeImmutable;
use DateTimeZone;

final class DateTimeHelpers
{
    public static function createDateTime(
        string $date = null,
        ?TimeZoneEnums $timeZone = null,
        DateTimeEnums $format = DateTimeEnums::DATETIME_DATABASE
    ): string {
        $date = self::getDateTime($date, $timeZone);

        return $date->format($format->value);
    }

    public static function createStartDateTime(
        string $date = null,
        ?TimeZoneEnums $timeZone = null,
        DateTimeEnums $format = DateTimeEnums::DATETIME_DATABASE
    ): string {
        $date = self::getDateTime($date, $timeZone);
        $date = $date->setTime(0, 0, 0);

        return $date->format($format->value);
    }

    public static function createEndDateTime(
        string $date = null,
        ?TimeZoneEnums $timeZone = null,
        DateTimeEnums $format = DateTimeEnums::DATETIME_DATABASE
    ): string {
        $date = self::getDateTime($date, $timeZone);
        $date = $date->setTime(23, 59, 59);

        return $date->format($format->value);
    }

    private static function getDateTime(
        string $date = null,
        ?TimeZoneEnums $timeZone = null,
    ): DateTimeInterface {
        if (empty($date) && empty($timeZone)) {
            $date = new DateTimeImmutable();
        } elseif(!empty($date) && empty($timeZone)) {
            $date = new DateTimeImmutable($date);
        } elseif (!empty($date) && !empty($timeZone)) {
            $date = new DateTimeImmutable(
                $date,
                new DateTimeZone($timeZone->value)
            );
        }

        return $date;
    }
}
