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

</div>
<?php include('footer.php') ?>
