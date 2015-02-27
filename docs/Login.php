
<html>
<head>
	<title>Login</title>
	
		<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	 	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


</head>
<body>
<?php
function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
    }

if (isset($_POST['submit'])) {
 	$obj = ORM::getInstance();
	$obj->setTable('users');

	$result = $obj->selectAll();
	foreach ($result as $key => $value) {
		if ($value['email'] == $_POST['email']) {
			echo $value['password'];
			echo "<br/>";
			echo md5($_POST['password']);
			echo "<br/>";
			echo $value['type'];
			if ($value['password'] === md5($_POST['password'])) {
				
				session_start();
				$_SESSION['username'] = $value["username"];
				$_SESSION['image'] = $value["profileImg"];
				echo "<p class='navbar-text'>Signed in as Mark Otto</p>";
				if ($value['type'] == "normal") {
					//redirect to the user home page
					
				}else{
					
					
					header("Location: http://localhost/PHP-Project/docs/All_Users.php");
					//redirect to the admin home page
				}
				
			}else {
				echo "not logged" ;
			}
		}
	}

 } 

?>

<div class="container" >
 <div class="row">

 <div class="page-header">
   <img src="../static/logo.png" style="width:600px;height=300px;"alt="...">
</div>

    <div class="col-md-8" >
		<h1 class="page-header"> Welcome to Cafe </h1>
		<form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data" />
			<h5> <strong> Email : </strong></h5>
				<input type="text" class="form-control  has-error" placeholder="Text input" name="email" value=<?php 
						 if (!empty($_POST["email"]))
				   		{
				   				echo $_POST['email'];
				   		}

?>>

		<h5> <strong>password : </strong></h5>
   <input type="password" class="form-control" placeholder="Text input" name="password" value=<?php 
   		 if (!empty($_POST["password"]))
   				{
   					echo $_POST['password'];
   				}
   ?>>
   <br/>

<div class="form-group">
<a href="http://localhost/PHP-Project/docs/Forget_Password.php" style="margin-left:20px; margin-top:20px"">Forget password?</a>
 <input type="submit" name="submit" class="btn btn-primary" style="float:right" value="submit"> 
</div>

</form>
    </div>
 </div>
 </div>


}

</body>
</html>