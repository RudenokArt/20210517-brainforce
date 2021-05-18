<?php 
if (file_exists('php/db_connect.php')) {
  include_once 'php/db_connect.php';
}else{
  include_once 'db_connect.php';
}

if (isset($_POST['price_type'])) {
  formValidate($_POST);
}

function formValidate($arr){
  if ($arr['quantity_type']=='more_than') {
    $compare='>';
  }else{
    $compare='<';
  }
  if (isMoney($arr['price_from']) &&
    isMoney($arr['price_to']) &&
    isQuantity($arr['quantity'])) 
  {
    $validate=true;
  }else{
    $validate=false;
  }
  if ($validate) {
    $data=true;
    $sql='SELECT * FROM `brainforce_price`
    WHERE `'.$arr['price_type'].'`>"'.$arr['price_from'].'" 
    AND `'.$arr['price_type'].'`<"'.$arr['price_to'].'"
    AND `available_1`'.$compare.'"'.$arr['quantity'].'"
    AND `available_2`'.$compare.'"'.$arr['quantity'].'" ' ;
    file_put_contents('sql.txt',$sql);
  }else {
    $data=false;
  }
  $str=json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  echo $str;
}

function isQuantity($quantity){
  return preg_match('#^[0-9]+$#', $quantity);
}
function isMoney($money){
  return preg_match('#^-?[0-9]+(?:\.[0-9]{1,2})?$#', $money);
}

function sqlQuery(){
  if(file_exists('php/sql.txt')){$sql=file_get_contents('php/sql.txt');}
  return $sql;
}

function priceListGetData(){
  global $db_link;
  $table=[];
  $arr=mysqli_query($db_link,sqlQuery());
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
  $arr['notice']='';
  if (count($table)>0) {
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
      $value['wholesale_price']!=0) 
    {
      $arr['cheaper']=$value['wholesale_price'];
      $arr['cheaper_id']=$value['id'];
    }
    if ($value['available_1']<20 || $value['available_2']<20) {
      array_push($arr['few'], $value['id']);
    }
  }
  $arr['price']=round($arr['price']/sizeof($table),2);
  $arr['wholesale_price']=round($arr['wholesale_price']/sizeof($table),2);
  }else{
    $arr['notice']='По вашему запросу ничего не найдено!';
  }
  file_put_contents('php/sql.txt','SELECT * FROM `brainforce_price`');
  return $arr;

}



?>