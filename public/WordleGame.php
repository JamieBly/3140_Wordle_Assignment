<?php
    session_start();

    $receivedVariable = 0;
    if(!isset($_SESSION["numOfGames"])){
        $_SESSION['numOfGames'] = 0;
    }
    if(!isset($_SESSION["numOfGamesWon"])){
        $_SESSION['numOfGamesWon'] = 0;
    }
    if(!isset($_SESSION["numOfGuesses"])){
        $_SESSION['numOfGuesses'] = 0;
    }
    if(!isset($_SESSION["avgNumOfGuesses"])){
    }
    if(!empty($_GET['guess'])) {
        $_SESSION['numOfGuesses'] = $_SESSION['numOfGuesses'] + $_GET['guess'];
    }

    $myFile = fopen("5LetterWords.txt", "r") or die("Unable To Open Word Dictionary");
    $myDictionary = fread($myFile, filesize("5LetterWords.txt"));
    $myDictionary = explode(",", $myDictionary);
    $myWord = $myDictionary[rand(0, count($myDictionary) -1)];
    fclose($myFile);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guessNum'])) {
        $guessNum = intval($_POST['guessNum']);
        $_SESSION["numOfGuesses"] += $guessNum;
        exit;
    }

    function incrementGames(){
        $_SESSION['numOfGames']++;
    }

    function incrementGamesWon(){
        $_SESSION['numOfGamesWon']++;
    }
    function incrementGuesses(){
        $_SESSION['numOfGuesses']++;
    }

   