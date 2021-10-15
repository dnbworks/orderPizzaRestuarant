<?php
   require_once("../functions/startsession.php");

   $pagetitle = 'Edit Profile';
   $pageIndex = 3;

   require_once("../partials/header.php");

   require_once("../functions/connectvars.php"); 
   require_once("../functions/appvar.php");

   require_once("../partials/navmenu.php");


if (!isset($_SESSION['user_id'])) {
  echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
  exit();
} 
  
$useridCookie = $_SESSION['user_id'];

if(ISSET($_POST['submit'])){

$dbc = mysqli_connect(host, user, pwd, database ) or die("couldn't connect to database");

$picture = $_FILES['file'];
$firstname = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
$lastname = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
$gender = mysqli_real_escape_string($dbc, trim($_POST['Gender']));
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$city =  mysqli_real_escape_string($dbc, trim($_POST['city']));
$state =  mysqli_real_escape_string($dbc, trim($_POST['state']));

$old_picture = mysqli_real_escape_string($dbc, trim($_POST['old_image']));


$picname = $_FILES['file']['name'];
$pictype = $_FILES['file']['type'];
$picsize = $_FILES['file']['size'];
$piclocation = $_FILES['file']['tmp_name'];
$picerror = $_FILES['file']['error'];



if((!empty($firstname)) && (!empty($lastname)) && (!empty($gender)) && (!empty($day)) && (!empty($month)) && (!empty($year)) && (!empty($city)) && (!empty($state)) ){ 
    $birthdate = $year . "-" . $month . "-" . $day;
    $query = "";
    if ($picture && $piclocation) {
       
        $allowed = array("jpeg", "jpg", "png");
        $Actual = explode("/", $pictype);
        $ActualFormat = strtolower(end($Actual));

        if(in_array($ActualFormat, $allowed)){
            if($picsize < 1000000){
                if($picerror === 0){
                    $actualimage = time() . $picname;
                    $actualLocation  = location . $actualimage;
                    if(move_uploaded_file($piclocation, $actualLocation)){
                      
                        
                        if ($old_picture && ($old_picture != $picname)) {
                    
                            if(file_exists(dirname(__DIR__) . '/uploads/profile.jpg'. $old_picture )){
                                
                                // echo dirname(__DIR__) . '/uploads/'. $old_picture . '<br>';
                                // echo $firstname . '<br>';
                                // echo $lastname. '<br>';
                                // echo $gender. '<br>';
                                // echo $day. '<br>';
                                // echo $month. '<br>';
                                // echo $year. '<br>';
                                // echo $state. '<br>';
                                // echo $city. '<br>';
                        
                                // echo $old_picture .  '<br>';
                                // echo '<pre>';
                                // var_dump($picture);
                                // echo '</pre>';
                                // exit;
                                unlink(dirname(__DIR__) . '/uploads/profile.jpg'. $old_picture);
                            } 
                        }
                      
        
                        $query = "UPDATE `mismatch_users` SET `first_name`= '$firstname',`last_name`= '$lastname', `gender`= '$gender', `birthdate`= '$birthdate', `city`= '$city',`state`= '$state', `picture`= '$actualimage' WHERE user_id = '$useridCookie'";

                        // echo $query;
                        // exit;
                    } else {
                        
                        echo '<p>An error occured in moving the image from a temporary folder</p>';
                    }
                } else {
                    echo '<p>An error occured in uploading the image</p>';
                }
                
            } else {
                echo '<p>image is too large</p>';
            }
        
            @unlink($_FILES['screenshot']['tmp_name']);
        
        } else {
            echo '<p>We only accept image formats such as jpeg, jpg and png</p>';
        }
        
   
    } else {
        $query = "UPDATE `mismatch_users` SET `first_name`= '$firstname',`last_name`= '$lastname', `gender`= '$gender', `birthdate`= '$birthdate', `city`= '$city',`state`= '$state' WHERE user_id = '$useridCookie'";
      
    }

    
}



$results = mysqli_query($dbc, $query) or die ("error");
mysqli_close($dbc);

header('Location:' . 'http://localhost/letsConnect/user/view-profile.php');
exit;

} else {
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] .
  '. <a href="logout.php">Log out</a>.</p>');

    $dbc = mysqli_connect(host, user, pwd, database ) or die("couldn't connect to database");
    $user_idSession = $_SESSION['user_id'];

    $query = "SELECT * FROM mismatch_users WHERE user_id = '$user_idSession'";
    $data = mysqli_query($dbc, $query);

    if (mysqli_num_rows($data) == 1) {
      $row = mysqli_fetch_array($data);
      if($row != null){
        $firstname = $row["first_name"];
        $lastname = $row["last_name"];
        $gender = $row["gender"];
        $birthdate = $row["birthdate"];
        $city = $row["city"];
        $state = $row["state"];
        $old_picture = $row["picture"];
  
        $dateArray = explode("-", $birthdate);


      } else {
          echo '<p>There was a problem accessing your profile.</p>';
      }

   
    }
    mysqli_close($dbc);
}


