<?php

namespace Ludo;

class Game
{
    private array $players = [];

    private array $startPositions;

    private int $playerCount;

    /**
     * Total travelled steps
     */
    private array $steps = [];

    public function __construct(
        int $playerCount,
        array $startPositions
    ) {

        $this->playerCount = $playerCount;

        $this->startPositions = $startPositions;

        for ($i = 0; $i < $playerCount; $i++) {

            $this->players[] = new Player();

            for ($j = 0; $j < 4; $j++) {

                $this->steps[$i][$j] = 0;
            }
        }
    }

    public function simulate(array $moves)
    {
        $currentPlayer = 0;

        foreach ($moves as $move) {

            [$playerId, $tokenId, $dice] = $move;

            /**
             * Validate turn
             */
            if ($playerId !== $currentPlayer) {
                return -1;
            }

            $token =
                $this->players[$playerId]
                ->getToken($tokenId);

            /**
             * Already finished
             */
            if ($token->getPosition() === 56) {
                return -1;
            }

            /**
             * Token in base
             */
            if ($token->isInBase()) {

                /**
                 * Need 6 to enter board
                 */
                if ($dice !== 6) {

                    $this->moveTurn(
                        $currentPlayer,
                        $dice
                    );

                    continue;
                }

                /**
                 * Enter board
                 */
                $startPosition =
                    $this->startPositions[$playerId];

                $token->setPosition(
                    $startPosition
                );

                /**
                 * IMPORTANT
                 * No movement yet
                 */
                $this->steps[$playerId][$tokenId]
                    = 0;

                /**
                 * Capture after entry
                 */
                $this->handleCapture(
                    $playerId,
                    $startPosition
                );

                $this->moveTurn(
                    $currentPlayer,
                    $dice
                );

                continue;
            }

            /**
             * Current travelled steps
             */
            $currentSteps =
                $this->steps[$playerId][$tokenId];

            /**
             * New travelled steps
             */
            $newSteps =
                $currentSteps + $dice;

            /**
             * Cannot exceed final destination
             */
            if ($newSteps > 56) {
                return -1;
            }

            /**
             * Final destination reached
             */
            if ($newSteps === 56) {

                $token->setPosition(100);

                $this->steps[$playerId][$tokenId]
                    = 56;

                $this->moveTurn(
                    $currentPlayer,
                    $dice
                );

                continue;
            }

            /**
             * Main board movement
             */
            if ($newSteps <= 50) {

                $currentPosition =
                    $token->getPosition();

                $newPosition =
                    ($currentPosition + $dice) % 52;

                $token->setPosition(
                    $newPosition
                );

                /**
                 * Capture logic
                 */
                $this->handleCapture(
                    $playerId,
                    $newPosition
                );

            } else {

                /**
                 * Home path
                 *
                 * 51 -> 52
                 * 52 -> 53
                 * 53 -> 54
                 * 54 -> 55
                 * 55 -> 56
                 */
                $homePosition = $newSteps;

                $token->setPosition(
                    $homePosition
                );
            }

            /**
             * Save travelled steps
             */
            $this->steps[$playerId][$tokenId]
                = $newSteps;

            /**
             * Turn handling
             */
            $this->moveTurn(
                $currentPlayer,
                $dice
            );
        }

        return $this->getState();
    }

    /**
     * Capture logic
     */
    private function handleCapture(
        int $currentPlayerId,
        int $position
    ): void {

        /**
         * Home path cannot capture
         */
        if ($position > 51) {
            return;
        }

        /**
         * Safe positions
         */
        if (
            Board::isSafePosition($position)
        ) {
            return;
        }

        foreach (
            $this->players
            as $playerId => $player
        ) {

            /**
             * Skip current player
             */
            if ($playerId === $currentPlayerId) {
                continue;
            }

            foreach (
                $player->getTokens()
                as $tokenId => $token
            ) {

                if (
                    $token->getPosition()
                    === $position
                ) {

                    /**
                     * Send token to base
                     */
                    $token->setPosition(-1);

                    /**
                     * Reset travelled steps
                     */
                    $this->steps[$playerId][$tokenId]
                        = 0;
                }
            }
        }
    }

    /**
     * Turn handling
     */
    private function moveTurn(
        int &$currentPlayer,
        int $dice
    ): void {

        /**
         * Extra turn on 6
         */
        if ($dice === 6) {
            return;
        }

        $currentPlayer =
            ($currentPlayer + 1)
            % $this->playerCount;
    }

    /**
     * Final game state
     */
    private function getState(): array
    {
        $state = [];

        foreach ($this->players as $player) {

            $playerState = [];

            foreach (
                $player->getTokens()
                as $token
            ) {

                $playerState[]
                    = $token->getPosition();
            }

            $state[] = $playerState;
        }

        return $state;
    }
}