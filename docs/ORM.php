<?php
require 'appconf.php';

class ORM {

    static $conn;
    private $dbconn;
    protected $table;

    static function getInstance(){
        if(self::$conn == null){
            self::$conn = new ORM();
        }
        return self::$conn;
    }
    
    protected function __construct(){    
        extract($GLOBALS['conf']);
        $this->dbconn = new mysqli($host, $username, $password, $database);
    }
    
    function getConnection(){
        return $this->dbconn;
    }
    
    function setTable($table){
        $this->table = $table;
    }

     function insert($data){
        $query = "insert into $this->table set ";
        foreach ($data as $col => $value) {
            $query .= $col."= '".$value."', ";   
        }
        $query[strlen($query)-2]=" ";
        $state = $this->dbconn->query($query);
        if(! $state){
            return $this->dbconn->error;
        }
        
        return $this->dbconn->affected_rows;   
    }
    
    function selectAll(){
    	$query = "select * from $this->table";
    	$result = mysqli_query($this->dbconn,$query);
        if(! $result){
            return $this->dbconn->error;
        }
        
        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
        	$row = mysqli_fetch_assoc($result);
		//$user = array_values($row);
		$users[]=$row; 
        } 
        return $users;
    
    }


 function selectwhere1($id){
        $query = "select * from $this->table where id=";
        $query .= $id.';';
        $result = mysqli_query($this->dbconn,$query);
        if(! $result){
            return $this->dbconn->error;
        }
        
        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
        //$user = array_values($row);
        $users[]=$row; 
        } 
        return $users;
    
    }




    function selectwhere($id){
    	$query = "select * from $this->table where id=";
        $query .= $id.';';
    	$result = mysqli_query($this->dbconn,$query);
        if(! $result){
            return $this->dbconn->error;
        }
        
        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
        	$row = mysqli_fetch_assoc($result);
		//$user = array_values($row);
		$users[]=$row; 
        } 
        return $users;
    
    }

   function delete($id){
        $query = "delete from $this->table where id=";
       
            $query .=$id.';';   
     
        $state = $this->dbconn->query($query);
       
        return $state;   
    }



     function update($data,$id)
     {
         $query = "update $this->table set ";
         foreach ($data as $col => $value) {
             $query .= $col."= '".$value."', ";
         }
          $query[strlen($query)-2]=" ";
          $query.='where id='.$id.';';
          $state = $this->dbconn->query($query);
          if(! $state){ 
            return $this->dbconn->error;
         }
        return $query;
     }



    function getId($name)

    {
$query = "select * from users where username="."'$name'".";";
        $result = mysqli_query($this->dbconn,$query);
for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
        //$user = array_values($row);
        $users[]=$row; 
        } 
        return $users;
    }


    function getlast(){

        $query = "select id from orders 
ORDER BY id DESC
LIMIT 1;";
        $result = mysqli_query($this->dbconn,$query);
        if(! $result){
            return $this->dbconn->error;
        }
        
        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
        //$user = array_values($row);
        $users[]=$row; 
        } 
        return $users;

}



function selectspecial($id){
        $query = "select * from $this->table where orderId=";
        $query .= $id.';';
        $result = mysqli_query($this->dbconn,$query);
        if(! $result){
            return $this->dbconn->error;
        }
        
        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
        //$user = array_values($row);
        $users[]=$row; 
        } 
        return $users;
    
    }





 }


