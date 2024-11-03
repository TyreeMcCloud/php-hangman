: red' class='rectangle'></i>
            <i style='--speed: 25 ; --bg: yellow' class='square'></i>
            <i style='--speed: 23 ; --bg: blue' class='rectangle'></i>
            <i style='--speed: 43 ; --bg: purple' class='square'></i>
            <i style='--speed: 37 ; --bg: gray' class='rectangle'></i>
            <i style='--speed: 20 ; --bg: turquoise' class='square'></i>
            <i style='--speed: 31 ; --bg: wheat' class='square'></i>
            <i style='--speed: 32 ; --bg: maroon' class='rectangle'></i>
            <i style='--speed: 22 ; --bg: yellow' class='square'></i>
            <i style='--speed: 45 ; --bg: violet' class='square'></i>
            <i style='--speed: 33 ; --bg: gray' class='rectangle'></i>
            <i style='--speed: 23 ; --bg: orangere' class='square'></i>
            <i style='--speed: 43 ; --bg: lime' class='square'></i>
            <i style='--speed: 37 ; --bg: green' class='rectangle'></i>
            <i style='--speed: 47 ; --bg: paleturquoise' class='square'></i>
            <i style='--speed: 31 ; --bg: plum' class='square'></i>
        </div>
	<audio controls autoplay>
	<source src='sound/victory.mp3' type='audio/mpeg'>
	</audio>
	";
    }
	elseif($result === "lose") {
	print "
	<div class = 'Losetxt'>
	<img src = 'img/Defeat text.png'>
	</div>;
	<audio controls autoplay>
	 <source src='sound/Death_sound.mp3' type='audio/mpeg'>
	</audio>
	";
	}
    ?>

    <div class="header"><?= $result === "win" ? "Congratulations, You Won!" : "Game Over - You Lost" ?></div>
    <div class='main'>
        <p><?= $result === "win" ? "You guessed the words correctly!" : "Better luck next time!" ?></p>
    </div>

    <div class="bottom">
        <a class="home-button" href="homepage.php">
            <img class="home-image" src="img/home.png">
        </a>
    </div>
</body>
</html>
