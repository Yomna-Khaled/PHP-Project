
<html>
<head>
	<title> Add User </title>
		<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	 	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</head>

<body>
<?php
	include_once ("AdminCss.php");

	$flag = false;
	$error = false;
	function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
    }
 
	$dataValidation = $_POST;

	$rules = array(
		'username' => 'required',
		'Email' => 'required%email',
		'password' => 'required',
		'confpassword' => 'required',
		'room' => 'required',
		'userfile' => 'exists'

		);

$obj = ORM::getInstance();
$obj->setTable('users');

if (isset($_POST['submit'])) {
	
    $valid = new validation();
    $result = $valid->validate($dataValidation,$rules);
    if ($result == TRUE) {
    	//check password validation 
    	if ($_POST['password'] == $_POST['confpassword']) {
    		
		
		$data = array(
			'email'=>$_POST['Email'] ,
			'password'=>md5($_POST['password']),
			'username'=>$_POST['username'] ,
			'roomNum'=>$_POST['room'] ,
			'profileImg'=>$_FILES['userfile']['name']);

		if (!isset($_GET['id'])) {
			//insert new record/user
			$user = $obj->insert($data);  
			if ($user > 0) {
				header("Location: http://localhost/PHP-Project/docs/All_Users.php");
			
			}else{
				$str = "This Email Already Exists .. ";
				$error = true;
			}
	
		}else{
			//update existing user
			$result = $obj->update($data,$_GET['id']);
			if ($result) {
				header("Location: http://localhost/PHP-Project/docs/All_Users.php");
			}else{
				$error = "Cannot updated ... ";
			}
		}

		
    		
    }else{
    		$str =  "incorrect password";
    		$error = true;
    	}

    }else{
    	$flag = true;
  
    }

   }
		


   if (isset($_GET['id'])) {
 		$userData = $obj->selectwhere($_GET['id']);


   }


?>

<div class="container">
 <div class="row">
    <div class="col-md-8" >
<h1 class="page-header"> Registration Form </h1>
<form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data" />
 
<div class="alert alert-danger" role="alert">
 
		<?php 
		if($flag == true){
			foreach($valid->errors as $error)
            {
			  echo $error."<br/>";

		    }

		}elseif($error == true){
			echo $str."<br/>" ;
		}
		else{
			echo " No Error ";
		}

		?>
</div>

	
   <h5> <strong> Name : </strong></h5>
	<input type="text" class="form-control  has-error" id="inputError1" placeholder="Text input" name="username" value=<?php 
			 if (!empty($_POST["username"]))
	   		{
	   					echo $_POST['username'];
	   		}elseif (isset($_GET['id'])) {
	   			foreach ($userData as $key => $value) {
	   				echo $value['username'];
	   			}
	   		}

?>>

    <h5> <strong>Email : </strong></h5>
   <input type="text" class="form-control" placeholder="Text input" name="Email" value=<?php 
 			  if (!empty($_POST["Email"]))
   				{
   					echo $_POST['Email'];
   				}elseif (isset($_GET['id'])) {
	   			foreach ($userData as $key => $value) {
	   				echo $value['email'];
	   			}
	   		}?>>


   <h5> <strong>password : </strong></h5>
   <input type="password" class="form-control" placeholder="Text input" name="password" value=<?php 
   		 if (!empty($_POST["password"]))
   				{
   					echo $_POST['password'];
   				}
   ?>>

   <h5> <strong>Confirm Password : </strong></h5>
   <input type="password" class="form-control" placeholder="Text input" name="confpassword" value=<?php 
   		 if (!empty($_POST["password"]))
   				{
   					echo $_POST['password'];
   				}
   ?>>
   
   <h5> <strong>Room : </strong></h5>
   <input type="text" class="form-control" placeholder="Text input" name="room" value=<?php 
 			  if (!empty($_POST["room"]))
   			  {
   					echo $_POST['room'];
   			  }elseif (isset($_GET['id'])) {
	   			foreach ($userData as $key => $value) {
	   				echo $value['roomNum'];
	   			}
	   		}?>>

   <h5> <strong>Profile Pic : </strong></h5>
    <input type="file"  name="userfile" id="userfile"/>
<br/>

<div class="form-group">
	<input type="submit" name="reset"  class="btn btn-warning" value="Reset" /> 
    <input type="submit" name="submit" class="btn btn-primary" value="submit"> 
</div>
   	
</form>
</div>
</div>
</div>

</body>
</html>