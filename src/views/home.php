<?php
    use app\core\Application;
    $this->title = 'Home';

?>

<h4>Latest Members</h4>
<?php if($responseCount == 0): ?>
    <div class="alert alert-info" role="alert">
        Help members know your interests by filling in the <a href="/questionaire">Questionaire</a>
    </div>
<?php endif; ?>


<table class="table">
<?php foreach($users as $user): ?>
    <?php if($user['user_id'] !== Application::$app->user->user_id) : ?>
        <tr>
            <td>
            <?php if($user['picture']): ?>
                <img src="/uploads/<?php echo $user['picture'] ;?>" alt="" srcset="" width="100px">
            <?php else: ?>
                <img src="/assets/img/nopic.jpg" alt="" srcset="" >
            <?php endif; ?>
            </td>
            <td>
            <a href="/view-profile?id=<?php echo $user['user_id']; ?>"><?php echo $user['firstname']; ?> <?php echo $user['lastname']; ?></a>
            </td>
        </tr>
    <?php endif; ?>
<?php endforeach; ?>
</table>






