<?php 
require_once 'header.php';
require_once 'sidebar.php';
require_once 'topnav.php';
 if(isset($_POST['form'])){

   $date = new DateTime();
   $formattedDate = $date->format('Y-m-d H:i:s');
	 $query = $pdo->prepare("INSERT INTO site(client_id,license_id,certificat_id,domaine,webmail,date_license) VALUES(?,?,?,?,?,?)");
	  $query->execute(array($_POST['client'],$_POST['license'],$_POST['ssl'],$_POST['domaine'],$_POST['mail'],$formattedDate));

      $query = $pdo->prepare("SELECT id FROM site WHERE domaine = ?");
	    $query->execute(array($_POST['domaine']));
	    $result =$query->fetchAll(PDO::FETCH_ASSOC);
	    
	    foreach ($result as $value) {

	    	$id = $value['id'];
	    	$query = $pdo->prepare("INSERT INTO ligne_ssl(site_id,ssl_id) VALUES(?,?)");
	      $query->execute(array($id,$_POST['ssl']));
	    }

	  echo "<script>
            window.onload = function() {
                Toastify({
                    text: 'Nouveau site ajouté avec success !',
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
		header('Location:add_site.php');	
	
}

 ?>
<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Nouveau Site Web</h3>
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
									<br/>
									<form method="post" >

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="domaine">Domaine Name <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="domaine" name="domaine" required="required" class="form-control ">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="selectClient">Client *</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" id="selectClient" name="client" >
													<option value="">--Choose a Client--</option>
												<?php
													$query = $pdo->prepare("SELECT 
														                    id,
														                    fullname 
														                    FROM client ORDER BY id DESC");
													$query->execute();
													$result = $query->fetchAll(PDO::FETCH_ASSOC);
													foreach ($result as $row) {
													 ?>
													<option value="<?php echo $row['id']; ?>"><?php echo $row['fullname']; ?></option>
												<?php } ?>
												</select>
												<span id="addClient" class="text-danger" style="display: none;">
												Vous pouvez ajouter un nouveau proprietaire! 
												<a href="add_proprietaire.php">Cliquez-ici</a>
											    </span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="license">License *</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" id="license" name="license" >
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
													<option value="<?php echo $row['id']; ?>"><?php echo $row['nom'];  ?>
														
													</option>
												<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="ssl">Certificat *</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" id="ssl" name="ssl" >
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
													<option value="<?php echo $row['id']; ?>"><?php echo $row['type_ssl']; ?></option>
												<?php } ?>
												</select>
											</div>
										</div>
										
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="mail">WebMail <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="email" id="mail" name="mail" required="required" class="form-control">
											</div>
										</div>
										
										
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-primary" type="button">Cancel</button>
												<button class="btn btn-primary" type="reset">Reset</button>
												<button type="submit" name="form" class="btn btn-success">Submit</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<script type="text/javascript">
	const client = document.getElementById('selectClient');
        
        client.addEventListener('change', function() {
          
          const proprietaire = document.getElementById('addClient');
          
          if(proprietaire.style.display === 'none'){
            proprietaire.style.display = 'block'; 
          }else{
            proprietaire.style.display = 'none';
          }
     });
       
</script>
<?php require_once 'footer.php'; ?>							