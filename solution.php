<?php

require_once __DIR__ . '/vendor/autoload.php';

use Ludo\Game;

function solution($P, $S, $M)
{
    $game = new Game($P, $S);

    return $game->simulate($M);
}