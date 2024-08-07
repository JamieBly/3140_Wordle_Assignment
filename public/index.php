<?php
    require("WordleGame.php");
?>

<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="wordle.css">
        
        <title>Wordle By Jamie</title>
    </head>

    <body>
        <div class="header">
            <a href="index.php">
                <img src="wordlebyjamie_logo.png" id="wordlelogo"></img>
                <?php 
                    if ($_SESSION["numOfGames"] != 0) {
                        $_SESSION["avgNumOfGuesses"] = $_SESSION["numOfGuesses"] / $_SESSION["numOfGames"];
                    } else {
                        $_SESSION["avgNumOfGuesses"] = 0;
                    }
                ?>
            </a>
        </div>

        <div id="playbtnDiv">
            <a href="game.php">
                <button id="btnPlay">PLAY WORDLE</button>
            </a>
        </div>

        <div class="stats">
            <h3>Welcome <?php echo $_SESSION['username'];?> to Wordle by Jamie!</h3><br>
            <h3>Your Stats:</h3>
            <h3>Number of games played this session: <h2 id="gamesPlayed"><?php echo getGamesPlayed();?></h2></h3>
            <h3>Number of games won this session: <h2 id="gamesWon"><?php echo getGamesWon();?></h2></h3>
            <h3>Number of guess made this session: <h2 id="numGuesses"><?php echo getNumGuesses();?></h2></h3>
            <h3>Average guesses per game this session: <h2 id="avgGuesses"><?php echo getNumGuesses()/getGamesPlayed();?></h2></h3>
        </div>

        <div id="signinBtnDiv">
            <a href="index.php?gate=true">
                <button id="btnPlay">Sign Out</button>
            </a>
        </div>

    </body>

    <script src="wordle.js"></script>
    
</html>

