BX.bindDelegate(document.body, "click", {className: 'to-cart__button'}, function(e) {
    
    let id = parseInt(this.dataset.id);
    let price = parseInt(this.dataset.price);
    let obj = {"ID": id, "PRICE": price};
    
    BX.ajax({
        url: "/ajax/add_to_cart.php", // в зависимости от конкретного проекта можно прописать другой адрес php-скрипта, который будет обрабатывать полученные данные.
        data: obj,
        method: 'post',
        dataType: 'json',
        processData: false,
        preparePost: true,
        onsuccess: function() {
            console.log("Товар добавлен в корзину"); // также можно при необходимости прописать тут открытие всплывающего сообщения об отправке товара в корзину.
        },
        onfailure: function() {
            console.log("Ошибка при добавлении товара");
        }
    });
    return BX.PreventDefault(e);
  });