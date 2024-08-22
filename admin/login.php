<?php 
ob_start();
session_start();
include("../inc/config.php");
include("../inc/CSRF_Protect.php");

$csrf = new CSRF_Protect();



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- Bootstrap CSS -->
  <link rel="icon" href="../images/seticbg.png">
  <link href="../plugin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <!-- Custom CSS -->
  <link href="../css/custom.css" rel="stylesheet">
  <style>
    html,
    body{
      background-image: url('../images/server1.webp');
      background-repeat: no-repeat;
      background-size: 100% 100%;
      background-attachment: fixed;
      margin: 0;
      background-position: 10 0;
    }
    .container-fluid{
      background: rgba(0, 0, 0, 0.7);
      height: 100vh;
      width: 100%;
      display: flex;
      background-position: 10 0;
      background-size: 100% 100%;
      background-attachment: fixed;
      background-repeat: no-repeat;

    }
    .login-container {
      margin: 50px auto;
      width: 400px;
      max-width: 400px;
      
    }
      
    .login-logo {
      width: 100px;
      margin: 0 auto 20px;
      display: block;
    }
    .input-group-text {
      background-color: #fff;
    }
  </style>
</head>
<body>
  <?php 

  if(isset($_POST['loginform'])){

    $email = strip_tags($_POST['inputEmail']);
    
     $query = $pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
     $query->execute(array($email));
     $total = $query->rowCount();
     $data = $query->fetchAll(PDO::FETCH_ASSOC);

     if($total == 0){
      
      echo "<script>
            window.onload = function() {
                Toastify({
                    text: 'L'utilisateur n'existe pas',
                    duration: 5000,
                    close: true,
                    position: 'center',
                    style: {
                        background: 'rgba(220, 53, 69, 1)',
                        color: '#721c24', 
                     },
                }).showToast();
            };
        </script>";

     }else{
      
      foreach($data as $row) {
        $row_password = $row['pswd'];
      }
      if(md5($_POST['inputPass']) != $row_password){

        echo "<script>
            window.onload = function() {
                Toastify({
                    text: 'Mot de passe incorrect',
                    duration: 5000,
                    close: true,
                    position: 'center',
                    style: {
                        background: 'rgba(220, 53, 69, 1)',
                        color: '#721c24', 
                     },
                }).showToast();
            };
        </script>";

      }else{
        $_SESSION['user'] = $row;
        header('location:index.php');
      }

     }
    
}

   ?>
  <div class="container-fluid">
    <div class="login-container">
      <img src="../images/seticbg.png" alt="Logo" class="login-logo">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Login</h5>
          <form id="loginForm" method="POST">
            <?php $csrf->echoInputField();?>
            <div class="form-group">
              <label for="email">Email address</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div>
                <input type="email" class="form-control" id="email" name="inputEmail" placeholder="Enter email" required>
              </div>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-lock"></i></span>
                </div>
                <input type="password" class="form-control" id="password" name="inputPass" placeholder="Password" required>
              </div>
            </div> 
            <button type="submit" class="btn btn-primary btn-block" name="loginform">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="../plugin/jquery/dist/jquery.min.js"></script>
  <script src="../plugin/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <!-- Custom JS -->
 
</body>
</html>
