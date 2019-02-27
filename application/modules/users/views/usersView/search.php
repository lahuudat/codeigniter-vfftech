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

    <div class="search">
      <form action="<?php echo site_url('users/usersController/searchUser');?>" method = "get">
        <input value="<?php echo $keyword; ?>" name = "keyword" type="text" class="form-control input-sm" maxlength="64" placeholder="Search email" />
        <button type="submit" class="btn2 btn-primary btn-sm">Search</button>
      </form>
    </div>

    <button style="float: right;" type="button" class="btn btn-default"><a href="<?php base_url(); ?>users/codeigniter2/usersController/listDeleteUsers/">List delete user</a></button>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Avatar</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>

        <?php if($users==null){ ?>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>  
          </tr> 
       <?php }else{ ?>
        <?php foreach ($users as $user ) {
          ?>
          <tr <?php if($user->id == $id) echo "style='color: lightseagreen' "; ?>>
            <td><?php echo $user->id; ?></td>
            <td><?php echo $user->name; ?></td>
            <td><?php echo $user->email; ?></td>
            <td><?php if($user->role == 1){ echo "Admin";}else{echo "Member"; } ?></td>
            <td>
              <?php $eimg = "images/".$user->img; ?>
              <img style=" width: 100px; height: 100px;" src="<?php echo base_url(); ?>images/<?php if($user->img==''){ echo "profile.png"; }else if(!file_exists($eimg)){ echo "tmp.png"; } else{ echo $user->img; }  ?>"></td>
            <td> <?php if($user->id == $id && $role == 0 ){ ?>
              <?php echo anchor("users/usersController/edit/{$user->id}", 'edit', 'class="btn btn-info"'); ?>
               <a href="#" data-href="<?php echo site_url("users/usersController/delete/{$user->id}"); ?>" data-toggle="modal" class="btn btn-danger" data-target="#confirm-delete">Delete</a>
               <?php }else if($role == 1) { ?>
                  <?php echo anchor("users/usersController/edit/{$user->id}", 'edit', 'class="btn btn-info"'); ?>
               <a href="#" data-href="<?php echo site_url("users/usersController/delete/{$user->id}"); ?>" data-toggle="modal" class="btn btn-danger" data-target="#confirm-delete">Delete</a>
               <?php } ?>
            </td>
          </tr>
          <?php } ?>
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