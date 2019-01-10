<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
  <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link data-require="bootstrap-css@3.1.1" data-semver="3.1.1" rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
    

    <link rel = "stylesheet" type = "text/css" 
   href = "<?php echo base_url(); ?>css/style2.css">

    <style type="text/css">
    .navbar-dark .navbar-brand {
      color: #fff;
    }
    .navbar {
      position: relative;
      min-height: 50px;
      margin-bottom: 20px;
      border: 1px solid transparent;
    }
    .bg-dark {
      background-color: #343a40!important;
    }
    .welcomew{
      float: right;
      color: #fff;
      margin-right: 20px;
    }
    </style>

</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo base_url(); ?>"> Codeigniter </a>
    <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> -->
<div class="welcomew">

    <?php if(isset($email) && isset($id) && isset($role) ) echo "<div class='welcome'>".$email."--".$id."--".$role."</div>"; ?>

    <?php if(isset($email) && isset($id) && isset($role) ){ ?>
    <a style="float: right;" href="<?php echo site_url("usersController/logout"); ?>">logout</a>
    <?php } ?>
  </div>
  </nav>