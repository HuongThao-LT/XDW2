const APP_URL = $('#app-url').val();
const API_URL = $('#api-url').val();
const ACCESS_TOKEN = $('#access-token').val();
const COFFEE_BRAND_ID = $('#coffee-brand-details-id').val();

axios.get(API_URL + 'admin/coffee-brands/' + COFFEE_BRAND_ID, {
    headers: {
        'Authorization': 'Bearer ' + Cookies.get('admin_token')
    }
}).then(function (response) {
    //handle success
    if (response.data.code == 200) {
        const data = response.data.data;
        $('#coffee-brand-details-title').text('COFFEE BRAND ID ' + data.id);
        $('#coffee-brand-details-name').text(data.name);
        $('#coffee-brand-details-created_at').text(data.created_at);
        $('#coffee-brand-details-updated_at').text(data.updated_at);
    }
}).catch(function (error) {
    // handle error
    console.log(error);
});

function coffeeBrandDetailsDelete()
{
    if(confirm('Do you want to delete this product?')) {
        axios({
            method: 'delete',
            url: API_URL + 'admin/coffee-brands/' + COFFEE_BRAND_ID,
            headers: {
                'Authorization': 'Bearer ' + Cookies.get('admin_token'), 
                'Access-Control-Allow-Origin': '*'
            }
        }).then(function (response) {
            //handle success
            if (response.status == 200) {
                alert(response.data.message);
                window.location = APP_URL + 'admin/coffee-brand.php';
            }
        }).catch(function (error) {
            // handle error
            console.log(error);
        });
    }
}

$('#coffee-brand-details-delete-action').on('click', coffeeBrandDetailsDelete);
