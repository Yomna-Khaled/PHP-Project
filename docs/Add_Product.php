<!DOCTYPE html>

<html>
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <form  method="post"  enctype="multipart/form-data"/>
       <fieldset>
   	<legend>Add Product</legend>
 	Product : <input type="text" name="product_name" /><br><br>
 	Price : <INPUT TYPE="NUMBER" MIN="0" MAX="100" STEP="2.5" name="price"/>EGP<br><br>
        Category:<select name="category"><br>
        	<option value="hot_drinks">Hot Drinks</option>
        	<option value="cold_drinks">Cold Drinks</option>
        	<option value="sandwitches">Sandwitches</option>
                </select><a href="category.php " >Add category </a><br><br> 

        Product Picture:    <input type="file" name="userfile" id="userfile"/>
                <br><br>
     		<input type="submit" name="save" value="save" /> 
                <input type="submit" name="rest" value="Reset" /> <br>
      </fieldset> 
      </form>
   </head>
</html>

<?php
//class ORM
function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
}



	if($_POST)
	{
//image validation 
if($_FILES['userfile']['error'] > 0)
{
switch ($_FILES['userfile']['error'])
{
case 1: $error="File exceeded upload_max_filesize";
          echo $error;
break;
case 2: $error="File exceeded max_file_size";
           echo $error;
break;
case 3: $error="File only partially uploaded";
           echo $error;
break;
case 4: $error="No file uploaded";
           echo $error;
break;
case 6: $error="Cannot upload file: No temp directory specified";
           echo $error;
break;
case 7: $error="Upload failed: Cannot write to disk";
            echo $error;
break;
}
}
//move image to uploads
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
$upfile = "$DOCUMENT_ROOT/PHP-Project/uploads/".$_FILES['userfile']['name'] ;
$array=array('image/gif','image/png','image/jpeg');
if (!in_array($_FILES['userfile']['type'] ,$array ))
{
echo 'Problem: file is not valid';

}

elseif (is_uploaded_file($_FILES['userfile']['tmp_name']))
{
        if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $upfile))
             {
               echo 'Problem: not moved';
             }
        else
              {
                 echo 'File uploaded and moved successfully<br><br>';
              

                $image=(string)($_FILES['userfile']['name']);
                $obj = ORM::getInstance();
		$obj->setTable('products');
		$query=$obj->insert(array('name'=>$_POST['product_name'] , 'price'=>$_POST['price'], 'category'=>$_POST['category'] ,'image'=>  
                $image, 'status'=>'available'));
 
}
}
}
?>

















