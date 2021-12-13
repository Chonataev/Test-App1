<?php

$this->title = $user->firstname;
?>

<a href="/users"><< Back to users</a>

<div class="m-auto mt-5" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Email:   <?php echo $user->email;?></h5>
    <h5 class="card-title">First Name:   <?php echo $user->firstname;?></h5>
    <h5 class="card-title">Last Name:   <?php echo $user->lastname;?></h5>
    <h5 class="card-title">DOB:   <?php echo $user->DOB;?></h5>
    <h5 class="card-title">Gender:   <?php echo $user->gender;?></h5>
    
  </div>
</div>