?>  

<div class="row">
      <div class="col-12 col-md-8 col-lg-6"> 
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];  ?>" enctype="multipart/form-data">
              <div class="row">
                  <div class="col">
                      <div class="form-group">
                          <label for="firstname">First name</label>
                          <div>
                              <input type="text" class="form-control" id="firstname" placeholder="First name" name="firstname" value="<?php echo $firstname; ?>" required>
                          </div>
                      </div>
                  </div> 
                  <div class="col">
                      <div class="form-group">
                          <label for="lastname">Last name</label>
                          <div>
                              <input type="text" class="form-control" id="lastname" placeholder="Last name" name="lastname" value="<?php echo $lastname; ?>" required>
                          </div>
                      </div>
                  </div> 
              </div>
              
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Gender" id="female" value="Female" checked required>
                  <label class="form-check-label" for="female">Female</label>
              </div>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Gender" id="male" value="Male" required >
                  <label class="form-check-label" for="male">Male</label>
              </div>

              <div class="row">
                  <div class="form-group col-4">
                      <select class="form-control" id="birthdayDay" name="day" required >
                          <option value="<?php if (!empty($dateArray[2])) echo $dateArray[2]; ?>" selected hidden>Day</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                        </select>
                  </div>
                  <div class="form-group col-4">
                      <label for="birthdayMonth" class="sr-only">Birthday month</label>
                      <select class="form-control" id="birthdayMonth" name="month" required>
                        <option value="<?php if (!empty($dateArray[1])) echo $dateArray[1]; ?>" selected hidden>Month</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                      </select>
                    </div>
                    <div class="form-group col-4">
                      <label for="birthdayYear" class="sr-only">Birthday year</label>
                      <select class="form-control" id="birthdayYear" name="year" required>
                        <option value="<?php if (!empty($dateArray[0])) echo $dateArray[0]; ?>" selected hidden>Year</option>
                        <option value="1980">1980</option>
                        <option value="1981">1981</option>
                        <option value="1982">1982</option>
                        <option value="1983">1983</option>
                        <option value="1984">1984</option>
                        <option value="1985">1985</option>
                        <option value="1986">1986</option>
                        <option value="1987">1987</option>
                        <option value="1988">1988</option>
                        <option value="1989">1989</option>
                        <option value="1990">1990</option>
                        <option value="1991">1991</option>
                        <option value="1992">1992</option>
                        <option value="1993">1993</option>
                        <option value="1994">1994</option>
                        <option value="1995">1995</option>
                        <option value="1996">1996</option>
                        <option value="1997">1997</option>
                        <option value="1998">1998</option>
                        <option value="1999">1999</option>
                        <option value="2000">2000</option>
                      </select>
                    </div>
                  
              </div>

              <div class="row">
                  <div class="col">
                        <div class="form-group">
                            <label for="city">City</label>
                            <div>
                                <input type="text" class="form-control" id="city" placeholder="City" name="city" value="<?php echo $city; ?>" required>
                            </div>
                        </div>
                  </div> 
                  <div class="col">
                        <div class="form-group">
                            <label for="state">State</label>
                            <div>
                                <input type="text" class="form-control" id="state" placeholder="State" name="state" value="<?php echo $state; ?>" required> 
                            </div>
                        </div>
                  </div> 
                </div>
                <div class="form-group">
                  <div class="custom-file">
                    <input type="file" id="example-file-custom-button" class="custom-file-input" name="file" value="" >
                    <input type="hidden"  name="old_image" value="<?php echo $old_picture; ?>" >
                    <label class="custom-file-label" for="example-file-custom-button" data-browse="Select file" >Custom file browser</label>
                  </div>
                </div>

                <img src="<?php echo location . $old_picture; ?>" alt="" srcset="" width="100px">

              <div class="form-group">
                  <div>
                      <button type="submit" class="btn btn-primary" name="submit">Save Profile</button>
                  </div>
              </div>
          </form>
      </div>
  </div>


    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>

<?php
  require_once("../partials/footer.php");
?>
 