 $(document).ready(function(){
      
      $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();

        if (email === '' || password === '') {
          showAlert('Please fill in all fields', 'danger');
        } else {
          showAlert('Login successful', 'success');
        }
      });

      function showAlert(message, type) {
        var alertHtml = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">'
                      + message
                      + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                      + '<span aria-hidden="true">&times;</span>'
                      + '</button>'
                      + '</div>';
        $('.login-container').prepend(alertHtml);
      }
    });

 