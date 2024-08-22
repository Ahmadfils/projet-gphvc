<?php 
require_once 'header.php';
require_once 'sidebar.php';
require_once 'topnav.php';
if (isset($_SESSION['message_del'])) {
        echo "<script>
            window.onload = function() {
                Toastify({
                    text: '{$_SESSION['message_del']}',
                    duration: 5000,
                    close: true,
                    position: 'center',
                    style: {
                        background: 'rgba(23, 162, 184, 0.5)',
                        color: '#0c5460', 
                     },
                }).showToast();
            };
        </script>";
        unset($_SESSION['message_del']); 
    }

    if (isset($_SESSION['message_upd'])) {
        echo "<script>
            window.onload = function() {
                Toastify({
                    text: '{$_SESSION['message_upd']}',
                    duration: 5000,
                    close: true,
                    position: 'center',
                    style: {
                        background: 'rgba(23, 162, 184, 0.5)',
                        color: '#0c5460', 
                     },
                }).showToast();
            };
        </script>";
        unset($_SESSION['message_upd']); 
    }
 
 ?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>License d'hebergement disponible </h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                  <div class="input-group">
                    <a href="add_license.php" class="btn btn-dark"><i class="fa fa-plus"></i> Add a new License </a>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>
                  
                  <div class="x_content">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">
                          <table id="datatable" class="table table-striped">
                              <thead>
                                <tr>
                                  <th style="width: 2%">#</th>
                                  <th>Name</th>
                                  <th>Prix</th>
                                  <th>Duree(Mois)</th>
                                  <th>Base de donnees</th>
                                  <th>Nombre de BD</th>
                                  <th>Stockage</th>
                                  <th>Nombre d'email</th>
                                  <th>Traffic</th>
                                  <th style="width: 20%">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                  $query = $pdo->prepare("SELECT * FROM license ORDER BY id DESC");
                                  $query->execute();
                                  $data = $query->fetchAll(PDO::FETCH_ASSOC);
                                  foreach ($data as $row) {
                                    $num = $row['id'];
                                    $nom = $row['nom'];
                                    $prix = $row['prix'];
                                    $duree = $row['duree_mois'];
                                    $bd = $row['compatibilite_bd'];
                                    $nb_bd = $row['nbr_bd'];
                                    $stockage = $row['stockage'];
                                    $nb_email = $row['nbr_email'];
                                    $traffic = $row['traffic']; 
                                  
                                 ?>
                                <tr>
                                  <td><?php echo $num; ?></td>
                                  <td>
                                    <?php echo $nom; ?>
                                  </td>
                                  <td>
                                    <?php echo $prix;?>
                                  </td>
                                  <td>
                                    <?php echo $duree; ?>
                                  </td>
                                  <td>
                                    <?php echo $bd; ?>
                                  </td>
                                  <td>
                                    <?php echo $nb_bd; ?>
                                  </td>
                                  <td>
                                    <?php echo $stockage; ?>
                                  </td>
                                  <td>
                                    <?php echo $nb_email; ?>
                                  </td>
                                  <td>
                                    <?php echo $traffic; ?>
                                  </td>
                                  <td>
                                    <a href="edit_license.php?num=<?php echo $num;?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="delete_license.php?num=<?php echo $num; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                  </td>
                                </tr> 
                              <?php } ?>
                              </tbody>
                           </table>
                        </div>
                      </div>
                    </div>
            </div>
          </div>
        </div>
   
<?php require_once 'footer.php'; ?>