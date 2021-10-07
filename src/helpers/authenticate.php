<?php
    require_once("connectvars.php");
    
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
        header("HTTP/ 1.1 401 Unauthorized");
        header("WWW-Authenticate: Basic realm='Mismatch'");
        exit("<h3>Mismatch</h3><p>sorry, you must enter your username and password to log in and access this page. If you aren't a registered member, please  <a href='signup.php'>Sign Up</a></p>");
    }

    $dbc = mysqli_connect(host, user, pwd, database ) or die("couldn't connect to database");

    $user_username = mysqli_real_escape_string($dbc, trim($_SERVER['PHP_AUTH_USER']));
    $user_password = mysqli_real_escape_string($dbc, trim($_SERVER['PHP_AUTH_PW']));

    

    $query = "SELECT user_id, username FROM mismatch_users WHERE username = '$user_username' AND " .
    "password = SHA('$user_password')";

    $data = mysqli_query($dbc, $query);

    if (mysqli_num_rows($data) == 1) {
        $row = mysqli_fetch_array($data);
        $user_id = $row['user_id'];
        $username = $row['username'];
    } else {
        header("HTTP/ 1.1 401 Unauthorized");
        header("WWW-Authenticate: Basic realm='Mismatch'");
        exit('<h3>Mismatch</h3><p>sorry, you must enter your a valid username and password to log in and access this page</p>');
    }

    echo ('<div class="container"><p class="login">You are logged in as ' . $username . '</p></div>');

?>



