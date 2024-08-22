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
                <h3>Informations de Client</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                  <div class="input-group">
                    <a href="add_client.php" class="btn btn-dark"><i class="fa fa-plus"></i> Add a new client </a>
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
                                  <th>FullName</th>
                                  <th>Institution</th>
                                  <th>Sociaux Media</th>
                                  <th>Contact</th>
                                  <th>Tel. Fix</th>
                                  <th>Adresse</th>
                                  <th>Date</th>
                                  <th style="width: 20%">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                  $query = $pdo->prepare("SELECT *,DATE_FORMAT(timestamp,'%D %b %Y') AS day FROM client ORDER BY id DESC");
                                  $query->execute();
                                  $data = $query->fetchAll(PDO::FETCH_ASSOC);
                                  foreach ($data as $row) {
                                    $num = $row['id'];
                                    $nom = $row['fullname'];
                                    $inst = $row['institution'];
                                    $whatsapp = $row['whatsapp_number'];
                                    $fix = $row['fix_number'];
                                    $mobile = $row['mobile_number'];
                                    $adress = $row['adresse'];
                                    $day = $row['day']
                                  
                                 ?>
                                <tr>
                                  <td><?php echo $num; ?></td>
                                  <td>
                                    <?php echo $nom; ?>
                                  </td>
                                  <td><?php echo $inst; ?></td>
                                  <td>
                                    <ul class="list-inline">
                                      <li>
                                        <?php $phone_url = urlencode($whatsapp);
                                              $message_url = urlencode("Bonjour cher client de Setic"); 
                                        
                                      echo '<a href="whatsapp://send?phone={$phone_url}&text={$message_url}"><img src="../images/whatsappbg.png" class="avatar" alt="Avatar"></a>
                                      </li>'
                                      ?>
                                      <li>
                                        <a href=""><img src="../images/mailbg.png" class="avatar" alt="Avatar"></a>
                                      </li>
                                    </ul>
                                  </td>
                                  <td>
                                    <?php echo $mobile; ?>
                                  </td>
                                  <td>
                                    <?php echo $fix; ?>
                                  </td>
                                  <td>
                                    <?php echo $adress; ?>
                                  </td>
                                  <td>
                                    <?php echo $day; ?>
                                  </td>
                                  <td>
                                    <a href="update_client.php?id=<?php echo $num;?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="delete_client.php?id=<?php echo $num; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
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
        <!-- /page content -->
<?php require_once 'footer.php'; ?>