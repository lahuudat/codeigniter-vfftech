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

   
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user ) {
          ?>
          <tr>
            <td><?php echo $user->id; ?></td>
            <td><?php echo $user->name; ?></td>
            <td><?php echo $user->email; ?></td>
            <td>
              <?php echo anchor('#', 'edit', 'class="btn btn-info"'); ?>
              <?php echo anchor('#', 'delete', 'class="btn btn-danger"'); ?>
            </td>
          </tr>
          <?php } ?>


        </tbody>
      </table>
       <?php echo anchor('welcome/create', 'sign up', 'class="btn btn-primary"'); ?>

    </div>

<?php include('footer.php') ?>