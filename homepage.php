
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
        <h1>Select Difficulty</h1>
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

