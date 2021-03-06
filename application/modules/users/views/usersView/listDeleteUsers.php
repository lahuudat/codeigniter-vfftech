<?php
$id = $user_id;
$email = $email;
?>

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

    <h1>List deleted users</h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Avatar</th>
          <th>Deleted_at</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user ) {
          ?>
          <tr>
            <td><?php echo $user->id; ?></td>
            <td><?php echo $user->name; ?></td>
            <td><?php echo $user->email; ?></td>
            <td><img style=" width: 100px; height: 100px;" src="<?php echo base_url(); ?>images/<?php if($user->img==''){ echo "profile.png"; }else{ echo $user->img; }  ?>"></td>


            <td>
              <?php echo $user->deleted_at; ?>
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
        });
    </script>