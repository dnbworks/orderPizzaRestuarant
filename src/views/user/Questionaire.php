<?php

require_once("../functions/startsession.php");


$pagetitle = ' Questionaire!';
$pageIndex = 4;

require_once("../functions/connectvars.php"); 

require_once("../partials/header.php");

if(!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php"> Login</a> to access this page</p>';
    exit();
}

require_once("../partials/navmenu.php");
 
$dbc = mysqli_connect(host, user, pwd, database ) or die("couldn't connect to database");

$query = "SELECT * FROM mismatch_response WHERE user_id = '" . $_SESSION["user_id"] . "'";

$data = mysqli_query($dbc, $query);

if (mysqli_num_rows($data) == 0) {
    $topicIds = array();
    $query = "SELECT topic_id FROM mismatch_topic ORDER BY topic_id";
    $data = mysqli_query($dbc, $query);

    while($row = mysqli_fetch_array($data)){
        array_push($topicIds, $row['topic_id']);
 
    }

    
    foreach($topicIds as $topicId){

        $queryInsert = "INSERT INTO `mismatch_response` (`user_id`, `topic_id`) VALUES ('". $_SESSION["user_id"]."', '$topicId') ";
        mysqli_query($dbc, $queryInsert);

    }

}

// submited form

if(isset($_POST['submit'])) {
    foreach($_POST as $response_id => $response){

        $query = "UPDATE `mismatch_response` SET `response`= '$response' WHERE response_id = '$response_id'";
        mysqli_query($dbc, $query);
       
    }
    
    echo '<p>Your response have been saved. </p>';

}

// query to select response for generation data-driven form

// $querySelct = "SELECT `response_id`, `topic_id`, `response` FROM `mismatch_response` WHERE `user_id` = '" . $_SESSION["user_id"] . "'";

$query_response = "SELECT mr.response_id, mr.topic_id, mr.response, mt.name AS topic_name, mc.name AS topic_category FROM mismatch_response AS mr INNER JOIN mismatch_topic AS mt USING(topic_id) INNER JOIN mismatch_category AS mc USING(category_id) WHERE mr.user_id ='" . $_SESSION['user_id'] . "'";

$data1 = mysqli_query($dbc, $query_response);

$responses = array();

while($rows = mysqli_fetch_array($data1)){
    // look up for the topic name for the response from the topic table 
    // $query2 = "SELECT `name`, `category_id` FROM `mismatch_topic` WHERE `topic_id` =  '" . $rows["topic_id"] . "'";

    
    // $data2 = mysqli_query($dbc, $query2);

    // if(mysqli_num_rows($data2) == 1 ){
    //     $row2 = mysqli_fetch_array($data2);
    //     $rows["topic_name"] = $row2["name"];
   

        // look up the category name for the topic from the category table

        // $query3 = "SELECT name FROM mismatch_category WHERE category_id = '" . $row2["category_id"] . "'";
        // $data3 = mysqli_query($dbc, $query3);

        // if(mysqli_num_rows($data3) == 1){
        //     $row3 = mysqli_fetch_array($data3);
        //     $rows["topic_category"] = $row3["name"];
        // }
        
        array_push($responses, $rows);
        
       
    // }

}

mysqli_close($dbc);

//  print_r($responses);

// Generate Questionaire form through response array
echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
echo '<p>How do you feel about each topic</p>';

$category = $responses[0]['topic_category'];
echo '<fieldset><legend> ' . $category . ' </legend>';
foreach($responses as $resonse){

    if($category != $resonse['topic_category']){

        $category = $resonse['topic_category'];
        echo '<fieldset><legend> ' . $category . ' </legend>';
    }

    echo '<div class="row">';
    echo '<div class="col-2">';
         echo '<label' . ($resonse['response'] == null ? 'class="error"' : '' ) .  'for="' . $resonse["response_id"] . '" >'. $resonse['topic_name'] .': </label>';
    echo '</div>';   
    echo '<div class="col-2">';
        echo '<input type="radio" name="' . $resonse["response_id"] . '" id="' .$resonse["topic_name"] . '" value="1"  ' . ($resonse['response'] == 1 ? 'checked="checked"' : '' ) . '>Love';
        echo '<input type="radio" name="' . $resonse["response_id"] . '" id="' .$resonse["topic_name"] . '" value="2"  ' . ($resonse['response'] == 2 ? 'checked="checked"' : '' ) . '>Hate';
    echo '</div>';
    echo '</div>';


   

    

    // tenary operator
    
    
    // if($resonse['response'] == 1){
    //     echo '<input type="radio" name="' . $resonse["response_id"] . '" id="' .$resonse["topic_name"] . '" value="1" checked="checked">Love';
    // } else {
    //     echo '<input type="radio" name="' . $resonse["response_id"] . '" id="' .$resonse["topic_name"] . '" value="1">Love';
    // }

    // if($resonse['response'] == 2){
    //     echo '<input type="radio" name="' . $resonse["response_id"] . '" id="' .$resonse["topic_name"] . '" value="2" checked="checked">Hate';
    // } else {
    //     echo '<input type="radio" name="' . $resonse["response_id"] . '" id="' .$resonse["topic_name"] . '" value="2">Hate<br>';
    // }

}

echo '</fieldset>';
echo '<input type="submit" value="Save Questionnaire" name="submit" />';
echo '</form>';

require_once("../partials/footer.php");


    