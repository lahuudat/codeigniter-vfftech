<?php
if (isset($this->session->userdata['logged_in'])) {

  redirect(site_url("welcome"));

} 
?>

<?php include('header.php') ?>
<div class="container">

   <?php if($msg = $this->session->flashdata('msg')):
      ?>
      <div class="alert alert-success">
        <?php echo $msg; ?>
      </div>
    <?php
    endif;
     ?>

  
  <h1>sign in</h1>
 <?php echo form_open('welcome/doLogin'); ?>
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
    <button type="submit" class="btn btn-default">Submit</button>
    <p>Don't have an account? <a href="<?php echo site_url("welcome/create"); ?>">sign up</a> </p>
  <?php echo form_close(); ?>
</div>
<?php include('footer.php') ?>
