<?php 
require_once 'header.php';

if(isset($_GET['id']) && !empty($_GET['id'])){
 
 $query = $pdo->prepare("SELECT * FROM site WHERE id = ?");
 $query->execute(array($_GET['id']));
 $data = $query->fetchAll(PDO::FETCH_ASSOC);
                                
  foreach ($data as $row) {
    
    $client = $row['client_id'];
    $domaine = $row['domaine'];
    $mail = $row['webmail'];
    $certificat = $row['certificat_id'];
    $license = $row['license_id'];
 }
}

if(isset($_POST['form1'])){
    $client = $_SESSION['user']['id'];
	$query = $pdo->prepare("UPDATE site 
		                    SET client_id = ?, 
		                    license_id = ?,
		                    certificat_id = ?,
		                    domaine = ?,
		                    webmail =?
		                    WHERE id = ?");
	$query->execute(array($client,$_POST['license'],$_POST['ssl'],$_POST['domaine'],$_POST['mail'],$_GET['id']));
  
  if($certificat != $_POST['ssl']){
	  
  	$query = $pdo->prepare("INSERT INTO ligne_ssl(site_id,ssl_id) VALUES(?,?)");
	  $query->execute(array($_GET['id'],$_POST['ssl']));
  }

		$message = "Modification reussie avec success !";
		$_SESSION['message_upd'] = $message;
		header('Location:dashboard.php');
	
}


 ?>
<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
					 <div class="title_left" style="padding-left: 20px;">
					  <h3><i class="fa fa-pencil"></i>Edit du Site Web <small><?php echo $domaine; ?></small></h3>
					 </div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
								   <h5>En changeant le license d'hebergement ou le certificat SSL. Sa validité commence a nouveau!..</h5>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form method="post">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="domaine">Domaine Name <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="domaine"  name="domaine" required="required" class="form-control" value="<?php echo $domaine; ?>">
											</div>
										</div>

										<div class="form-group row">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="license">License *</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" id="license" name="license">
													<option value="">--Choose a License--</option>
												<?php
													$query = $pdo->prepare("SELECT 
														                    id,
														                    nom 
														                    FROM license ORDER BY id DESC");
													$query->execute();
													$result = $query->fetchAll(PDO::FETCH_ASSOC);
													foreach ($result as $row) {
													 ?>
													<option value="<?php echo $row['id']; ?>" <?php if($row['id']== $license){ echo 'selected';} ?>><?php echo $row['nom'];  ?>
														
													</option>
												<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="ssl">Certificat *</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" id="ssl" name="ssl">
													<option value="">--Choose a SSL--</option>
												<?php
													$query = $pdo->prepare("SELECT 
														                    id,
														                    type_ssl 
														                    FROM certificat_ssl 
														                    ORDER BY id DESC");
													$query->execute();
													$result = $query->fetchAll(PDO::FETCH_ASSOC);
													foreach ($result as $row) {
													 ?>
													<option value="<?php echo $row['id']; ?>" <?php if($row['id']==$certificat){ echo 'selected';} ?> ><?php echo $row['type_ssl']; ?></option>
												<?php } ?>
												</select>
											</div>
										</div>
										
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="mail">WebMail <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="email" id="mail" name="mail" required="required" class="form-control" value="<?php echo $mail; ?>">
											</div>
										</div>
										
										
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-primary" type="button">Cancel</button>
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
<script src="js/custom.min.js"></script>
</body>
</html>							