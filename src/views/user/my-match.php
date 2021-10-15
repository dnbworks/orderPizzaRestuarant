<?php 


  // Custom function to draw a bar graph given a data set, maximum value, and image filename
  function draw_bar_graph($width, $height, $data, $max_value, $filename) {
    // Create the empty graph image
    $img = imagecreatetruecolor($width, $height);

    // Set a white background with black text and gray graphics
    $bg_color = imagecolorallocate($img, 255, 255, 255);       // white
    $text_color = imagecolorallocate($img, 255, 255, 255);     // white
    $bar_color = imagecolorallocate($img, 0, 0, 0);            // black
    $border_color = imagecolorallocate($img, 192, 192, 192);   // light gray

    // Fill the background
    imagefilledrectangle($img, 0, 0, $width, $height, $bg_color);

    // Draw the bars
    $bar_width = $width / ((count($data) * 2) + 1);
    for ($i = 0; $i < count($data); $i++) {
      imagefilledrectangle($img, ($i * $bar_width * 2) + $bar_width, $height,
        ($i * $bar_width * 2) + ($bar_width * 2), $height - (($height / $max_value) * $data[$i][1]), $bar_color);
      imagestringup($img, 5, ($i * $bar_width * 2) + ($bar_width), $height - 5, $data[$i][0], $text_color);
    }

    // Draw a rectangle around the whole thing
    imagerectangle($img, 0, 0, $width - 1, $height - 1, $border_color);

    // Draw the range up the left side of the graph
    for ($i = 1; $i <= $max_value; $i++) {
      imagestring($img, 5, 0, $height - ($i * ($height / $max_value)), $i, $bar_color);
    }

    // Write the graph image to a file
    imagepng($img, $filename, 5);
    imagedestroy($img);
  } // End of draw_bar_graph() function




require_once("../functions/startsession.php");

require_once("../functions/connectvars.php"); 
require_once("../functions/appvar.php");

$pagetitle = ' My match!';
$pageIndex = 5;


  // Insert the page header
require_once("../partials/header.php");

  // Make sure the user is logged in before going any further.
if(!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php"> Login</a> to access this page</p>';
    exit();
}

  // Show the navigation menu
require_once("../partials/navmenu.php");

  // Connect to the database
$dbc = mysqli_connect(host, user, pwd, database ) or die("couldn't connect to database");


// only look for a mismatch if the user has answers questionnaire responds

$fetch = "SELECT * FROM mismatch_response WHERE user_id = '"  . $_SESSION['user_id'] . "'";

$data = mysqli_query($dbc, $fetch);

if(mysqli_num_rows($data) != 0){
    // $query = "SELECT mr.response_id, mr.topic_id, mr.response, mt.name AS topic_name FROM mismatch_response AS mr INNER JOIN mismatch_topic AS mt USING (topic_id) WHERE mr.user_id = '" . $_SESSION['user_id'] . "'";

    $query = "SELECT mr.response_id, mr.topic_id, mr.response, mt.name AS topic_name, mc.name AS category_name " .
    "FROM mismatch_response AS mr " .
    "INNER JOIN mismatch_topic AS mt USING (topic_id) " .
    "INNER JOIN mismatch_category AS mc USING (category_id) " .
    "WHERE mr.user_id = '" . $_SESSION['user_id'] . "'";


    $data = mysqli_query($dbc, $query);

    $user_responses = array();

    while($row = mysqli_fetch_array($data)){
        array_push($user_responses, $row);
    }

    
    // Initialize the mismatch search results
    $mismatch_score = 0;
    $mismatch_user_id = -1;
    $mismatch_topics = array();
    $mismatch_categories = array();

    // select users who aren't logged in
    $query2 = "SELECT user_id FROM mismatch_users WHERE user_id != '". $_SESSION['user_id'] . "'";

    $data2 = mysqli_query($dbc,  $query2);

    // var_dump( $data2);

   

    while($row2 = mysqli_fetch_array($data2)){

       
        $query3 = "SELECT response_id, topic_id, response FROM mismatch_response WHERE user_id = '" . $row2['user_id'] . "'";

      
        $data3 = mysqli_query($dbc,  $query3);
        // var_dump($data3);

        $mismatch_responses = array();

        while($row3 = mysqli_fetch_array($data3)){
            // echo $row3['user_id'];
            array_push($mismatch_responses, $row3);
        }

        // Compare each response and calculate a mismatch total
        $score = 0;
        $topics = array();
        $categories = array();
        for ($i=0; $i < count($user_responses); $i++) { 
            if(((int)$user_responses[$i]['response'] + (int)$mismatch_responses[$i]['response']) == 3){
                $score += 1;
                array_push($topics, $user_responses[$i]['topic_name']);
                array_push($categories, $user_responses[$i]['category_name']);
            }
        }

        if($score > $mismatch_score){
            // we found a better mismatch, so update the mismatch seach results
            $mismatch_score = $score;
            $mismatch_user_id = $row2['user_id'];
            $mismatch_topics = array_slice($topics, 0);
            $mismatch_categories = array_slice($categories, 0);
        }

    } // End of outer while loop
    

    if($mismatch_user_id != -1){
        $query = "SELECT username, first_name, last_name, city, state, picture FROM mismatch_users WHERE user_id = '$mismatch_user_id'";

        $data = mysqli_query($dbc,  $query);

        if(mysqli_num_rows($data) == 1){

            $row = mysqli_fetch_array($data);

            echo '<div class="container">';
            echo '<div class="row">';
            echo '<div class="col-12 col-md-6 col-lg-6">';
            echo '<div class="d-flex align-items-center">';

            echo '<div>';
            echo '<p>' . $row['first_name'] . ' ' . $row['last_name']  .'</p>';
            echo '<p>' . $row['city'] . ', ' . $row['state'] . '</p>';
            echo '</div>';


            echo '<div>';
            echo '<img src="' . location . $row['picture'] . '" alt="profile" width="100px"/>';
            echo '</div>';

            echo '</div>';

            echo '<h4>You are mismatched on the following ' . count($mismatch_topics) . ' topics:</h4>';
            echo '<table><tr>'; // start of table
            $i = 0;
            foreach($mismatch_topics as $topic){
                echo '<td>' . $topic . '</tb>';
                if(++$i > 3){
                    echo '</tr><tr>';
                    $i = 0;
                }
            }
            echo '</tr></table>'; // end of table

            // Calculate the mismatched category totals
            $category_totals = array(array($mismatch_categories[0], 0));
            foreach ($mismatch_categories as $category) {
                if ($category_totals[count($category_totals) - 1][0] != $category) {
                    array_push($category_totals, array($category, 1));
                }
                else {
                    $category_totals[count($category_totals) - 1][1]++;
                }
            }

            // Generate and display the mismatched category bar graph image
            echo '<h4>Mismatched category breakdown:</h4>';
            draw_bar_graph(480, 240, $category_totals, 5, location . $_SESSION['user_id'] . '-mymismatchgraph.png');
            echo '<img src="' . location . $_SESSION['user_id'] . '-mymismatchgraph.png" alt="Mismatch category graph" /><br />';

            echo '<h4>View <a href="./view-profile.php?id='. $mismatch_user_id .'">' . $row['first_name'] . ' ' . $row['last_name'] . '\'s profile</a>.</h4>';

            echo '</div>';
            echo '</div>';
            echo '</div>';

        } else {
            echo 'none';
        }

    } else {
        echo '<p>You must first <a href="./Questionaire.php">answer the questionaire</a> before you can be mismatched</p>';
    }
    
}

  // Insert the page footer
require_once("../partials/footer.php");


