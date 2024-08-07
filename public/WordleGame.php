<?php
    session_start();

    $connectionUsers = "host=localhost dbname=users user=postgres password=Sidney8790!";
    $dbconnectUsers = pg_connect($connectionUsers);
    

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
    if(!isset($_SESSION["userSignedIn"])){
        $_SESSION['userSignedIn'] = 0;
    }
    if(!isset($_SESSION["username"])){
        $_SESSION['username'] = '';
    }
    if(!empty($_GET['guess'])) {
        $_SESSION['numOfGuesses'] = $_SESSION['numOfGuesses'] + $_GET['guess'];
    }
    
    if($_SESSION['userSignedIn'] == 0){
        echo "User Must Sign In Before Proceeding.";
        header("Location: signin.php");
    }
    
    function signOut(){
        $_SESSION['username'] = ''; 
        $_SESSION['userSignedIn'] = 0; 
        header('Location: signin.php');
    }

    if(isset($_GET['gate'])){
        signOut();
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
        runNumOfGamesPlayed();
    }

    function incrementGamesWon(){
        $_SESSION['numOfGamesWon']++;
        runNumOfGamesWon();
    }
    function incrementGuesses(){
        $_SESSION['numOfGuesses']++;
        runTotalNumGuesses();
    }

    function runNumOfGamesPlayed(){

        $connectionUsers = "host=localhost dbname=users user=postgres password=Sidney8790!";
        $dbconnectUsers = pg_connect($connectionUsers);
        $current_username = $_SESSION["username"];
            
        $query = "SELECT numgamesplayed FROM users WHERE username='$current_username'";
        $res = pg_query($dbconnectUsers, $query);
        $row = pg_fetch_row($res);
        $x=$row[0] +1;
        
            
        $num_games_play_query = "UPDATE users SET numgamesplayed='$x' WHERE username='$current_username'";
        pg_query($dbconnectUsers, $num_games_play_query);
            
    }

    function getGamesPlayed(){
        $connectionUsers = "host=localhost dbname=users user=postgres password=Sidney8790!";
        $dbconnectUsers = pg_connect($connectionUsers);
        $current_username = $_SESSION["username"];

        $query = "SELECT numgamesplayed FROM users WHERE username='$current_username'";
        $res = pg_query($dbconnectUsers, $query);
        $row = pg_fetch_row($res);
        return $row[0];
    }

    function runNumOfGamesWon(){

        $connectionUsers = "host=localhost dbname=users user=postgres password=Sidney8790!";
        $dbconnectUsers = pg_connect($connectionUsers);
        $current_username = $_SESSION["username"];
            
        $query = "SELECT numgameswon FROM users WHERE username = '$current_username'";
        $res = pg_query($dbconnectUsers, $query);
        $row = pg_fetch_row($res);
        $x=$row[0] +1;
 
        $games_won_query = "UPDATE users SET numgameswon='$x' WHERE username='$current_username'";
        pg_query($dbconnectUsers, $games_won_query);
        
    }

    function getGamesWon(){
        $connectionUsers = "host=localhost dbname=users user=postgres password=Sidney8790!";
        $dbconnectUsers = pg_connect($connectionUsers);
        $current_username = $_SESSION["username"];
        $query = "SELECT numgameswon FROM users WHERE username = '$current_username'";
        $res = pg_query($dbconnectUsers, $query);
        $row = pg_fetch_row($res);
        return $row[0];
    }
    
    function runTotalNumGuesses(){

        $connectionUsers = "host=localhost dbname=users user=postgres password=Sidney8790!";
        $dbconnectUsers = pg_connect($connectionUsers);
        $current_username = $_SESSION["username"];
            
        $query = "SELECT totalnumguesses from users where username='$current_username'";
        $res = pg_query($dbconnectUsers, $query);
        $row = pg_fetch_row($res);
        $x=$row[0] +1;
    
       
        $total_num_guesses_query = "UPDATE users SET totalnumguesses='$x'WHERE username='$current_username'";
        pg_query($dbconnectUsers, $total_num_guesses_query);
           
    }

    function getNumGuesses(){
        $connectionUsers = "host=localhost dbname=users user=postgres password=Sidney8790!";
        $dbconnectUsers = pg_connect($connectionUsers);
        $current_username = $_SESSION["username"];

        $query = "SELECT totalnumguesses from users where username = '$current_username'";
        $res = pg_query($dbconnectUsers, $query);
        $row = pg_fetch_row($res);
        return $row[0];
    }


   