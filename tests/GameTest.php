<?php

use PHPUnit\Framework\TestCase;
use Ludo\Game;

class GameTest extends TestCase
{
    public function testTokenEnterBoard()
    {
        $game = new Game(2, [0, 26]);

        $result = $game->simulate([
            [0, 0, 6]
        ]);

        $this->assertEquals(0, $result[0][0]);
    }
}
