<?php
session_start();

if(!isset($_SESSION["userSignedIn"])){
    $_SESSION['userSignedIn'] = 0;
}

$authenticated = false;
if(isset($_POST['verify']) && $_POST['verify']=="Verify"){

    $user = $_POST['user'];
    $password = $_POST['password'];

    $connectionUsers = "host=localhost dbname=users user=postgres password=Sidney8790!";
    $dbConnectUsers = pg_connect($connectionUsers);
    if($dbConnectUsers){
        $query = 'select * from verify($1, $2)';
        $res = pg_query_params($dbConnectUsers, $query, array($user, $password));
        $result = pg_fetch_object($res);

        if($result){
            $authenticated = $result -> verify==1;
        }
    }

    if(!$authenticated){
        echo "Not valid";
    } else { 
  
        $_SESSION['userSignedIn'] = 1;
        $_SESSION['username'] = $user;
        header("Location: index.php");
        exit();
    }

}
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
            </a>
        </div>

        <div class="signinInfo">
            <div id="SignInFormDiv">
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                    <label for="userSignin">Username:</label>
                    <input type="text" name="user"><br><br>
                    <label for="userSignin">Password: <?php echo $_SESSION['userSignedIn'];?></label>
                    <input type="password" name="password"><br><br>
                    <input type="submit" value="Verify" name="verify">
                    
                </form>
            </div>
        </div>
        <div class="goToRegisterAcc">
            <h3>Don't have an account? Register NOW!</h3>
            <a href="signup.php">
                <button id="btnPlay">Register</button>
            </a>
        </div>

    </body>

    <script src="wordle.js"></script>
    
</html>