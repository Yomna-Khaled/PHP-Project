<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src ="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        
        <li><a href="#"> Products </a></li>
        <li><a href="http://localhost/PHP-Project/docs/All_Users.php"> Users </a></li>
        <li><a href="#"> Manual Orders </a></li>
        <li><a href="#"> Checks </a></li>

      </ul>

      <?php session_start(); ?>
      <ul class="nav navbar-nav navbar-right">

      <?php 
      if (isset($_SESSION['username']) && isset($_SESSION['image'])) {
      ?>
        <li><a href="http://localhost/PHP-Project/docs/Forget_Password.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        <li><p class='navbar-text' ><?php  echo "welcome ".$_SESSION['username'];?> </p></li>
        <li><img alt="userImage" style="height:40px; width:40px;" class="img-thumbnail" src="../uploads/<?php echo $_SESSION['image']?>"></li>
     <?php } ?> 
      </ul>

    </div>
  </div>
</nav>
  

</body>
</html>
