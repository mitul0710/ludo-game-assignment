<?php

namespace Ludo;

class Board
{
    public const SAFE_POSITIONS = [0, 8, 13, 21, 26, 34, 39, 47];

    public static function isSafePosition(
        int $position
    ): bool {

        return in_array(
            $position,
            self::SAFE_POSITIONS,
            true
        );
    }

    public static function move(
        int $position,
        int $dice
    ): int {

        return ($position + $dice) % 52;
    }
}