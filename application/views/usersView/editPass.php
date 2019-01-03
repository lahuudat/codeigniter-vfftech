<?php
$id = $user_id;
$email = $email;
?>
<?php include('header.php') ?>
<div class="container">
  <h1>Edit Password</h1>
 <?php echo form_open_multipart("usersController/doEditPass/{$user->id}"); ?>

    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" aria-autocomplete="list">
      <?php echo form_error('password'); ?>
    </div>
    <div class="form-group">
      <label for="pwd">Confirm Password:</label>
      <input type="password" class="form-control" id="confirm_password" placeholder="Confirm password" name="passconf">
      <?php echo form_error('passconf'); ?>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  <?php echo form_close(); ?>
</div>
<?php include('footer.php') ?>
