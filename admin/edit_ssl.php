<?php 
require_once 'header.php';
require_once 'sidebar.php';
require_once 'topnav.php';

if(isset($_GET['num']) && !empty($_GET['num'])){

$query = $pdo->prepare("SELECT * FROM certificat_ssl WHERE id = ? ");
$query->execute(array($_GET['num']));
$data = $query->fetchAll(PDO::FETCH_ASSOC);
 foreach ($data as $row) {

  $type = $row['type_ssl'];
  $duree = $row['duree_mois']; 
 }
}

if(isset($_POST['form1'])){
    
	$query = $pdo->prepare("UPDATE certificat_ssl SET 
		                    type_ssl = ?,
		                    duree_mois = ? WHERE id = ?");
	$query->execute(array($_POST['type'],$_POST['duree'], $_GET['id']));

		$message = "Modification reussie avec success !";
		$_SESSION['message_upd'] = $message;
		header('Location:certificat.php');
	
}

 ?>
<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Modification de SSL <small>"<?php echo $type;?>"</small></h3>
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
												<input type="text" id="type" name="type" required="required" class="form-control" value="<?php echo $type; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="duree">Duree(Mois) <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="duree" name="duree" required="required" class="form-control" value="<?php echo $duree; ?>">
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