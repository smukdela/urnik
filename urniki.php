<?php
include("connection.php");

$db= $con;
$tableNameU="urniki";
$columnsU= ['urnik_id','dop_izmena','pop_izmena','malica'];
$fetchDataU = fetch_data($db, $tableNameU, $columnsU);

function fetch_dataU($db, $tableNameU, $columnsU){
 if(empty($db)){
  $msg= "Database connection error";
 }elseif (empty($columnsU) || !is_array($columnsU)) {
  $msg="columns Name must be defined in an indexed array";
 }elseif(empty($tableNameU)){
   $msg= "Table Name is empty";
}else{

$columnNameU = implode(", ", $columnsU);
$queryU = "SELECT ".$columnNameU." FROM $tableNameU"."";
$resultU = $db->query($queryU);

if($resultU== true){ 
 if ($resultU->num_rows > 0) {
    $rowU= mysqli_fetch_all($resultU, MYSQLI_ASSOC);
    $msg= $rowU;
 } else {
    $msg= "No Data Found"; 
 }
}else{
  $msg= mysqli_error($db);
}
}
return $msg;
}
?>