<?php

namespace Ludo;

class Rules
{
    public static function canEnterBoard(Token $token, int $dice): bool
    {
        return $token->isInBase() && $dice === 6;
    }
}
