<?php
if (isset($this->session->userdata['logged_in'])) {
$id = ($this->session->userdata['logged_in']['id']);
$email = ($this->session->userdata['logged_in']['email']);
} else {
 redirect(site_url("welcome/login"));
}
?>

<?php echo $email."--".$id; ?>

<?php include('header.php') ?>
<!--   modal start -->
  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
            
                <div class="modal-body">
                    <p>Do you want to proceed?</p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>
<!-- end modal -->


  <div class="container">
    <?php if($msg = $this->session->flashdata('msg')):
      ?>
      <div class="alert alert-success">
        <?php echo $msg; ?>
      </div>
    <?php
    endif;
     ?>

    <div class="search">
      <form action="<?php echo site_url('welcome/searchUser');?>" method = "post">
        <input value="<?php echo $keyword; ?>" name = "keyword" type="text" class="form-control input-sm" maxlength="64" placeholder="Search" />
        <button type="submit" class="btn2 btn-primary btn-sm">Search</button>
      </form>
    </div>
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
              <?php echo anchor("welcome/edit/{$user->id}", 'edit', 'class="btn btn-info"'); ?>
               <a href="#" data-href="<?php echo site_url("welcome/delete/{$user->id}"); ?>" data-toggle="modal" class="btn btn-danger" data-target="#confirm-delete">Delete</a>
            </td>
          </tr>
          <?php } ?>


        </tbody>
      </table>
       

    </div>

<?php include('footer.php') ?>

<script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>