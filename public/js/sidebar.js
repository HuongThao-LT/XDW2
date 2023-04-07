$("#manager .item-qty-plus").on('click', function () {
    let qtySelector = $(this).siblings('.item-amount');
    let currentQty = parseInt(qtySelector.val());
    qtySelector.val(currentQty + 1);
})

$("#manager .item-qty-minius").on('click', function () {
    let qtySelector = $(this).siblings('.item-amount');
    let currentQty = parseInt(qtySelector.val());
    if (currentQty <= 0) return;
    qtySelector.val(currentQty - 1);
})

$('#cart-empty, #cart-update, #cart-checkout, #manager .item-button-remove').on('click', function () {
    $('#cart-empty, #cart-update, #cart-checkout, #manager .item-button-remove').attr('disabled', true);
});

function removeProduct(coffeeId)
{
    const data = {
        action: 'remove-product',
        data: coffeeId
    }
    $('#manager').load('cart.php', data);
}

function cartUpdate()
{
    const formData = new FormData($("#cart-form")[0]);
    const coffeeListId = [];
    for(let pair of formData.entries()) {
        const id = pair[0].replace('coffee-id-', '');
        const qty = pair[1];
        coffeeListId.push({id: id, qty: qty});
    }

    const data = {
        action: 'update-cart', 
        data: coffeeListId
    }
    $('#manager').load('cart.php', data);
}

function emptyCart()
{
    const data = {
        action: 'empty-cart', 
    }
    $('#manager').load('cart.php', data);
}

$('#login-signup-form').on('submit', function(e) {
    e.preventDefault();
    $('#login-title-message').text('');

    const formData = $(this).serialize();
    axios({
        method: 'post',
        url: API_URL + 'login',
        headers: {
            'Access-Control-Allow-Origin': '*'
        },
        data: formData
    }).then(function(response) {
        //handle success
        if (response.status == 200) {
            Cookies.set('token', response.data.data.access_token);
            $.ajax({
                url: APP_URL + 'login.php',
                method: "post",
                data: formData
            }).done(function() {
                location.reload();
            });
        }
    }).catch(function(error) {
        // handle error
        $('.login-error').text('');

        const status = error.response.status;
        if (status == 400) {
            const data = error.response.data.data;
            const message = error.response.data.message;
            if (Object.keys(data).length > 0) {
                for (const key in data) {
                    $('#login-' + key + '-error').text(data[key]);
                }
            } else {
                $('#login-title-message').text(message);
            }
        }
    });
})

$('#user-logout').on('click', function() {
    $.ajax({
        url: APP_URL + 'login.php?action=logout',
        method: "post",
    }).done(function() {
        Cookies.remove('token');
        location.reload();
    });
})