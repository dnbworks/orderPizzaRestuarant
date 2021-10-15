<?php
  require_once("../functions/startsession.php");

  $pagetitle = 'View Profile';
  $pageIndex = 2;

  require_once("../partials/header.php");

  require_once("../functions/connectvars.php"); 
  require_once("../functions/appvar.php");

  require_once("../partials/navmenu.php");

?>

<?php


  $dbc = mysqli_connect(host, user, pwd, database ) or die("couldn't connect to database");
  $user_idCookie = $_SESSION['user_id'];

  $user_id = $_GET['id'] ??  $user_idCookie;

  $query = "SELECT * FROM mismatch_users WHERE user_id = '$user_id'";
  $data = mysqli_query($dbc, $query);

  if (mysqli_num_rows($data) == 1) {
    $row = mysqli_fetch_array($data);
    echo '<table>';

    echo '<tr>';
    echo '<td>Picture: </td>';
    echo '<td><img src="' . location . $row["picture"] . '" width="100px"></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>Username: </td>';
    echo '<td>' . $row["username"] . '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>First name: </td>';
    echo '<td>' . $row["first_name"] . '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>Last name: </td>';
    echo '<td>' . $row["last_name"] . '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>Gender: </td>';
    echo '<td>' . $row["gender"] . '</td>';
    echo '</tr>';
    
    echo '<tr>';
    echo '<td>Birthdate: </td>';
    echo '<td>' . $row["birthdate"] . '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>City: </td>';
    echo '<td>' . $row["city"] . '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>State: </td>';
    echo '<td>' . $row["state"] . '</td>';
    echo '</tr>';
  
    echo '</table>';
   
    
  }
  mysqli_close($dbc);

?> 

<?php if($user_id == $user_idCookie): ?>
 <p>Would you like to <a href="./edit-profile.php">Edit your profile</a></p>
<?php endif; ?>   
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.bundle.min.js"></script>

<?php
  require_once("../partials/footer.php");
?>