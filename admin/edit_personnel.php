<?php 
require_once 'header.php';
require_once 'sidebar.php';
require_once 'topnav.php';

if(isset($_GET['id'])){
	$query = $pdo->prepare("SELECT
                             nom,
                             prenom,
                             email,
                             username,
                             pswd,
                             telephone
                             FROM utilisateur WHERE id=?");
    $query->execute(array($_GET['id']));
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
   
    foreach ($result as $row) {
    
      $nom = $row['nom'];
      $prenom = $row['prenom'];
      $email = $row['email'];
      $password = $row['pswd'];
      $username =$row['username'];
      $tel = $row['telephone']; 
    }                              
}
if(isset($_POST['form1'])){
    
   $psd = md5($_POST['Userpassword']);
   $ip = '127.0.0.1';
   $browser = $_SERVER['HTTP_USER_AGENT'];
  
   $query = $pdo->prepare("UPDATE utilisateur SET nom=?,prenom=?,email=?,username=?,pswd=?,token_pswd=?,telephone=?,ip_adress=?,browser=? WHERE id=?");
	$query->execute(array($_POST['name'],$_POST['prenom'],$_POST['mail'],$_POST['username'],$psd,$psd,$_POST['tel'],$ip,$browser,$_GET['id']));

		$_SESSION['message_upd'] = "Modification reussie avec success !";

		header('Location:personnel.php');	
	
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
												<input type="text" id="name"  name="name" required="required" class="form-control" value="<?php echo $nom; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="prenom">Prenom <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="prenom"  name="prenom" required="required" class="form-control" value="<?php echo $prenom; ?>">
											</div>
										</div>
						
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="mail">eMail <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="email" id="mail" name="mail" required="required" class="form-control" value="<?php echo $email; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Username <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="username" name="username" required="required" class="form-control" value="<?php echo $username; ?>">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password<span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
											<input type="password" id="Userpassword"  name="Userpassword" required="required" class="form-control" value="<?php echo $password; ?>">
											</div>
										</div>
										
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="tel">Téléphone<span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="tel" name="tel" required="required" class="form-control" value="<?php echo $tel; ?>">
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