<?php
$id = $user_id;
$email = $email;
?>

<?php include('header.php') ?>

<div class="container">
  <h1>Edit</h1>
 <?php echo form_open_multipart("usersController/doEdit/{$user->id}"); ?>


    <div class="form-group">
      
      <img style="margin-bottom: 20px; width: 200px; height: auto;" src="<?php echo base_url(); ?>images/<?php if($user->img==''){ echo "profile.png"; }else{ echo $user->img; }  ?>">
      <input type="file" name="userImg" />
      <?php echo form_error('img'); ?>
    </div>

    <div class="form-group">
      <label for="email">Name:</label>
      <input type="text" name="name" placeholder="Enter name" class="form-control" id="email" value="<?php echo $user->name; ?>" >
      <?php echo form_error('name'); ?>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" placeholder="Enter email" class="form-control" id="email" value="<?php echo $user->email; ?>" readonly>
      <?php echo form_error('email'); ?>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  <?php echo form_close(); ?>
  <br>
    <?php echo anchor("usersController/editPass/{$user->id}", 'Change password', 'class="btn btn-default"'); ?>
</div>
<?php include('footer.php') ?>
