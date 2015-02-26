<?php 
class dbConnect { 
	static $instance;
	 public $db; 
	 static function getInstance(){
	  if(self::$instance == null){
	   self::$instance = new dbConnect();
	    } 
	    return self::$instance; 
	} 
	protected function __construct() {
	 $this->db=new mysqli("localhost" , "root" , "123456" , "cafe");
	  } 

	  public function Close(){ 
	  	mysql_close();
	  	 } 
	  	}
?>
