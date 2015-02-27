
<html>
<head>
	<title>Forget Password</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src ="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</head>
<body>
<?php


function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
    } 

$flag = false;
$rules = array(
	'Email'=>'required%email'
	);

$dataValidation =$_POST;

if (isset($_POST['submit'])) {
	
    $valid = new validation();
    $result = $valid->validate($dataValidation,$rules);
    if ($result== TRUE) {
    	$obj = ORM::getInstance();
		$obj->setTable('users');
		$user = $obj->selectAll();
		foreach ($user as $key => $value) {
			if ($value['email'] == $_POST['Email']) {

				// $to = $value['email'];
				// $subject = "My subject";
				// $txt = "Hello world!";
				// $headers = "From: webmaster@example.com" . "\r\n";

				// mail($to,$subject,$txt,$headers);


				// echo $value['email'];
				//mail($value['email'],"Confirm Password","go to the following link to change your password");
			}
		}
    }else{
    	//display errors
    	$flag = true;
    }

	
}


?>


	<div class="container">
 <div class="row">

    <div class="col-md-8" >
    <div class="page-header">
   <img src="../static/logo.png" style="width:400px;height=300px;"alt="...">
</div>
<h1 class="page-header"> Send Mail </h1>
<form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data" />
	<h5> <strong>Email : </strong></h5>
   <input type="text" class="form-control" placeholder="Text input" name="Email" value=<?php 
 			  if (!empty($_POST["Email"]))
   				{
   					echo $_POST['Email'];
   				}
   				?>>
   				<br/>

<div class="form-group">
	
    <input type="submit" name="submit" style="margin-left:340px;" class="btn btn-primary" value="submit"> 
</div>


</form>
</div>
</div>
</div>
</body>
</html>