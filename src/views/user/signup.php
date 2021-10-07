<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>letsConnect - Sign Up</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<?php
    require_once("../functions/connectvars.php");

    $dbc = mysqli_connect(host, user, pwd, database ) or die("couldn't connect to database");
    $form = false;
    if (isset($_POST["submit"])) {
        $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
        $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
        
        if (!empty($username) && !empty($password1) && !empty($password2)) {

            if($password1 == $password2){
                $query = "SELECT * FROM mismatch_users WHERE username = '$username'";
                $data = mysqli_query($dbc, $query);

                if (mysqli_num_rows($data) == 0) {
                    $queryInsert = "INSERT INTO mismatch_users (username, password, join_date) VALUES" .
                    "('$username', SHA('$password1'), NOW())";
                    mysqli_query($dbc, $queryInsert);
                    echo "<p>Your new account has been successfully created, You're now ready to login and <a href='login.php'>edit your profile</a></p>";
                    mysqli_close($dbc);
                } else {
                    echo '<div class="container">
                            <div class="row justify-content-center">
                                <div class="alert alert-info" role="alert">this username already exist. Use another one</div>
                            </div>
                        </div>';
                    $username = "";
                    $form = true;
                }
            } else {
                echo '<div class="container"><div class="row justify-content-center"><div class="col-12 col-md-6 col-lg-5"><div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><p>your password has to match your retype one</p></div></div></div></div>';
                $form = true;
            }

        } else {
            echo "<p>You must fill in all the fields to sign up an account on mismatch.</p>";
            $form = true;
        }
    } else {
        $form = true;
    }

    if ($form) {
?>  
    <div class="container mt">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-5">
                <h2>lets connect - Sign Up</h2>
                <p>Please enter your username and desired password to sign up to Mismatch</p>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];  ?>" id="form" novalidate class="needs-validation">
                    <div class="form-group">
                        <label for="username">Username or Email</label>
                        <div>
                            <input type="text" class="form-control" id="username" placeholder="Username or Email" name="username" value="<?php if (!empty($username)) echo $username;   ?>" required>
                            <p class="valid-feedback">correct</p>
                            <p class="invalid-feedback">You forgot to fill in the username input</p>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label for="password1">Password</label>
                        <div>
                            <input type="password" class="form-control" id="password1" placeholder="Password" name="password1" value="<?php if (!empty($password1)) echo $password1;   ?>" required>
                            <small id="input-helpBlock" class="form-text">Password must be atleast 8 characters long.</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password2">Retype-Password</label>
                        <div>
                            <input type="password" class="form-control" id="password2" placeholder="Password" name="password2" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <div>
                        <button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>    

    
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>