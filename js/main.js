

// ===== ACTIONS =====

priceTableGet();



// ===== LISTENERS =====

$('input[name="pricelist"]').change(function () {
  $(this).parent().parent('form')[0].submit();
});

$('button[name="filter_button"]').click(function(e){
  e.preventDefault();
  preloaderStart();
  checkForm();
  $.post('php/pricelist_get_data.php', $('#filter_form').serialize(), function (data) {
    data=JSON.parse(data);
    if (data==true) {
      priceTableGet ();
      console.log(data);
    }else{
      preloaderStop();
      alert('Заполните корректно все поля формы!');
    }
  });
});

$('button[name="filter_reset"]').click(function (e) {
  e.preventDefault();
  preloaderStart();
  priceTableGet();
});

// ===== FUNCTIONS =====
function checkForm () {
  if ($('input[name="price_from"]')[0].value=='') {
    $('input[name="price_from"]')[0].value='0.00';
  }
  if ($('input[name="price_to"]')[0].value=='') {
    $('input[name="price_to"]')[0].value='0.00';
  }
  if ($('input[name="quantity"]')[0].value=='') {
    $('input[name="quantity"]')[0].value='0';
  }
}

function preloaderStart(){
  $('.preloader_wrapper').css({'display':'flex'});
}

function preloaderStop(){
  $('.preloader_wrapper').css({'display':'none'});
}

function priceTableGet () {
  $('.price_table').load('price_table.php','data',function(){
    preloaderStop();
  });
}