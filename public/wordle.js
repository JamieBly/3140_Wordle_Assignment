/*
Jamie Bly
Javascript File for Wordle by Jamie
CSI3140 Assignment 2
*/

let guessNum = 0;
let numOfLocks = 5;

// function startGame(){
   
//     myWord = wordsArr[Math.floor(Math.random() * 5756)].toString();
//     guessNum = 0;

// }


function userMakesGuess(form){  
    
    let guess = form.userGuess.value.toString();
    const splitGuess = guess.toLowerCase().split("");
    if(guess.length == 5){
        if(guessNum == 5){
            document.getElementById("FormDiv").style.display = "none";
            window.alert("You have used all of your guesses. The answer was "+ myWord);
        } else {
            guessNum++;
            
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