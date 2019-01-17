<?php
$id = $user_id;
$email = $email;
?>

<?php include('header.php') ?>


<div class="container">
  <h1>Edit</h1>
 <!-- <form id="formm"> -->
  <div id="display"></div>

  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
      <img style="margin-bottom: 20px; width: 200px; height: auto;" src="<?php echo base_url(); ?>images/<?php if($user->img==''){ echo "profile.png"; }else{ echo $user->img; }  ?>">
      <input type="file" name="userImg" />
      <?php echo form_error('img'); ?>
    </div>
    </div>
    <div class="col-md-9">
      <div class="form-group">
      <label for="email">Name:</label>
      <input type="text" name="name" placeholder="Enter name" class="form-control" id="name" value="<?php echo $user->name; ?>" >
      <?php echo form_error('name'); ?>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" placeholder="Enter email" class="form-control" id="email" value="<?php echo $user->email; ?>" readonly>
      <?php echo form_error('email'); ?>
      <input type="hidden" id="id" name="id" value="<?php echo $user->id; ?>">
    </div>
    <button style="margin-bottom: 20px" id="submit" class="btn btn-default">Submit</button>
  <!-- </form> -->
  <br>
    <?php echo anchor("usersController/editPass/{$user->id}", 'Change password', 'class="btn btn-default"'); ?>
    </div>
  </div>
    

    <script type="text/javascript">
      $(document).ready(function(){
        $("#submit").click(function(){

          var name = $("#name").val();
          var email = $("#email").val();
          var id = $("#id").val();
          
          if(name == ""){
            $("#display").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close'data-dismiss='alert' aria-hidden='true'>×</button><strong>Warning!</strong> The Name field is required..</div>");
          }
          else{
            $.ajax({
              type : "POST",
              url : "/codeigniter2/index.php/usersController/editNameAjax",
              data: {
                namea : name,
                emaila : email,
                ida : id
              },
              cache: false,
              success: function(result){
                // $("#display").html(result);
                $("#display").html("<div class='alert alert-success alert-dismissable'><button type='button' class='close'data-dismiss='alert' aria-hidden='true'>×</button><strong>Well done!</strong>" +result+ "..</div>");
              }
            });
          }

        });

      });
    </script>

</div>
<?php include('footer.php') ?>
