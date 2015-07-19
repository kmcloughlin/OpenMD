<?php
$app->get(

  '/login', function() {

  require('header.php');
	require('nav.php');
	require('footer.php');

  echo <<<HTML
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Open MD</title>

    $header_template

  </head>
 <body>

 	$nav_template

    <div id="login-page" class="form-page container-fluid">
      <h1>Login</h1>
      <div>
        <div class="alert alert-danger" role="alert"></div>
        <form id="patientLoginForm" action="/api/login/patient" method="POST">
          
          <div class="row">
            <div class="form-group col-md-12">
              <label for="uName">Email</label>
              <input type="text" class="form-control" id="uName" placeholder="" name="email">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-12">
              <label for="pWord">Password</label>
              <input type="text" class="form-control" id="pWord" placeholder="" name="password">
            </div>
          </div>

          <button type="submit" class="btn btn-default">Login</button>
        </form>
      </div>
    </div>

   $footer_template

   <script>
      //ajax form submit
      $(document).ready(function(){
        $('#patientLoginForm').ajaxForm();

        // attach handler to form's submit event
        $('#patientLoginForm').submit(function() {
            // submit the form
            $(this).ajaxSubmit({ 'success': function(responseText, statusText, xhr, form)  {
                  var resp = $.parseJSON( responseText );
                  if (resp.response && resp.response == "error") {
                    $('.alert-danger').text(resp.message).show();
                  } else {
                    alert('login successful');
                  }
              }
            });
            // return false to prevent normal browser submit and page navigation
            return false;
        });
      });
    </script>

  </body>
</html>
HTML;
  }
);
?>