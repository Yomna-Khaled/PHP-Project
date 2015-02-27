<html>
  <body>
     <table border="1" style="width:100%" >
  	<tr bgcolor="#ADC2EB" style="text-align:center">
  	<!-----------------------Header of the table------------------------->
  		<td><b>Id</td>
                <td><b>Product</td>
    		<td><b>Price</td>
                <td><b>Category</td>
                <td><b>Image</td>
                <td><b>Action</td>		
  	</tr>
<?php

function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
    }
 

	$obj = ORM::getInstance();
	$obj->setTable('products');
	$products = $obj->selectAll();
  
	for ($i = 0 ; $i < count($products) ; $i++){
?>        
          <tr style="text-align:center">
      	  <?php
      		foreach ($products[$i] as $key=>$value){
      			
                       if($key=='image')
                       {
                          $value = 
                               <<<EOD
<img src="../uploads/$value" height="30" width="30" > 
EOD;
                     
                       }
      			?>
	  		<td><?php  echo $value;?></td>
	  	        
<?php
}
}
?>

<b><p align="right" ><a href="Add_Product.php">Add Product</a> </p></b>                   
  		</tr> 

