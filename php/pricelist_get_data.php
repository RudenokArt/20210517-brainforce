<?php 
include_once 'php/db_connect.php';

function priceListGetData(){
  global $db_link;
  $table=[];
  $arr=mysqli_query($db_link,'SELECT * FROM `brainforce_price`');
  while ($row = mysqli_fetch_assoc($arr)) {
    array_push($table, $row);
  }
  return $table;
}
function priceListTotal(){
  $table=priceListGetData();
  $arr['available_1']=0;
  $arr['available_2']=0;
  $arr['price']=0;
  $arr['wholesale_price']=0;
  $arr['expensive']=0;
  $arr['cheaper']=1000000;
  $arr['expensive_id']=1;
  $arr['cheaper_id']=1;
  $arr['few']=[];
  foreach ($table as $key => $value) {
    $arr['available_1']=$arr['available_1']+$value['available_1'];
    $arr['available_2']=$arr['available_2']+$value['available_2'];
    $arr['price']=$arr['price']+$value['price'];
    $arr['wholesale_price']=$arr['wholesale_price']+$value['wholesale_price'];
    if ($value['price']>$arr['expensive']) {
      $arr['expensive']=$value['price'];
      $arr['expensive_id']=$value['id'];
    }
    if ($value['wholesale_price']<$arr['cheaper'] &&
      $value['wholesale_price']!=0) {
      $arr['cheaper']=$value['wholesale_price'];
      $arr['cheaper_id']=$value['id'];
    }
    if ($value['available_1']<20 || $value['available_2']<20) {
      array_push($arr['few'], $value['id']);
    }
  }
  $arr['price']=round($arr['price']/sizeof($table),2);
  $arr['wholesale_price']=round($arr['wholesale_price']/sizeof($table),2);
  return $arr;
}



?>