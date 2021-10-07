<?php
    require_once("../functions/connectvars.php");
    
    $errormessage = "";

    session_start();

    if(!isset($_SESSION['user_id'])){
        if(isset($_POST['submit'])){

            $dbc = mysqli_connect(host, user, pwd, database ) or die("couldn't connect to database");
            
            $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
            $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

            if (!empty($user_username) && !empty($user_password)) {
                $query = "SELECT user_id, username FROM mismatch_users WHERE username = '$user_username' AND " .
                "password = SHA('$user_password')";

                $data = mysqli_query($dbc, $query);

                if (mysqli_num_rows($data) == 1) {
                    $row = mysqli_fetch_array($data);
                  
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $row['username'];

                    setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30)); 
                    setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));
                  
                    header('Location:' . 'http://localhost/letsConnect/index.php');
                } else {
                    $errormessage = "Sorry you must enter a valid username and password to login";
                }
            } else {
                $errormessage = "Sorry you must enter  username and password to login";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  
    <title>Mismatch - login</title>

</head>
<body>
<div class="container mt">

  <h2>lets connect - login</h2>
<?php
          if(isset($_SESSION['username'])){
        ?> 
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a href="../index.php" class="nav-link">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a href="view-profile.php" class="nav-link">View Profile</a>
            </li>
            <li class="nav-item">
              <a href="edit-profile.php" class="nav-link">Edit Profile</a>
            </li>
            <li class="nav-item">
              <a href="logout.php" class="nav-link active">Log out <?php echo $_SESSION['username'] ?> <span class="sr-only">(current)</span></a>
            </li>
          </ul>

        <?php
      } else {
        ?> 

  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a href="../index.php" class="nav-link ">Home </a>
    </li>
    <li class="nav-item">
      <a href="signup.php" class="nav-link">Sign Up</a>
    </li>
    <li class="nav-item">
      <a href="login.php" class="nav-link active">Log In <span class="sr-only">(current)</span></a>
    </li>
  </ul>

      
<?php
}
?>  
        <div class="row">
            <div class="col-12 col-md-6 col-lg-5">
            <?php
                if (empty($_SESSION['username'])) {
                  if ($errormessage !== "") {
                    echo '<div class="alert alert-danger" role="alert">' . $errormessage . '</div>';   
                  }   
            ?>
                
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];  ?>" id="form" novalidate class="needs-validation">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div>
                            <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?php if (!empty($user_username)) echo $user_username;   ?>" required>
                            <p class="valid-feedback">correct</p>
                            <p class="invalid-feedback">You forgot to fill in the username input</p>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div>
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="<?php if (!empty($password1)) echo $password1;   ?>" required>
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <div>
                        <button type="submit" class="btn btn-primary" name="submit">Log In</button>
                    </div>
                    </div>
                </form>
                <?php
                    } else {
                        echo ('<p class="login">You are logged in as ' . $_SESSION['username'] . '</p>');
                    }
                
                ?>
            </div>
        </div>
</div>


<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>