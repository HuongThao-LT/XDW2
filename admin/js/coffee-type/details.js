const APP_URL = $('#app-url').val();
const API_URL = $('#api-url').val();
const ACCESS_TOKEN = $('#access-token').val();
const COFFEE_TYPE_ID = $('#coffee-type-details-id').val();

axios.get(API_URL + 'admin/coffee-types/' + COFFEE_TYPE_ID, {
    headers: {
        'Authorization': 'Bearer ' + Cookies.get('admin_token')
    }
}).then(function (response) {
    //handle success
    if (response.data.code == 200) {
        const data = response.data.data;
        $('#coffee-type-details-title').text('COFFEE TYPE ID ' + data.id);
        $('#coffee-type-details-name').text(data.name);
        $('#coffee-type-details-created_at').text(data.created_at);
        $('#coffee-type-details-updated_at').text(data.updated_at);
    }
}).catch(function (error) {
    // handle error
    console.log(error);
});

function coffeeTypeDetailsDelete()
{
    if(confirm('Do you want to delete this product?')) {
        axios({
            method: 'delete',
            url: API_URL + 'admin/coffee-types/' + COFFEE_TYPE_ID,
            headers: {
                'Authorization': 'Bearer ' + Cookies.get('admin_token'), 
                'Access-Control-Allow-Origin': '*'
            }
        }).then(function (response) {
            //handle success
            if (response.status == 200) {
                alert(response.data.message);
                window.location = APP_URL + 'admin/coffee-type.php';
            }
        }).catch(function (error) {
            // handle error
            console.log(error);
        });
    }
}

$('#coffee-type-details-delete-action').on('click', coffeeTypeDetailsDelete);
