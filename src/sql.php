<?php
namespace Db\SqlPackge;

class sql {
public $con;
public $end;
public $sql;
public $query;

// open connection with data base  
public function __construct($server,$user,$pass,$db,$port=3306)
{
    $this->connnection = mysqli_connect($server,$user,$pass,$db,$port);
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
return $this ;
}

public function where($column, $compair, $value){
$this->sql .= " WHERE $column $compair $value";
return $this;
}
public function andWhere($column, $compair, $value){
$this->sql .= " AND $column $compair $value";
return $this;
}

public function orWhere($column, $compair, $value){
$this->sql .= " OR $column $compair $value";
return $this;
}

public function WhereNot($column, $compair, $value){
$this->sql .= " WHERE NOT  $column $compair $value";
return $this;
}

public function notWhere($column, $compair, $value){
$this->sql .= " NOT  $column $compair $value";
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
return $this;
}

public function update($table, $data ,$condition){
$values ="";
foreach($data as $key => $value){
$values  .= " $key = '$value'  ,";}
$values = rtrim($values," ,");
$this->sql = "UPDATE $table SET $values WHERE $condition ";
return $this;
}

public function delete($table, $column , $value){
$this->sql = "DELETE FROM $table WHERE $column = '$value' ";
return $this ;
}

public function deleteTable($table){
$this->sql = "DELETE FROM $table";
return $this ;
}
//end insert & delete
////////////////

//end class
}


