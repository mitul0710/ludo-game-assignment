<?php

namespace Ludo;

class Token
{
    private int $position = -1;

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function isInBase(): bool
    {
        return $this->position === -1;
    }
}
