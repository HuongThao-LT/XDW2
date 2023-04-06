var api_url = $('#api-url').val();
var app_url = $('#app-url').val();

$('#login-admin-form').on('submit', function (e) {
    e.preventDefault();
    $('#login-admin-title-message').text('');

    const formData = $(this).serialize();
    axios({
        method: 'post',
        url: api_url + 'login-admin',
        headers: {
            'Access-Control-Allow-Origin': '*'
        }, 
        data: formData
    }).then(function (response) {
        //handle success
        $('.login-admin-error').text('');
        if (response.status == 200) {
            Cookies.set('admin_token', response.data.data.admin_access_token);
            $.ajax({
                url: app_url + 'admin/login.php',
                method: "post",
                data: formData
            }).done(function() {
                location.href = 'index.php';
            });
        }
    }).catch(function (error) {
        // handle error
        $('.login-admin-error').text('');
        const status = error.response.status;
        if (status == 400) {
            const data = error.response.data.data;
            const message = error.response.data.message;
            if (Object.keys(data).length > 0) {
                for (const key in data) {
                    $('#login-admin-error-' + key).text(data[key]);
                }
            } else {
                $('#login-admin-title-message').text(message);
            }
        }
    });
})