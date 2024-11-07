<?php
session_start();

// Set initial level and word count if not set
if (!isset($_SESSION['level'])) {
    $_SESSION['level'] = $_GET['level'] ?? 'easy';
}
if (!isset($_SESSION['word_count'])) {
    $_SESSION['word_count'] = 1; // Start from word 1
}

if (!isset($_SESSION['words'])) {
    // Define word lists by difficulty level and store in session
    $_SESSION['words'] = [
        'easy' => ['apple', 'tree', 'book', 'sun', 'moon', 'star', 'math', 'meet'],
        'medium' => ['planet', 'garden', 'forest', 'butterfly', 'castle', 'ocean', 'persona'],
        'hard' => ['psychology', 'development', 'architecture', 'vocabulary', 'laboratory', 'mathematics', 'cosmology']
    ];
}

// Levels
$levels = ['easy', 'medium', 'hard'];

// Start game
if (!isset($_SESSION['word']) || isset($_SESSION['load_new_word'])) {
    startNewGame($words);
}

$word = $_SESSION['word'];
$guessed = $_SESSION['guessed'];
$lives = $_SESSION['lives'];
$level = $_SESSION['level'];
$wordCount = $_SESSION['word_count'];
$duplicateGuessMessage = "";

// Process guess
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['load_new_word'])) {
    $guess = strtolower($_POST['guess']);
    
    // Check if the guess has already been made
    if (in_array($guess, $guessed)) {
        $duplicateGuessMessage = "You've already guessed the letter '$guess'. Try a different letter.";
    } else {
        if (strlen($guess) === 1) {
            $guessed[] = $guess;
            $_SESSION['guessed'] = $guessed;

            if (strpos($word, $guess) === false) {
                $_SESSION['lives'] -= 1;
                $lives -= 1;
            }

            // Check for win/lose conditions
            if ($lives <= 0) {
                header("Location: gameover.php?result=lose");
                exit;
            } elseif (allLettersGuessed($word, $guessed)) {
                advanceLevel($levels, $words);
            }
        }
    }
}

// check if all letters are guessed
function allLettersGuessed($word, $guessed) {
    foreach (str_split($word) as $letter) {
        if (!in_array($letter, $guessed)) {
            return false;
        }
    }
    return true;
}

// start a new game or level
function startNewGame($words) {
    $levels;
    $level = $_SESSION['level'];
    $randomKey = array_rand($_SESSION['words'][$level]);
    $_SESSION['word'] = $_SESSION['words'][$level][$randomKey];
    $_SESSION['guessed'] = [];
    $_SESSION['lives'] = 6;
    unset($_SESSION['words'][$level][$randomKey]);
    $_SESSION['words'][$level] = array_values($_SESSION['words'][$level]); // Reindex array
    unset($_SESSION['load_new_word']); // Clear the flag
}

// advance to the next level
function advanceLevel($levels, $words) {
    global $levels;
    $_SESSION['word_count']++;

    // Check if 6 words are completed within this level
    if ($_SESSION['word_count'] > 6) {
        $currentLevelIndex = array_search($_SESSION['level'], $levels);
        // Game is won after completing the sixth word on the current level
        header("Location: gameover.php?result=win");
        exit;
    }

    $_SESSION['load_new_word'] = true; // Set flag to load new word on the next page load
    header("Location: game.php"); // Reload the page to start the next word automatically
    exit;
}


// Prepare word display with guessed letters
$displayWord = '';
foreach (str_split($word) as $letter) {
    $displayWord .= in_array($letter, $guessed) ? $letter : ' _ ';
}

// Calculate Hangman image based on lives remaining
$hangmanStage = 6 - $lives;
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Hangman Game</title>
</head>
<body>
    <div class="header">
        Level: <?= ucfirst($level) ?> - Word <?= $wordCount ?> of 6
    </div>

    <div class="main-game">
    <h1>Hangman</h1>
    <div class="hangman-image">
        <img src="img/hangman<?= $hangmanStage ?>.png" alt="Hangman Stage <?= $hangmanStage ?>" class="hangman-image">
    </div>
    <p class="word">Word: <?= $displayWord ?></p>
    <p class="lives">Lives remaining: <?= $lives ?></p>
    
    <?php if ($duplicateGuessMessage): ?>
        <p class="error"><?= $duplicateGuessMessage ?></p>
    <?php endif; ?>
    
    <form method="post" action="game.php" class="guess-form">
        <input type="text" name="guess" maxlength="1" required placeholder="Enter a letter">
        <button type="submit">Guess</button>
    </form>
    <p class="guessed-letters">Guessed letters: <?= implode(', ', $guessed) ?></p>
    </div>


    <div class="bottom">
        <a class="home-button" href="homepage.php">
            <img class="home-image" src="img/home.png">
        </a>
    </div>
</body>
</html>
