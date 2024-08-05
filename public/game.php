<?php
    require("WordleGame.php");
    incrementGames();
?>

<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="wordle.css">
        <script type="text/javascript" src="/assets/jquery-3.6.0.min.js"></script>
        
        <title><?php echo json_encode($myWord);?></title>\
        <input type="hidden" id="guessNum" name="guessNum" value="0">
    </head>
    <body>
        <!-- Header that contains the Logo, which also acts as a home button -->
        <div class="header">
            <a href="index.php" onclick="myAjax()" id="homeyhome">
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

        <div class="gameBoxes" id="gbSet1">
            <div class="LetterBoxContainer" id="S1L1Container">
                <h1 class="letters" id="S1L1Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S1L2Container">
                <h1 class="letters" id="S1L2Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S1L3Container">
                <h1 class="letters" id="S1L3Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S1L4Container">
                <h1 class="letters" id="S1L4Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S1L5Container">
                <h1 class="letters" id="S1L5Letter"></h1>
            </div>
            
        </div>

        <!-- Second Word -->
        <div class="gameBoxes" id="gbSet2">
            <div class="LetterBoxContainer" id="S2L1Container">
                <h1 class="letters" id="S2L1Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S2L2Container">
                <h1 class="letters" id="S2L2Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S2L3Container">
                <h1 class="letters" id="S2L3Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S2L4Container">
                <h1 class="letters" id="S2L4Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S2L5Container">
                <h1 class="letters" id="S2L5Letter"></h1>
            </div>
            
        </div>

        <!-- Third Word -->
        <div class="gameBoxes" id="gbSet3">
            <div class="LetterBoxContainer" id="S3L1Container">
                <h1 class="letters" id="S3L1Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S3L2Container">
                <h1 class="letters" id="S3L2Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S3L3Container">
                <h1 class="letters" id="S3L3Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S3L4Container">
                <h1 class="letters" id="S3L4Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S3L5Container">
                <h1 class="letters" id="S3L5Letter"></h1>
            </div>
            
        </div>

        <!-- Fourth Word -->
        <div class="gameBoxes" id="gbSet4">
            <div class="LetterBoxContainer" id="S4L1Container">
                <h1 class="letters" id="S4L1Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S4L2Container">
                <h1 class="letters" id="S4L2Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S4L3Container">
                <h1 class="letters" id="S4L3Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S4L4Container">
                <h1 class="letters" id="S4L4Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S4L5Container">
                <h1 class="letters" id="S4L5Letter"></h1>
            </div>
            
        </div>

        <!--Fifth Word-->
        <div class="gameBoxes" id="gbSet5">
            <div class="LetterBoxContainer" id="S5L1Container">
                <h1 class="letters" id="S5L1Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S5L2Container">
                <h1 class="letters" id="S5L2Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S5L3Container">
                <h1 class="letters" id="S5L3Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S5L4Container">
                <h1 class="letters" id="S5L4Letter"></h1>
            </div>
            <div class="LetterBoxContainer" id="S5L5Container">
                <h1 class="letters" id="S5L5Letter"></h1>
            </div>
            
        </div>

        <!-- Form to enter user guess -->
        <div id="FormDiv">
        <form id="userGuessForm" onsubmit="submitAlert()">
            <label for="userGuess">Guess Here!</label><br>
            <input type="text" id="userGuess" name="userGuess">
            <input type="button" onclick="userMakesGuess(this.form)" value="Guess">
            
        </form>
        </div>

        <script>
            var myWord = <?php echo json_encode($myWord);?>;
            
            let guessNum = 0;
            let numOfLocks = 5;

            const homey = document.getElementById("homeyhome");
            homey.onclick = function(e) {
                let dataToSend = "index.php/guess="+guessNum;
                const xmlhttp = new XMLHttpRequest();

                xmlhttp.open("POST", dataToSend, true);
                xmlhttp.send(dataToSend);
            }

            function userMakesGuess(form){  

                let guess = form.userGuess.value.toString();
                const splitGuess = guess.toLowerCase().split("");
                if(guess.length == 5){
                    
                    if(guessNum == 5){
                        document.getElementById("FormDiv").style.display = "none";
                        window.alert("You have used all of your guesses. The answer was "+ myWord);
                    } else {
                        guessNum++;
                        <?php incrementGuesses(); ?>;
                        document.getElementById('guessNum').value = guessNum;
                        
                            // $.ajax({
                            //     type: 'POST',
                            //     url: 'index.php',
                            //     data: { guessNum: guessNum },
                            //     success: function(response) {
                            //         console.log('Success:', response);
                            //     },
                            //     error: function(error) {
                            //         console.error('Error:', error);
                            //     }
                            // });
                                      
                        const splitWord = myWord.toLowerCase().split("");
                        
                        locksReset(); //resets the locks before each attempt
                        for(let i =0; i < 5; i++){

                            if (splitGuess[i] == splitWord[i]){
                                //If the i-th letter is in the correct place
                                numOfLocks = numOfLocks - 1;
                                idName = "S" + guessNum + "L" + (i+1) + "Container";
                                idLetter = "S" + guessNum + "L" + (i+1) + "Letter";
                                var thingy = document.getElementById(idName);
                                var otherThingy = document. getElementById(idLetter);
                                thingy.style.backgroundColor = 'Green';
                                otherThingy.innerHTML = splitGuess[i];
                                thingy.style.display = "inline"

                            } else if ( (splitGuess[i] != splitWord[0]) && (splitGuess[i] != splitWord[1]) && (splitGuess[i] != splitWord[2]) && (splitGuess[i] !=splitWord[3]) && ( splitGuess[i] != splitWord[4] )){
                                //If the i-th letter is NOT in the word
                                idName = "S" + guessNum + "L" + (i+1) + "Container";
                                idLetter = "S" + guessNum + "L" + (i+1) + "Letter";
                                var thingy = document.getElementById(idName);
                                var otherThingy = document. getElementById(idLetter);
                                thingy.style.backgroundColor = 'Red';
                                otherThingy.innerHTML = splitGuess[i];
                                thingy.style.display = "inline"
                            } else {
                                //If the i-th letter is in the word, but in the incorret place
                                idName = "S" + guessNum + "L" + (i+1) + "Container";
                                idLetter = "S" + guessNum + "L" + (i+1) + "Letter";
                                var thingy = document.getElementById(idName);
                                var otherThingy = document. getElementById(idLetter);
                                thingy.style.backgroundColor = 'Yellow';
                                otherThingy.textContent = splitGuess[i];
                                thingy.style.display = "inline"
                            }
                            if(numOfLocks < 1){
                                winnerSequence();    
                                <?php incrementGamesWon();?>;                        
                            }
                        }
                    }
                } else if (splitGuess[0] != undefined && splitGuess[1] != undefined && splitGuess[2] != undefined && splitGuess[3] != undefined && splitGuess[4] != undefined){
                    window.alert("Invalid Guess: Please enter a valid 5 letter word.");
                } else {
                    window.alert("Invalid Guess: Please enter a valid 5 letter word.");
                }

            }


            function submitAlert(){
                window.alert("Please Click Submit To Make Your Guess! Game Will Now Reset!");
            }

            function unlockGate(){
                numOfLocks=numOfLocks-1;
            }

            function locksReset(){
                numOfLocks=5;
            }

            function winnerSequence(){
                document.getElementById("FormDiv").style.display = "none";
                window.alert("Congratulations, You've Won!");
            }

        </script>
    </body>
</html>
