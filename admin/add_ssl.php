<?php 
require_once 'header.php';
require_once 'sidebar.php';
require_once 'topnav.php';
if(isset($_POST['form1'])){
    
  
	$query = $pdo->prepare("INSERT INTO license(type_ssl,duree_mois) VALUES(?,?)");
	$query->execute(array($_POST['type'],$_POST['duree']));

        echo "<script>
            window.onload = function() {
                Toastify({
                    text: 'Nouveau SSL ajouté avec succes',
                    duration: 5000,
                    close: true,
                    position: 'center',
                    style: {
                        background: 'rgba(40, 167, 69, 0.4)',
                        color: '#155724', 
                     },
                }).showToast();
            }";
       
		header('Location:add_ssl.php');
	
}

 ?>
<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Nouveau Certificat SSL</h3>
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
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="type">Type de SSL <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="type" name="type" required="required" class="form-control">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="duree">Duree(Mois) <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="duree" name="duree" required="required" class="form-control ">
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