        </main>
    </div>
    <!-- Bootstrap Jquery -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Datatable Jquery -->
    <script src="http://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- JS -->
    <script type="text/javascript">
        // let buttons = document.querySelectorAll('.sidebar-menu li a');
        // buttons.forEach(a => {
        //     a.addEventListener('click', function () {
        //         buttons.forEach(btn =>btn.classList.remove('active'));
        //         this.classList.add('active');
        //     });
        // });

        const currentLocation = location.href;
        const menuItem = document.querySelectorAll('.sidebar-menu li a');
        const menuLength = menuItem.length;
        for(let i =0; i< menuLength; i++){
            if(menuItem[i].href ===currentLocation){
                menuItem[i].classList.add('active');
            }
        }

        var app_url = $('#app-url').val();
        $('#admin-logout').on('click', function () {
            $.ajax({
                url: app_url + 'admin/login.php?action=logout'
            }).done(function() {
                Cookies.remove('admin_token');
                location.href = "index.php";
            });
        })
    </script>
</body>
</html>