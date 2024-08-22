<?php 
ob_start();
session_start();
include ("inc/config.php");
include ("inc/CSRF_Protect.php");
$csrf = new CSRF_Protect();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GPHVC</title>
    <link rel="icon" href="images/setic.png">
    <link href="plugin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="plugin/nprogress/nprogress.css" rel="stylesheet">
    <link href="plugin/animate.css/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="css/custom.css" rel="stylesheet">
  </head>
  <body class="login">
    <?php 
     if(isset($_POST['form1'])){

    $email = strip_tags($_POST['inputEmail']);
    
     $query = $pdo->prepare("SELECT *,DATE_FORMAT(timestamp,'%b %Y') AS day FROM client WHERE email = ?");
     $query->execute(array($email));
     $total = $query->rowCount();
     $data = $query->fetchAll(PDO::FETCH_ASSOC);

     if($total === 0){
     
      echo "<script>
            window.onload = function() {
                Toastify({
                    text: 'L'utilisateur n'existe pas',
                    duration: 5000,
                    close: true,
                    position: 'center',
                    style: {
                        background: 'rgba(220, 53, 69, 0.3)',
                        color: '#721c24', 
                     },
                }).showToast();
            };
        </script>";
        

     }else{
      
      foreach($data as $row) {
        $row_password = $row['password'];
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
                        background: 'rgba(220, 53, 69, 0.3)',
                        color: '#721c24', 
                     },
                }).showToast();
            };
        </script>";

      }else{
        $_SESSION['user'] = $row;
        header('Location:dashboard.php');
      }

     }
    
}


     ?>
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post">
              <?php $csrf->echoInputField();?>
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="inputEmail" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="inputPass" required="" />
                <a class="reset_pass" href="#">Lost your password?</a>
                <br/>
              </div>
              <div>
                <br/>
                <a class="btn btn-default submit" href="#"><button type="submit" class="btn btn-primary btn-block" name="form1">Log in</button></a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />
                 <a class="btn btn-default text-primary" href="index.php">Return home<i style="margin-top: 4px;"class="fa fa-sign-out pull-right"></i></a>
                <div>
                  <h1><i class="fa fa-paw"></i> GPHVC</h1>
                  <p>©2024 All Rights Reserved. GPHVC's Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="post">
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div class="item form-group">
                      <p class="col-form-label col-md-6 col-sm-6 label-align" style="font-size: 15px;">C'est une institution ?
                      </p>
                      <div class="col-md-6 col-sm-6 justify-content-between">
                         <label  class="col-form-label" for="oui">
                          <input type="checkbox" id="oui"> Oui
                         </label>
                      
                         <label class="col-form-label" for="non">
                          <input type="checkbox" id="non" checked="checked"> Non
                         </label>
                      </div>
                    </div>
                    <p>Si oui Veuillez remplir ce champ suivant, au contraire laisser</p>
                    <div>
                      <input type="text" id="inst" name="inst" class="form-control" placeholder="Nom de l'institution" value="NaN" disabled="disabled"> 
                    </div>
                    
                    <div>
                      <input type="text" id="fix" name="fix" required="required" placeholder="Fix number" class="form-control">
                    </div>
                    <div>
                      <input type="text" id="whatsapp" name="whatsapp" required="required" placeholder="Whatsapp" class="form-control">
                    </div>

                    <div>
                        <input type="text" id="mobile" name="mobile" required="required" placeholder="Mobile number" class="form-control">
                    </div>

                    <div>
                      <input type="text" id="adress" name="adress" required="required" placeholder="Adresse" class="form-control">
                    </div>
              <div>
                <button class="btn btn-primary" type="reset">Reset</button>
               <button type="submit" class="btn btn-primary" name="form2">Submit</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br/>
                <a class="btn btn-default text-primary" href="index.php">Return home<i style="margin-top: 4px;"class="fa fa-sign-out pull-right"></i></a>

                <div>
                  <h1><i class="fa fa-paw"></i> GPHVC!</h1>
                  <p>©2024 All Rights Reserved. GPHVC's Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script type="text/javascript">
    const checkboxOui = document.getElementById('oui');
    const checkboxNon = document.getElementById('non');
    const inputInst = document.getElementById('inst');

    checkboxOui.addEventListener('change', function() {
        if(checkboxOui.checked){
            inputInst.value = '';
            inputInst.disabled = false;
            checkboxNon.checked = false;
        }else{
            inputInst.value = 'NaN';
            inputInst.disabled = true;
            checkboxOui.checked = false;
        }
    });

    checkboxNon.addEventListener('change', function() {
        if(checkboxNon.checked){
            inputInst.value = 'NaN';
            inputInst.disabled = true;
            checkboxOui.checked = false;
        }else{
            inputInst.value = '';
            inputInst.disabled = false;
            checkboxNon.checked = true;
        }
    
    });
    
</script>
  </body>
</html>


