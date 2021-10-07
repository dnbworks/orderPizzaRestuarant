<?php
    $this->title = 'Mismatch';
    use app\core\Application;
?>


<h4>Mismatch</h4>

<?php if(isset($errors)) :?>
    <div>
        <?php echo $errors[0]; ?>
    </div>
<?php else : ?>
    <div class="d-flex">
    <div>
        <p><?php echo $user['firstname']; ?> <?php echo $user['lastname']; ?></p>
        <p><?php echo $user['city']; ?> <?php echo $user['state']; ?></p>
    </div>
    <div>
        <?php if($user['picture']): ?>
            <img src="/uploads/<?php echo $user['picture'] ;?>" alt="" srcset="" width="100px">
        <?php else: ?>
            <img src="/assets/img/nopic.jpg" alt="" srcset="" width="100px">
        <?php endif; ?>
    </div>
</div>
<h4>You are mismatched on the following <?php echo count($topics); ?> topics:</h4>

<table class="table">
    <tr>
        <?php
              $i = 0;
              foreach($topics as $topic){
                  echo '<td>' . $topic . '</td>';
                  if(++$i > 3){
                      echo '</tr><tr>';
                      $i = 0;
                    }
              }
        ?>
    </tr>
</table>

<h4>Mismatched category breakdown:</h4>
<img src="/uploads/<?php echo Application::$app->user->user_id; ?>-mymismatchgraph.png" alt="Mismatch category graph" /><br/>

<h5>View <a href="/view-profile?id=<?php echo $user['user_id'];?>"><?php echo $user['firstname']; ?> <?php echo $user['lastname'] . "'s profile"; ?></a>.</h5>

<?php endif; ?>
 


        
        
                
