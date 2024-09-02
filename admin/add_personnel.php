<?php 
require_once 'header.php';
require_once 'sidebar.php';
require_once 'topnav.php';

if(isset($_SESSION['message'])){
echo "<script>
            window.onload = function() {
                Toastify({
                    text: '{$_SESSION['message']}',
                    duration: 5000,
                    close: true,
                    position: 'center',
                    style: {
                        background: 'rgba(40, 167, 69, 0.4)',
                        color: '#155724', 
                     },
                }).showToast();
            };
        </script>";	
   unset($_SESSION['message']);
}
if(isset($_POST['form1'])){
    
    $psd = md5($_POST['Userpassword']);
    $ip = '127.0.0.1';
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $image = "setic.png";
    $time = new DateTime();
  
  $query = $pdo->prepare("INSERT INTO utilisateur(nom,prenom,email,username,image,pswd,token_pswd,telephone,ip_adress,browser,last_login) VALUES(?,?,?,?,?,?,?,?,?,?)");
	$query->execute(array($_POST['name'],$_POST['prenom'],$_POST['mail'],$_POST['username'],$image,$psd,$psd,$_POST['tel'],$ip,$browser,$time));

     $_SESSION['message'] = 'Nouveau utilisateur ajouté avec success !'
		
	header('Location:add_personnel.php');

 }
	

 ?>
<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Nouveau Utilisateur </h3>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Veuillez remplir tout le champ</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form method="post">
                                       <?php $csrf->echoInputField();?>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Nom <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="name"  name="name" required="required" class="form-control">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="prenom">Prenom <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="prenom"  name="prenom" required="required" class="form-control">
											</div>
										</div>
						
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="mail">eMail <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="email" id="mail" name="mail" required="required" class="form-control">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Username <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="username" name="username" required="required" class="form-control">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password<span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="password" id="Userpassword"  name="Userpassword" required="required" class="form-control">
											</div>
										</div>
										
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="tel">Téléphone<span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="tel" name="tel" required="required" class="form-control">
											</div>
										</div>
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<a href="personnel.php"><button class="btn btn-primary" type="button">Cancel</button></a>
												<button class="btn btn-primary" type="reset">Reset</button>
												<button type="submit" name="form1" class="btn btn-success">Submit</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
   
<?php require_once 'footer.php'; ?>							