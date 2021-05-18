<?php   

include_once 'db_connect.php';
priceListUpload();



function priceListUpload(){
  if (isset($_FILES['pricelist'])) {
    $take = $_FILES['pricelist']['tmp_name'];
    $name = $_FILES['pricelist']['name'];
    move_uploaded_file($take, '../upload/pricelist.xls');
    echo '<br><br>Прайс загружен на сервер!';
    echo '<meta http-equiv="refresh" content="2; url=../index.php" />';
  }
  priceListInsert();
}

function priceListParse(){
  require_once '../php-excel/Classes/PHPExcel.php';
  $pExcel = PHPExcel_IOFactory::load('../upload/pricelist.xls');
  foreach ($pExcel->getWorksheetIterator() as $worksheet) {
    $tables[] = $worksheet->toArray();
  }
  return $tables[0];
}

function priceListInsert(){
  global $db_link;
  $arr=priceListParse();
  for ($i=1; $i < sizeof($arr); $i++) { 
    $sql='INSERT INTO `brainforce_price`(`name`, `price`, 
    `wholesale_price`, `available_1`, `available_2`, `country`, `notice`) 
    VALUES ("'.$arr[$i][0].'","'.$arr[$i][1].'","'.$arr[$i][2].'",
    "'.$arr[$i][3].'","'.$arr[$i][4].'","'.$arr[$i][5].'","'.$arr[$i][6].'")';
    mysqli_query($db_link,$sql);
  }
}



?>