<?php

use app\core\Application;

$this->title = 'View Profile';
?>

<div class="container">
    <h4>View Profile</h4>
    <table class="table table-striped">
        <tr>
            <td>Picture: </td>
            <td>
            <?php if($user->picture): ?>
                <img src="/uploads/<?php echo $user->picture ;?>" alt="" srcset="" width="100px">
            <?php else: ?>
                <img src="/assets/img/nopic.jpg" alt="" srcset="" width="100px">
            <?php endif; ?>
           </td>
        </tr>
        <tr>
            <td>First name: </td>
            <td><?php echo $user->firstname; ?></td>
        </tr>
        <tr>
            <td>Last name: </td>
            <td><?php echo $user->lastname; ?></td>
        </tr>
        <tr>
            <td>Gender: </td>
            <td><?php echo $user->gender; ?></td>
        </tr>
        <tr>
            <td>Birthdate: </td>
            <td><?php echo $user->birthdate; ?></td>
        </tr>
        <tr>
            <td>City: </td>
            <td><?php echo $user->city; ?></td>
        </tr>
        <tr>
            <td>State: </td>
            <td><?php echo $user->state; ?></td>
        </tr>

    </table>
    
    <?php if(Application::$app->user->user_id == $user->user_id) :?>
        <a href="/edit-profile">Edit profile</a>
    <?php endif; ?>
</div>