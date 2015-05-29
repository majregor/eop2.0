/**
 *
 * Standard Javascript on all the pages
 *
 */
$(document).ready(function() {

    /**
     * Logout link click prompts user with dialog to confirm option before logging them out
     */
    $('#logoutLink').click(function () {
        var txt = 'Are you sure you want to log out?';
        var logout_link = $(this).attr('href');
        var data = {
            ajax: '1',
            logout: '1'
        };

        $.prompt(txt, {
            buttons: {"Log Out": true, Cancel: false},
            close: function (e, v, m, f) {

                if (v) {
                    $.ajax({
                        url: logout_link,
                        data: data,
                        type: 'POST',
                        success: function (response) {
                            window.location = 'login';
                        },
                        error: function (error) {
                            var d = JSON.stringify(error);
                            alert(d);
                        }
                    });
                }
                else {
                }
            }
        });

        return false;
    });
});
