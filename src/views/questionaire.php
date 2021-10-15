<?php
    use app\core\Application;
    $this->title = 'Questionaire';
?>
<div class="container">
    <h4>Questionaire</h4>
    <p>How do you feel about each topic</p>
    <?php if(Application::$app->session->getFlash('success')): ?>
        <div class="alert alert-success">
            <?php echo Application::$app->session->getFlash('success'); ?>
        </div>
    <?php endif; ?>
    <form action="/questionaire" method="post">

        <?php $category = $responses[0]["topic_category"]; ?>
        <?php 
            echo '<fieldset><legend> ' . $category . ' </legend>';
            foreach($responses as $resonse){

                if($category != $resonse['topic_category']){

                    $category = $resonse['topic_category'];
                    echo '<fieldset><legend> ' . $category . ' </legend>';
                }

                echo '<div class="form-row">';
                echo '<div class="col">';
                    echo '<label' . ($resonse['response'] == null ? 'class="error"' : '' ) .  'for="' . $resonse["response_id"] . '" >'. $resonse['topic_name'] .': </label>';
                echo '</div>';   
                echo '<div class="col">';
                    echo '<input type="radio" name="' . $resonse["response_id"] . '" id="' .$resonse["topic_name"] . '" value="1"  ' . ($resonse['response'] == 1 ? 'checked="checked"' : '' ) . '>Love';
                    echo '<input type="radio" name="' . $resonse["response_id"] . '" id="' .$resonse["topic_name"] . '" value="2"  ' . ($resonse['response'] == 2 ? 'checked="checked"' : '' ) . '>Hate';
                echo '</div>';
                echo '</div>';
            }

        echo '</fieldset>';
        echo '<input type="submit" value="Save Questionnaire" name="submit" />';


    ?>
    </form>
        
   
</div>