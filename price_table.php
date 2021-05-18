
<?php 
include_once 'php/pricelist_get_data.php'; 
$price_table=priceListGetData();
$price_total=priceListTotal();
?>

<table>
  <tr>  
    <th>id</th>
    <th>Наименование товара</th>
    <th>Стоимость, руб</th>
    <th>Стоимость опт, руб</th>
    <th>Наличие на складе 1, шт</th>
    <th>Наличие на складе 2, шт</th>
    <th>Страна производства</th>
    <th>Примечания</th>
  </tr>
  <?php foreach ($price_table as $price_table_tr) { ?>
    <tr <?php if ($price_table_tr['id']==$price_total['cheaper_id']) { ?>
      style="background: lightgreen;"
      <?php } elseif ($price_table_tr['id']==$price_total['expensive_id']) {?> 
        style="background: lightcoral;"
      <?php  } ?> >
      <?php foreach ($price_table_tr as $coll => $price_table_td) {?>
        <td>
          <?php echo $price_table_td ?>
          <?php if ($coll=='notice' && 
            in_array($price_table_tr['id'], $price_total['few'])) {
            echo 'Осталось мало!! Срочно докупите!!!';
          } ?>
        </td>
      <?php  } ?>
    </tr>
  <?php } ?> 
  <tr>  
    <th>X</th>
    <th>X</th>
    <th><?php echo $price_total['wholesale_price'] ?></th>
    <th><?php echo $price_total['price'] ?></th>
    <th><?php echo $price_total['available_1'] ?></th>
    <th><?php echo $price_total['available_2'] ?></th>
    <th>X</th>
    <th>X</th>
  </tr> 
</table>
<p>
  <?php echo $price_total['notice'] ?>
</p>
