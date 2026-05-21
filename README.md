# Ludo Game Assignment

## Overview

This project is a PHP-based Ludo game simulation engine developed using Object-Oriented Programming (OOP) principles.

The implementation supports:
- Multiple players
- Multiple tokens
- Turn-based movement
- Safe positions
- Token capture logic
- Home path handling
- Final home destination handling
- Edge case validations
- Unit testing using PHPUnit

---

# Project Structure

ludo-game-assignment/
│
├── src/
│   ├── Game.php
│   ├── Player.php
│   ├── Token.php
│   └── Board.php
│
├── tests/
│   └── GameTest.php
│
├── vendor/
│
├── composer.json
├── composer.lock
├── solution.php
├── index.php
├── README.md
└── .gitignore

---

# Requirements

- PHP 7.4+ or PHP 8+
- Composer
- PHPUnit

---

# Installation & Setup

## 1. Clone Repository

```bash
git clone https://github.com/mitul0710/ludo-game-assignment
```

## 2. Move Into Project Directory

```bash
cd ludo-game-assignment
```

## 3. Install Dependencies

```bash
composer install
```

## 4. Generate Autoload Files

```bash
composer dump-autoload
```

---

# How To Run The Solution

Run using solution.php:

```bash
php solution.php
```

OR

```bash
php index.php
```

---

# How To Run Unit Tests

```bash
vendor\bin\phpunit tests
```

---

# Assumptions Made

- Tokens start from base position (-1)
- Dice value 6 is required to move token from base to board
- Rolling 6 grants an extra turn
- Safe positions cannot be captured
- If a token is captured and sent back to base, it can re-enter the board only when the player rolls a 6 again. Any attempt to move a token from base without rolling a 6 is treated as an invalid move, and the simulation returns -1
- Exact movement is required to reach final home destination
- Tokens move through the home path after completing the main board round
- Final home destination is represented as 100

---

# Edge Cases Handled

- Invalid player turn sequence
- Invalid token movement
- Over movement beyond final destination
- Capture handling
- Safe zone protection
- Finished token movement prevention
- Multiple player movement scenarios

---

# Features Implemented

- Object-Oriented Design
- Modular Architecture
- PSR-4 Autoloading
- PHPUnit Test Cases
- Token Capture Logic
- Safe Zone Handling
- Home Path Logic
- Final Home Destination Logic
- Clean & Readable Code Structure

---

# Environment Used

- PHP 8.2
- Composer
- PHPUnit 11
- Windows 11 Pro

---

# Git Repository

Add your GitHub / GitLab / Bitbucket repository link here.

---

# Author

Mitul Gohel
