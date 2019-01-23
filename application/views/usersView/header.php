<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link data-require="bootstrap-css@3.1.1" data-semver="3.1.1" rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
    
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script> 

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
    
<div class="welcomew">

    <?php if(isset($email) && isset($id) && isset($role) ) echo "<div class='welcome'>".$email."--".$id."--".$role."</div>"; ?>

    <?php if(isset($email) && isset($id) && isset($role) ){ ?>
    <a style="float: right;" href="<?php echo site_url("usersController/logout"); ?>">logout</a>
    <?php } ?>
  </div>
  </nav>