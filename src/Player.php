<?php

namespace Ludo;

class Player
{
    private array $tokens = [];

    public function __construct()
    {
        for ($i = 0; $i < 4; $i++) {
            $this->tokens[] = new Token();
        }
    }

    public function getToken(int $tokenId): Token
    {
        return $this->tokens[$tokenId];
    }

    public function getTokens(): array
    {
        return $this->tokens;
    }
}
