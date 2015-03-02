<html>
<head>

<style>

ul#list-nav {
  list-style:none;
  margin:20px;
  padding:0;
  width:800px;
  display: inline-block;
}

ul#list-nav li {
  display:inline
  display: inline-block;
}

ul#list-nav li a {
  text-decoration:none;
  padding:5px 0;
  width:150px;
  background:#9999CC;
  color:#eee;
  float:left;-
  text-align:center;
  border-left:1px solid #fff;
    display: inline-block;
}

ul#list-nav li a:hover {
  background:white;
  color:black;
  display: inline-block;
}
#header {
    background-color: #D8D8D8  ;
    color:black;
    border:2px solid black;
    text-align:center;
    padding:5px;
    width:1000px;
   height: 600px;
}

#header1 {

    border:2px solid black;
    margin-right:10px;
    float:left;


    background-color:white  ;
    color:black;
   
    padding:5px;
    width:30%;
   height: 500px;
}

#header2 {
    border:2px solid black;
    background-color: white ;
    color:black;
    float: left;
    padding:5px;
    width:65%;
   height: 500px;
}

</style>


</head>

<body>
<center/>
<div id="header">



<ul id="list-nav">
  <li><a href="/index.php">Home</a></li>
  <li><a href="#">My Orders</a></li>
  
</ul>

<div id="header1">
<form id ="f">

<?php 
require "ORM.php";
$t = ORM::getInstance();
$t->setTable('products');


echo " <br> <legend>Making order</legend>";
echo "<br> <br> " ;



//echo "<input type='submit' value='Submit'>";
//$test->checkProducts();
$t->setTable('users');



?>



</form>
<div>
<textarea id="notes" rows='4' cols='30' >
Write your notes here .. 
</textarea>
<br> <br>
Room :
 <select  id="combo">
  <option value="<?php $t = ORM::getInstance();
 $t->setTable('users'); 
  $result=$t->selectwhere1(1);
 foreach($result as $key=>$value)
{
    $room=$value['roomNum'];
    echo $room;
}  ?>"> <?php $t = ORM::getInstance();
 $t->setTable('users');
 $result=$t->selectwhere1(1);
 foreach($result as $key=>$value)
{
$room=$value['roomNum'];
    echo $room;


}  ?></option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
</select> 
<br> <br>
--------------------------------------
<br>

<div id="total">

</div>

<br>
<input type='submit' value='confirm' onclick='confirm()'>
<br><br>
</div> 
<div id="sucsess"> 
</div>


</div>
<div id="header2">
<div id="header3">
Last order :
<?php 
$t = ORM::getInstance();
 $t->setTable('orders');
$r=$t->getLast();

foreach($r as $key=>$value)
{
 $item_last= $value['id'];

}


$t = ORM::getInstance();
 $t->setTable('order_item');
$r=$t->selectspecial($item_last);
//echo $r;
{
foreach($r as $key=>$value)
{
 $iteme_last= $value['itemId'];
$t = ORM::getInstance();
 $t->setTable('products');
$r=$t->selectWhere1($iteme_last);
foreach($r as $key=>$value)

{
 $img= $value['image'];
 $n= $value['name'];
?>
  <img src="uploaded/<?php echo $value['image'] ?>" height="100" width="100" >
<?php
echo $n;  

}

}
}
echo "<br><br>";
?>
------------------------------------------------------------------------------------------------------------------------------
<br>
</div>

<?php
//include "db1.php";
$t->setTable('products');
$result=$t->selectAll();


foreach($result as $key=>$value)
{$i= $value['id'];
 $n= $value['price'];
$name=$value['name'];

 

?>
	<img src="uploaded/<?php echo $value['image'] ?>" height="100" width="100" onclick="myFunction(<?php echo $i?>,<?php echo $n?>,<?php echo "'".$name."'"?>)">
<?php
	echo $name." ";	
echo $n."LE";
}
     

//else 
  //   echo "Sorry , No products are available now !";

?>
</div>

</div>

<script> 
var flag=1;
var id=0;
total=0;
var item = new Array();

 var count = new Array();
