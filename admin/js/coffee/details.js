const APP_URL = $('#app-url').val();
const API_URL = $('#api-url').val();
const ACCESS_TOKEN = $('#access-token').val();
const COFFEE_IMAGE_PATH = $('#coffee-image-path').val();
const COFFEE_ID = $('#coffee-details-id').val();

axios.get(API_URL + 'admin/coffees/' + COFFEE_ID, {
    headers: {
        'Authorization': 'Bearer ' + Cookies.get('admin_token'), 
        'Access-Control-Allow-Origin': '*'
    }
}).then(function (response) {
    //handle success
    if (response.data.code == 200) {
        const data = response.data.data;
        $('#coffee-details-title').text('COFFEE ID ' + data.id);
        $('#coffee-details-image').attr('src', COFFEE_IMAGE_PATH + data.image);
        $('#coffee-details-name').text(data.name);
        $('#coffee-details-status').text(data.status ? 'Activated' : 'Unactivated');
        $('#coffee-details-price').text(data.price + '$');
        $('#coffee-details-type').text(data.coffee_type.name);
        $('#coffee-details-brand').text(data.coffee_brand.name);
        $('#coffee-details-description').text(data.description);
        $('#coffee-details-created_at').text(data.created_at);
        $('#coffee-details-updated_at').text(data.updated_at);
    }
}).catch(function (error) {
    // handle error
    console.log(error);
});

function coffeeDetailsDelete()
{
    if(confirm('Do you want to delete this product?')) {
        axios({
            method: 'delete',
            url: API_URL + 'admin/coffees/' + COFFEE_ID,
            headers: {
                'Authorization': 'Bearer ' + Cookies.get('admin_token')
            }
        }).then(function (response) {
            //handle success
            if (response.status == 200) {
                alert(response.data.message);
                window.location = APP_URL + 'admin/coffee.php';
            }
        }).catch(function (error) {
            // handle error
            console.log(error);
        });
    }
}

$('#coffee-details-delete-action').on('click', coffeeDetailsDelete);
