
<html>
<head>
	<title>All User</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</head>
<body>
<?php 
include_once("AdminCss.php");


function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
    }
 

	$obj = ORM::getInstance();
	$obj->setTable('users');
	$users = $obj->selectAll();

?>

	<div class="container">
  <h1 class="page-header"> User List </h1>
  <a href="http://localhost/PHP-Project/docs/Add_User.php" class="btn btn-warning glyphicon glyphicon-plus" style="float:right"> Add User</a>
  <!-- <p</p>             -->
  <table class="table table-striped" >
    <thead>
      <tr>
        <th class="text-center" >Name</th>
        <th class="text-center" >Room</th>
        <th class="text-center" >Image</th> 
        <th class="text-center" >Action-Edit</th>
        <th class="text-center" >Action-Delete</th>
      </tr>
    </thead>

    <tbody>
<?php	
		foreach ($users as $key=>$value){
			if ($value['type'] == "normal") {
				
			
?>
      <tr>
        <td class="text-center" ><?php echo $value['username'] ?></td>
        <td class="text-center" ><?php echo $value['roomNum'] ?></td>
        
        <td class="text-center" > <img src="../uploads/<?php echo $value["profileImg"]?>" height="40" width="40" > </td> 
        <td class="text-center"> <a href="http://localhost/PHP-Project/docs/Add_User.php?id=<?php echo $value['id'] ?>" class="btn btn-info"> Edit </a> </td>
        <td class="text-center"> <a href="http://localhost/PHP-Project/docs/All_Users.php?id=<?php echo $value['id'] ?>" class="btn btn-danger"> Delete </a> </td>
      </tr> 

<?php 
}
}
?>
    </tbody>

  </table>
</div>

 	</div>


<?php
// action when delete button is pressed 
if (isset($_GET['id'])) {
	$obj->setTable('users');
	$userID = $_GET['id']; 
	$state = $obj->delete($userID);
		if ($state) {
			echo "Deleted ..";
			header("Location: http://localhost/PHP-Project/docs/All_Users.php");
	
		}else {
			echo "Not Deleted";
		}
		
	
	}
?>


</body>
</html>