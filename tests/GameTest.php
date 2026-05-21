<?php

use PHPUnit\Framework\TestCase;
use Ludo\Game;

class GameTest extends TestCase
{
    /**
     * Token enters board only on 6
     */
    public function testEnterBoard()
    {
        $game = new Game(2, [0, 26]);

        $moves = [
            [0, 0, 6]
        ];

        $expected = [
            [0, -1, -1, -1],
            [-1, -1, -1, -1]
        ];

        $this->assertEquals(
            $expected,
            $game->simulate($moves)
        );
    }

    /**
     * Token remains in base without 6
     */
    public function testInvalidBaseMove()
    {
        $game = new Game(2, [0, 26]);

        $moves = [
            [0, 0, 4]
        ];

        $expected = [
            [-1, -1, -1, -1],
            [-1, -1, -1, -1]
        ];

        $this->assertEquals(
            $expected,
            $game->simulate($moves)
        );
    }

    /**
     * Extra turn on dice 6
     */
    public function testExtraTurn()
    {
        $game = new Game(2, [0, 26]);

        $moves = [
            [0, 0, 6],
            [0, 0, 3]
        ];

        $expected = [
            [3, -1, -1, -1],
            [-1, -1, -1, -1]
        ];

        $this->assertEquals(
            $expected,
            $game->simulate($moves)
        );
    }

    /**
     * Invalid turn handling
     */
    public function testInvalidTurn()
    {
        $game = new Game(2, [0, 26]);

        $moves = [
            [1, 0, 6]
        ];

        $this->assertEquals(
            -1,
            $game->simulate($moves)
        );
    }

    /**
     * Capture logic
     */
    public function testCaptureLogic()
    {
        $game = new Game(2, [0, 26]);

        $moves = [
            [0, 0, 6],
            [0, 0, 3],

            [1, 0, 6],
            [1, 0, 5],

            [0, 0, 4],

            [1, 1, 6],
            [1, 1, 1],

            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 2],
        ];

        $expected = [
            [21, -1, -1, -1],
            [31, 27, -1, -1],
        ];

        $this->assertEquals(
            $expected,
            $game->simulate($moves)
        );
    }

    /**
     * Safe positions cannot capture
     */
    public function testSafePosition()
    {
        $game = new Game(2, [0, 26]);

        $moves = [
            [0, 0, 6],
            [0, 0, 8],

            [1, 0, 6],
            [1, 0, 34],
        ];

        $result = $game->simulate($moves);

        $this->assertNotEquals(
            -1,
            $result
        );
    }

    /**
     * Home path movement
     */
    public function testHomePath()
    {
        $game = new Game(1, [0]);

        $moves = [
            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 1]
        ];

        $result = $game->simulate($moves);

        $this->assertNotEquals(
            -1,
            $result
        );
    }

    /**
     * Exact finish validation
     */
    public function testExactFinish()
    {
        $game = new Game(1, [0]);

        $moves = [
            [0, 0, 6],

            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],

            [0, 0, 2]
        ];

        $result = $game->simulate($moves);

        $this->assertNotEquals(
            -1,
            $result
        );
    }

    /**
     * Finished token movement validation
     */
    public function testFinishedTokenMove()
    {
        $game = new Game(1, [0]);

        $moves = [
            [0, 0, 6],

            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],
            [0, 0, 6],

            [0, 0, 1],

            [0, 0, 1]
        ];

        $result = $game->simulate($moves);

        $this->assertNotEquals(
            -1,
            $result
        );
    }
}