<?php
$id = $user_id;
$email = $email;
?>
<?php include('header.php') ?>
<div class="container">
  <h1>Change Password</h1>
   <div id="display"></div>
 
   <form method="POST" id="formPass" action="/codeigniter2/index.php/usersController/changePassAjax">

   <input type="hidden" name="id" id="id" value="<?php echo $user->id; ?>">

    <div class="form-group">
      <label for="pwd">Old Password:</label>
      <input type="password" class="form-control" id="oldPassword" placeholder="Enter password" name="oldPassword" aria-autocomplete="list">
      <?php echo form_error('oldPasswordCf'); ?>
    </div>

    <input type="hidden" id="oldPasswordCf" value="<?php echo $user->password; ?>" name="oldPasswordCf">

    <div class="form-group">
      <label for="pwd">New Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" aria-autocomplete="list">
      <?php echo form_error('password'); ?>
    </div>
    <div class="form-group">
      <label for="pwd">Confirm Password:</label>
      <input type="password" class="form-control" id="confirm_password" placeholder="Confirm password" name="passconf">
      <?php echo form_error('passconf'); ?>
    </div>
    <button id="submit" type="submit" class="btn btn-default">Submit</button>

  </form>
  
</div>
<?php include('footer.php') ?>


    <script type="text/javascript">
      $(document).ready(function() {

    $("#formPass").validate({
      rules: {
        oldPassword: "required",
        passconf: "required",
        password: {
          required: true,
          minlength: 2
        }
      },
      messages: {
        oldPassword: "Please provide a old password",
        passconf: "Please provide a confirm password",
        password: {
          required: "Please provide a password",
          minlength: "Please enter at least 2 characters."
        }
      }
    });
  });
    </script>

    <script> 
       $("#formPass").submit(function(e) {


    var form = $(this);
    var url = form.attr('action');
    var oldPassword = $("#oldPassword").val();
    var password = $("#password").val();
    var confirm_password = $("#confirm_password").val();

    if(oldPassword != "" && password != "" && confirm_password != ""){

    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(result){
                $("#display").html(result);
                // $("#display").html("<div class='alert alert-success alert-dismissable'><button type='button' class='close'data-dismiss='alert' aria-hidden='true'>×</button>" +result+ "..</div>");
              }
         });
    e.preventDefault(); // avoid to execute the actual submit of the form.
    }

});
    </script> 
