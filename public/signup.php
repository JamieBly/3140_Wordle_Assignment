<?php

/* Attempt to connect to MySQL database */
$connectionUsers = "host=localhost dbname=users user=postgres password=Sidney8790!";
$dbconnectUsers = pg_connect($connectionUsers);
 
// Check connection
if($dbconnectUsers === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

function runAddUser($username, $password, $confirm_password){

    $connectionUsers = "host=localhost dbname=users user=postgres password=Sidney8790!";
    $dbconnectUsers = pg_connect($connectionUsers);
    $gate = true;

    if($password == $confirm_password){
        
        $query = 'select username from users';
        $res = pg_query($dbconnectUsers, $query);

        foreach ($res as $x){
            if ($x == $username){
                $gate = false;
                echo "Username already used. Please choose another.";
            }  
        }

    } else {
        echo "Passwords don't match. Please try again.";
    }

    if ($gate == true){
        $query_two = "INSERT INTO users (username, password) VALUES 
        ('$username', crypt('$password', gen_salt('md5')))";
        pg_query($dbconnectUsers, $query_two);
        header("Location: index.php");
    }

}

if(isset($_POST['username'])){
    runAddUser($_POST['username'], $_POST['password'], $_POST['confirm_password']);
}

pg_close($dbconnectUsers);


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

        <h2>Sign Up to WORDLE by Jamie</h2>
        <p>Please fill out the form to register</p>
        <div class="signinInfo">
            <div id="SignInFormDiv">
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                    <label for="userSignin">Username: </label>
                    <input type="text" name="username"><br><br>
                
                    <label for="userSignin">Password:</label>
                    <input type="password" name="password"><br><br>
                
                    <label for="userSignin">Confirm Password:</label>
                    <input type="password" name="confirm_password"><br><br>
                
                    <input type="submit" class="btn btn-primary" value="Register">
                    <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                    
                </form>
            </div>

            <div class="goToSigninBtn">
                <h3>Already have an account? Sign In NOW!</h3>
                <a href="signin.php">
                    <button id="btnPlay" >SIGN IN</button>
                </a>
            </div>

    </body>

    <script src="wordle.js"></script>
    
</html>