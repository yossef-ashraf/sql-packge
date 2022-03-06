<?php
require_once("env.php");

class sql {
public $con;
public $end;
public $sql;
public $query;

// open connection with data base  
public function __construct(){
$this->con= mysqli_connect(SERVER,USERNAME,PASSWORD,DATABASE);
}

// end connection with data base  
public function end(){
return mysqli_close($this->con);}

// get all rows from data base  
public function getAll(){
$this->query = mysqli_query($this->con, $this->sql);
while($row = mysqli_fetch_assoc($this->query)){
$data[] = $row;}
$this->end();
return $data ;
}

// get rows from data base  
public function getRow(){
$this->query = mysqli_query($this->con, $this->sql);
$row = mysqli_fetch_assoc($this->query);
$this->end();
return $row ;
}
// set query for data base  
public function set(){
$this->query = mysqli_query($this->con, $this->sql);
$this->end();
return $this->query ;
}

// select from data base and find & where 
public function select($table, $column){
$this->sql = "SELECT $column FROM $table";
// var_dump($this->sql);die;
return $this ;
}

public function where($column, $compair, $value){
$this->sql .= " WHERE $column $compair $value";
// var_dump($this->sql);die;
return $this;
}
public function andWhere($column, $compair, $value){
$this->sql .= " AND $column $compair $value";
// var_dump($this->sql);die;
return $this;
}

public function orWhere($column, $compair, $value){
$this->sql .= " OR $column $compair $value";
// var_dump($this->sql);die;
return $this;
}

public function WhereNot($column, $compair, $value){
$this->sql .= " WHERE NOT  $column $compair $value";
// var_dump($this->sql);die;
return $this;
}

public function notWhere($column, $compair, $value){
$this->sql .= " NOT  $column $compair $value";
// var_dump($this->sql);die;
return $this;
}
// end select and find & where
////////////////
// insert & delete 
public function insert($table, $data){
$columns ="";
$values ="";
foreach($data as $key => $value){
$columns .= "`$key` ,";
$values  .= "'$value' ,";}
$columns = rtrim($columns,",");
$values = rtrim($values,",");
$this->sql = "INSERT INTO $table ($columns) VALUES ($values)";
// var_dump($this->sql);die;
return $this;
}

public function update($table, $data ,$condition){
$values ="";
foreach($data as $key => $value){
$values  .= " $key = '$value'  ,";}
$values = rtrim($values," ,");
$this->sql = "UPDATE $table SET $values WHERE $condition ";
// $this->sql = "INSERT INTO $table ($columns) VALUES ($values)";
// var_dump($this->sql);die;
return $this;
}

public function delete($table, $column , $value){
$this->sql = "DELETE FROM $table WHERE $column = '$value' ";
// var_dump($this->sql);die;
return $this ;
}

public function deleteTable($table){
$this->sql = "DELETE FROM $table";
// var_dump($this->sql);die;
return $this ;
}
//end insert & delete
////////////////

//end class
}


// exaples
// $k= new sql;
// var_dump( $k->select("users","*"));echo "<br> 1  <br>";
// var_dump( $k->select("users","*")->where("id","=","9")->getRow());echo "<br> 2  <br>";
// var_dump( $k->andWhere("id","LIKE","5"));echo "<br> 3  <br>";
// var_dump( $k->orWhere("id","BETWEEN","5"));echo "<br> 4  <br>";
// var_dump( $k->WhereNot("id","IN","5"));echo "<br> 5  <br>";
// var_dump( $k->notWhere("id","<","5"));echo "<br> 6  <br>";
// var_dump( $k->insert("users",["name"=>"name","email"=>"email","pass"=>"pass"])->set());echo "<br> 7  <br>";
// var_dump( $k->delete("users","id","7")->set());echo "<br> 8  <br>";
// var_dump( $k->deleteTable("users")->set());echo "<br> 9  <br>";
// var_dump( $k->update("users",["name"=>"ne","email"=>"email","pass"=>"pass"] , "id = 15")->set());echo "<br> 10  <br>";
