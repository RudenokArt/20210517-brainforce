

// ===== ACTIONS =====

priceTableGet();



// ===== LISTENERS =====

$('input[name="pricelist"]').change(function () {
  $(this).parent().parent('form')[0].submit();
});



// ===== FUNCTIONS =====

function priceTableGet () {
  $('.price_table').load('price_table.php','data',function(){
    $('.preloader_wrapper').css({'display':'none'});
  });
}