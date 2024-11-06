
<?php
//resets cookies when going home
session_start();    
session_unset();    
session_destroy();  
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Hangman - Homepage</title>
</head>
<body>
    <div class="header">Hangman Game</div>

    <div class="main">
    <h1>Welcome to Hangman! Here's how to play</h1>
    <ul>
        <li>Choose a difficulty level to begin the game.</li>
        <li>A word will be chosen, and you'll have to guess each letter.</li>
        <li>Guess one letter at a time to reveal parts of the word.</li>
        <li>For every incorrect guess, a part of the hangman is drawn.</li>
        <li>The game ends when you guess the word correctly or the hangman is fully drawn.</li>
        <li>Good luck, and have fun!</li>
    </ul>
     <img src="img/hangman.png" alt="hangman img" class="hangman-image">
    </div>

    <div class="bottom">
        <a class="homepage-buttons" href="game.php?level=easy">
            <div><p>Easy</p></div>
        </a>

        <a class="homepage-buttons" href="game.php?level=medium">
            <div><p>Medium</p></div>
        </a>

        <a class="homepage-buttons" href="game.php?level=hard">
            <div><p>Hard</p></div>
        </a>
    </div>
</body>
</html>