var arr = [];
var name1="bj";
function myFunction(itemId,price,name)
{
total=total+price;


var flag=1;
for (var i = 0; i < arr.length; i++) {

    if(arr[i]==itemId)
{
flag=0;
count[itemId]++;
p=price*count[itemId];
document.getElementById(itemId).innerHTML=count[itemId];
document.getElementsByName(itemId)[0].innerHTML="Price:"+p;
}
  


}

if(flag==1)
{
arr[arr.length]=itemId;

var newDiv = document.createElement("div"); 
var newDiv2 = document.createElement("div"); 
var newDiv4 = document.createElement("img"); 
var newDiv5 = document.createElement("img"); 
var newDiv6 = document.createElement("img"); 

newDiv4.setAttribute('src','/uploaded/plus.png');
newDiv5.setAttribute('src','/uploaded/minus.png');
newDiv6.setAttribute('src','/uploaded/close.png');

newDiv6.setAttribute('id',itemId+'close');

newDiv5.setAttribute('id',itemId+'minus');
newDiv.setAttribute('id',itemId+'name');

newDiv4.setAttribute('id',itemId+'plus');
newDiv2.setAttribute('name',itemId);

var newDiv3 = document.createElement("div"); 
newDiv3.setAttribute('id',itemId);


count[itemId]=1;

newDiv.setAttribute('style', 'float:left');
newDiv3.setAttribute('style', 'float:left');
newDiv4.setAttribute('style', 'float:left');
newDiv5.setAttribute('style', 'float:left');
newDiv2.setAttribute('style', 'float:left');
newDiv6.setAttribute('style', 'float:left');

//newDiv2.setAttribute('style', 'float:left');

//newDiv2.setAttribute('style', 'float:left');


newDiv4.setAttribute('height', '20px');
newDiv5.setAttribute('height', '20px');
newDiv4.setAttribute('width', '20px');
newDiv5.setAttribute('width', '20px');
newDiv6.setAttribute('height', '20px');
newDiv6.setAttribute('width', '20px');
newDiv5.onclick = function() { if(count[itemId]>=2){count[itemId]--; document.getElementById(itemId).innerHTML=count[itemId];
document.getElementsByName(itemId)[0].innerHTML="Price:"+price*count[itemId];
total=total-price;
document.getElementById("total").innerHTML="Total: "+total+"LE";

}};

newDiv6.onclick = function() { 
element=document.getElementById(itemId);
console.log(element);
element.remove();

l=document.getElementsByName(itemId)[0].innerHTML;
l = l.split(":")[1]; 
total=total-l;
document.getElementById("total").innerHTML="Total: "+total+"LE";

//console.log(total);
element = document.getElementsByName(itemId)[0];
element.remove();
element = document.getElementById(itemId+'minus');
element.remove();
element = document.getElementById(itemId+'plus');
element.remove();
element = document.getElementById(itemId+'name');
element.remove();
element = document.getElementById(itemId+'close');
element.remove();
};


newDiv4.onclick = function() { count[itemId]++; document.getElementById(itemId).innerHTML=count[itemId];
document.getElementsByName(itemId)[0].innerHTML="Price:"+price*count[itemId];
total= total+price;
document.getElementById("total").innerHTML="Total: "+total+"LE";


};
  var newContent = document.createTextNode(name+" >> "); 
  var newContent2 = document.createTextNode("Price:"+price*count[itemId]); 
  var newContent3 = document.createTextNode(count[itemId]); 
  newDiv.appendChild(newContent);
  newDiv2.appendChild(newContent2);
  newDiv3.appendChild(newContent3);
   // newDiv4.appendChild(newContent4);

  document.getElementById("f").appendChild(newDiv); //name
  document.getElementById("f").appendChild(newDiv3); //quantity
    document.getElementById("f").appendChild(newDiv4); //plus
      document.getElementById("f").appendChild(newDiv5); //minus

  document.getElementById("f").appendChild(newDiv2); //price
document.getElementById("f").appendChild(newDiv6);
   //document.getElementById('plus').style.width = "20px";
   //document.getElementById('minus').style.width = "20px";
   //document.getElementById('minus').style.height = "20px";


// for (i=0 ; i <arr.length ; i++)
// {
//      var item = document.getElementById(0);
//      console.log("item " + item);

// }
flag=0;


}
//alert(arr);


//console.log(Number(item));

document.getElementById("total").innerHTML="Total: "+total+"LE";
}

function confirm()
{
for (i=0 ; i <arr.length ; i++)
{
 item[item.length]= document.getElementById(arr[i]).innerHTML;
}
var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              if(total!=0)
                 document.getElementById("sucsess").innerHTML = "Thank you";
             }
         }
         var selectCtrl = document.getElementById("combo");
var selectCtrl2 = document.getElementById("notes");
         xmlhttp.open("GET", "home_data2.php?arr=" + arr + "&item=" + item+"&combo="+selectCtrl.value+"&notes="+selectCtrl2.value+"&total="+total+"&userId="+1, true);
         xmlhttp.send();


}



</script>


</body>

</html>
