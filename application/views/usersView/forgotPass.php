<?php include('header.php') ?>
<div class="container">
  
  <h1>Reset password</h1>
 <?php echo form_open('usersController/doForgotPass'); ?>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" placeholder="Enter email" class="form-control" id="email" >
      <?php echo form_error('email'); ?>
    </div>
    <button type="submit" class="btn btn-default">Reset</button>
    
  <?php echo form_close(); ?>
</div>
<?php include('footer.php') ?>
