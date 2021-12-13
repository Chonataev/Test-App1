<?php
$pages = ceil($countPage[0]/3);
?>

<table class="table">
  <thead>
    <tr>
        <th scope="col"><a href="users?1&id">#</a></th>
        <th scope="col"><a href="users?1&firstname">First</a></th>
        <th scope="col"><a href="users?1&lastname">Last</a></th>
        <th scope="col"><a href="users?1&email">Email</a></th>
        <th scope="col"><a href="users?1&DOB">DOB</a></th>
        <th scope="col"><a href="users?1&gender">gender</a></th>
      <th scope="col">read</th>
      <th scope="col">update</th>
      <th scope="col">delete</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($users as $user):?>
        <tr>
          <th scope="row"><?php echo $user['id'];?></th>
          <td><?php echo $user['firstname'];?></td>
          <td><?php echo $user['lastname'];?></td>
          <td><?php echo $user['email'];?></td>
          <td><?php echo $user['DOB'];?></td>
          <td><?php echo $user['gender'];?></td>
          <td>
            <a href="/users/detail?<?php echo $user['id'];?>">
              <button class="btn btn-success btn-sm" type="submit">read</button>
          </a>
          </td>
          <td>
            <a href="/users/update?<?php echo $user['id'];?>">
              <button class="btn btn-primary btn-sm" type="submit">update</button>
          </a>
          </td>
          <td>
            <a href="/users/delete?<?php echo $user['id'];?>">
              <button class="btn btn-danger btn-sm" type="submit">delete</button>
          </a>
          </td>
        </tr>
    <?php endforeach?>
  </tbody>
</table>
<div class="d-flex" style="position:fixed; bottom:0; left:50%">
  <?php for($i = 1; $i<=$pages; $i++):?>
    <h4> 
      <a class="d-block" href="users?<?php echo $i?> " > 
        <?php echo $i."&nbsp";?>
      </a>
    </h4>
  <?php endfor ?>
</div>