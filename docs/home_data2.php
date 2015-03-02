
  <?php
  require "ORM.php";

  $arr1=$_GET['arr'] ;
  $arr2=$_GET['item'] ;

$item=(explode(",",$arr1));
$quantity=(explode(",",$arr2));

$data['userId']=1;
$data['date']=date("Y/m/d h:i:sa");
$data['status']='processing';
$data['total']=$_GET['total'];
$data['room']=$_GET['combo'];
$data['notes']=$_GET['notes'];


if($_GET['total']!=0)
{
$t = ORM::getInstance();
$t->setTable('orders');
$result=$t->insert($data);

$t = ORM::getInstance();
 $t->setTable('orders');
$r=$t->getLast();

$t = ORM::getInstance();


for($i=0 ; $i<count($item) ; $i++)
{
foreach($r as $key=>$value)
{
 $d['orderId']= $value['id'];
 }
 $d['itemId']= $item[$i];
 $d['amount']= $quantity[$i];

$t->setTable('order_item');

$resu=$t->insert($d);
}
}
?>
