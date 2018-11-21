<?php include('header.php') ?>
<div class="container">
  <h1>Edit</h1>
 <?php echo form_open('welcome/doSignUp'); ?>
    <div class="form-group">
      <label for="email">Name:</label>
      <input type="text" name="name" placeholder="Enter name" class="form-control" id="email" >
      <?php echo form_error('name'); ?>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" placeholder="Enter email" class="form-control" id="email" >
      <?php echo form_error('email'); ?>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" aria-autocomplete="list">
      <?php echo form_error('password'); ?>
    </div>
    <div class="form-group">
      <label for="pwd">Nhập lại Password::</label>
      <input type="password" class="form-control" id="confirm_password" placeholder="Confirm password" name="passconf">
      <?php echo form_error('passconf'); ?>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  <?php echo form_close(); ?>
</div>
<?php include('footer.php') ?>
