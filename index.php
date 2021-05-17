<?php include_once 'header.php' ?>
<?php include_once 'php/pricelist_get_data.php' ?>
<div class="upload_area">
  <div class="upload_area-title">
    Загрузить прайс:
  </div>
  <div>
    <form action="php/main.php" enctype="multipart/form-data" method="post">
      <label>
        <i class="fa fa-cloud-upload" aria-hidden="true"></i>
        <input type="file" name="pricelist">
      </label>
    </form>
  </div>
</div>
<div class="price_table"></div>

<div class="preloader_wrapper">
  <div class="preloader">
    <i class="fa fa-cog" aria-hidden="true"></i>
  </div>
</div>

<?php include_once 'footer.php' ?>