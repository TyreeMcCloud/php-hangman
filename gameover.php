<?php
session_start();
$result = $_GET['result'] ?? 'lose';

// Reset session for a new game
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Game Over</title>
</head>
<body>
    <div class="header"><?= $result === 'win' ? 'Congratulations, You Won!' : 'Game Over - You Lost' ?></div>
    <div class="main">
        <p><?= $result === 'win' ? 'You guessed the words correctly!' : 'Better luck next time!' ?></p>
    </div>

    <div class="bottom">
        <a class="home-button" href="homepage.php">
            <img class="home-image" src="img/home.png">
        </a>
    </div>
</body>
</html>
