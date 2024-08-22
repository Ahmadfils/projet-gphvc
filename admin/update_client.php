<?php 
require_once 'header.php';
require_once 'sidebar.php';
require_once 'topnav.php';




if(isset($_GET['id']) && !empty($_GET['id'])){
   
   $query = $pdo->prepare("SELECT * FROM client WHERE id = ? ");
   $query->execute(array($_GET['id']));
   $data = $query->fetchAll(PDO::FETCH_ASSOC);
                                
    foreach ($data as $row) {
        $nom = $row['fullname'];
        $inst = $row['institution'];
        $email = $row['email'];
        $inst = $row['institution'];
        $whatsapp = $row['whatsapp_number'];
        $fix = $row['fix_number'];
        $mobile = $row['mobile_number'];
        $adresse = $row['adresse'];

    }	
}

if(isset($_POST['form1'])){

    $psd = md5($_POST['password']);
	$query = $pdo->prepare("UPDATE client 
		                    SET fullname= ?,
		                    email= ?,
		                    password = ?,
		                    institution = ?, 
		                    whatsapp_number = ?,
		                    fix_number = ?,
		                    mobile_number = ?,
		                    adresse = ?,
		                    WHERE id = ?");
	$query->execute(array($_POST['name'],$_POST['mail'],$psd,$_POST['inst'],$_POST['whatsapp'],$_POST['fix'],$_POST['mobile'],$_POST['adress'],$_GET['id']));

		$message = "Modification reussie avec success !";
		$_SESSION['message_upd'] = $message;
		header('Location:client.php');
	
}


 ?>
<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Modification du Client 
							  <small>
							  	"<?php if(empty($inst) || $inst == 'NaN'){
                                     echo $nom;
							    }else{
							    	echo $inst;
							    } ?>"</small> 
							</h3>
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
									<form id="form" data-parsley-validate class="form-horizontal form-label-left" method="post">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Fullname <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="name" name="name" required="required" class="form-control" value="<?php echo $nom; ?>" >
											</div>
										</div>
						
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="mail">eMail <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="email" id="mail" name="mail" required="required" class="form-control" value="<?php echo $email; ?>" >
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="password" id="password"  name="password" required="required" class="form-control">
											</div>
										</div>
										<div class="item form-group">
											<p class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">C'est une institution ? <span class="required"> *</span>
											</p>
											<div class="col-md-6 col-sm-6 justify-content-between">
												 <label  class="col-form-label label-align">
													<input type="checkbox" id="oui"  class="flat"> Oui
												 </label>
											
												 <label class="col-form-label label-align">
													<input type="checkbox" id="non" class="flat"> Non
												 </label>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="inst">Nom de l'institution <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="inst" name="inst" class="form-control" value="<?php echo $inst; ?>">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="fix">Fix number <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="fix" name="fix" required="required" class="form-control" value="<?php echo $fix; ?>" >
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="whatsapp">Whatsapp <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="whatsapp" name="whatsapp" required="required" class="form-control" value="<?php echo $whatsapp; ?>" >
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="mobile">Mobile number <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="mobile" name="mobile" required="required" class="form-control" value="<?php echo $mobile; ?>" >
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="adress">Adresse <span class="required"> *</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="adress" name="adress" required="required" class="form-control" value="<?php echo $adresse; ?>" >
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

<?php require_once 'footer.php'; ?>							