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

      <form method="POST" enctype="multipart/form-data" id="fupForm" >
        <input type="hidden" id="id" name="id" value="<?php echo $user->id; ?>">
      <div class="form-group">
        <?php $eimg = "images/".$user->img; ?>
      <img id="avatar" style="margin-bottom: 20px; width: 200px; height: auto;" src="<?php echo base_url(); ?>images/<?php if($user->img==''){ echo "profile.png"; }else if(!file_exists($eimg)){ echo "tmp.png"; } else{ echo $user->img; }  ?>">
      <input style="display: none;" onchange="readURL(this);" id="file" name="file" type="file" name="userImg" />

      <button id="submitUpload" style="display: block;" type="submit" class="btn btn-primary"><i class="fas fa-arrow-circle-up"></i></button>
      <?php echo form_error('img'); ?>
    </div>
  </form>
    
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
      
    </div>
    <button style="margin-bottom: 20px" id="submit" class="btn btn-default">Submit</button>
  <!-- </form> -->
  <br>
    <?php echo anchor("usersController/editPass/{$user->id}", 'Change password', 'class="btn btn-default"'); ?>
    </div>
  </div>

  <script type="text/javascript">
     function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#avatar')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(auto);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
  </script>

  <script>
    $(document).ready(function(){
      $("#avatar").click(function(){
        $("#file").trigger("click");
      });
    });
  </script>

  <script>
    
     $("#fupForm").on('submit', function(e){

      var id = $("#id").val();
          
        var file_data = $('#file').prop('files')[0];
       
        var type = file_data.type;

        var match = ["image/jpeg", "image/png", "image/jpg",];
       
        if (type == match[0] || type == match[1] || type == match[2]) {

            $.ajax({
                url: "/codeigniter2/index.php/usersController/uploadImgAjax", 
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData(this),
                type: 'post',
                success: function (res) {
                  $("#display").html(res);
                 
                }
              });
          } else {
            $('#display').text('Only upload image file');
            
        }
        return false;
    });
    </script>    

      <script type="text/javascript">
        $(document).ready(function(){
          $("#submit").click(function(){
            var id = $("#id").val();
          });
        });
      </script>

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
                $("#display").html("<div class='alert alert-success alert-dismissable'><button type='button' class='close'data-dismiss='alert' aria-hidden='true'>×</button><strong>Well done!</strong>" +result+ "..</div>");
              }
            });
          }

        });

      });
    </script>

</div>
<?php include('footer.php') ?>
