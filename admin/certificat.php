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
                <h3>Certificat SSL disponible </h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                  <div class="input-group">
                    <a href="add_ssl.php" class="btn btn-dark"><i class="fa fa-plus"></i> Add a new SSL </a>
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
                                  <th>Type SSL</th>
                                  <th>Durée(Mois)</th>
                                  <th style="width: 20%">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                  $query = $pdo->prepare("SELECT * FROM certificat_ssl ORDER BY id DESC");
                                  $query->execute();
                                  $data = $query->fetchAll(PDO::FETCH_ASSOC);
                                  foreach ($data as $row) {
                                    $num = $row['id'];
                                    $type = $row['type_ssl'];
                                    $duree = $row['duree_mois']; 
                                  
                                 ?>
                                <tr>
                                  <td><?php echo $num; ?></td>
                                  <td>
                                    <?php echo $type; ?>
                                  </td>
                                  <td>
                                    <?php echo $duree;?>
                                  </td>
                                  <td>
                                    <a href="edit_ssl.php?num=<?php echo $num;?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="delete_ssl.php?num=<?php echo $num; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
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