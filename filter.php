<div class="filter_wrapper">
  <form action="php/pricelist_get_data.php" method="post" id="filter_form">
    <div class="filter">
      <div>
        <div>
          <span>Показать товары,<br> у которых:</span>
        </div>
        <div class="select_wrapper">
          <select name="price_type">
            <option value="price">Розничная цена</option>
            <option value="wholesale_price">Оптовая цена</option>
          </select>
        </div>
      </div>
      <div>
        <div><span>от</span></div>
        <div><input type="text" name="price_from" placeholder="0.00"></div>
        <div><span>до</span></div>
        <div><input type="text" name="price_to" placeholder="0.00"></div>
      </div>
      <div>
        <div><span>Рублей и <br> на складе: </span></div>
        <div class="select_wrapper">
          <select name="quantity_type">
            <option value="more_than">Более</option>
            <option value="less_then">Менее</option>
          </select>
        </div>
        <div><input type="text" name="quantity" placeholder="0"></div>
        <div><span>штук.</span></div>
      </div>
      <div>
        <button name="filter_button">
          <i class="fa fa-search" aria-hidden="true"></i>
        </button>
      </div>
      <div>
        <button name="filter_reset">
          <i class="fa fa-times" aria-hidden="true"></i>
        </button>
      </div>
    </div>
  </form>
</div>