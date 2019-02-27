<?php include('header.php') ?>
<div class="container">
  <?php if($msg = $this->session->flashdata('msg')):
      ?>
      <div class="alert alert-danger">
        <?php echo $msg; ?>
      </div>
    <?php
    endif;
     ?>

   <?php if($msg2 = $this->session->flashdata('msg2')):
      ?>
      <div class="alert alert-success">
        <?php echo $msg2; ?>
      </div>
    <?php
    endif;
     ?>
  <h1>Reset password</h1>
 <?php echo form_open('users/usersController/doForgotPass'); ?>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" placeholder="Enter email" class="form-control" id="email" >
      <?php echo form_error('email'); ?>
    </div>
    <button type="submit" class="btn btn-default">Reset</button>
    
  <?php echo form_close(); ?>
</div>
<?php include('footer.php') ?>
