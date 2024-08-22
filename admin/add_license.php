<?php 
require_once 'header.php';
require_once 'sidebar.php';
require_once 'topnav.php';
if(isset($_POST['form1'])){
    
    $price = $_POST['prix'].'FBU';
    $stockage = $_POST['stockage'].'GB';
    $traffic = $_POST['traffic'].'bit/sec';

	$query = $pdo->prepare("INSERT INTO license(nom,prix,duree_mois,compatibilite_bd,nbr_bd,stockage,nbr_email,traffic) VALUES(?,?,?,?,?,?,?,)");
	$query->execute(array($_POST['name'],$price,$psd,$_POST['bd'],$_POST['nb_bd'],$stockage,$_POST['nb_email'],$traffic));

		echo "<script>
            window.onload = function() {
                Toastify({
                    text: 'Nouveau License ajouté avec success !',
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
		header('Location:add_license.php');
	
}

 ?>
<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Nouveau License d'hebergement</h3>
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

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="name">License Name <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="name" name="name" required="required" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="prix">Price(FBU) <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="prix" name="prix" required="required" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="duree">Duree d'hebergement(Mois) <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="duree" name="duree" required="required" class="form-control ">
											</div>
										</div>
                                         <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="bd">Base de donnees <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
											  <input type="text" id="bd" name="bd" required="required" placeholder="Ex: Mysql, Oracle" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="nb_bd">Nombre de BD <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="nb_bd" name="nb_bd" required="required" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="stockage">Stockage(GB) <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="stockage" name="stockage" required="required" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="nb_email">Nombre d'email <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="stockage" name="nb_email" required="required" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="traffic">Traffic(bit/sec) <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="traffic"  name="traffic" required="required" class="form-control">
											</div>
										</div>
										
										
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-primary" type="button">Cancel</button>
												<button class="btn btn-primary" type="reset">Reset</button>
												<button type="submit" class="btn btn-success" name="form1">Submit</button>
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