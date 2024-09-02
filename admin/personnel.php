<?php 
require_once 'header.php';
require_once 'sidebar.php';
require_once 'topnav.php';
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
 ?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>User in System </h3>
              </div>

               <div class="title_right">
                <div class="col-md-5 col-sm-5 pull-right">
                  <div class="input-group">
                    <a href="add_personnel.php" class="btn btn-dark"><i class="fa fa-plus"></i> Add a new user </a>
                  </div>  
                </div>
               </div>
              </div>
            
                  <div class="x_content">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">
                          <table id="datatable" class="table table-striped">
                              <thead>
                                <tr>
                                  <th style="width: 1%">#</th>
                                  <th>Fullname</th>
                                  <th>Image</th>
                                  <th>eMail</th>
                                  <th>Telephone</th>
                                  <th>Date de creation</th>
                                  <th style="width: 30%">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                 $query = $pdo->prepare("SELECT
                                                         id, 
                                                         CONCAT(nom,' ',prenom) AS fullname,
                                                         email,
                                                         telephone,
                                                         image,
                                                         u.timestamp 
                                                         FROM utilisateur u ORDER BY id DESC");
                                  $query->execute();
                                  $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                  foreach ($result as $row) {
                                     $id =$row['id'];
                                     $fullname = $row['fullname'];
                                     $email = $row['email'];
                                     $tele = $row['telephone'];
                                     $login = $row['timestamp'];
                                     $image = $row['image'];
                                    
                                 ?>
                                <tr>
                                  <td><?php echo $id; ?></td>
                                  <td>
                                    <a><?php echo $fullname; ?></a>
                                  </td>
                                  <td>
                                    <img src="../images/<?php echo $image;?>" class="avatar" alt="setic">
                                  </td>
                                  <td>
                                    <?php echo $email;  ?>
                                  </td>
                                  <td>
                                    <?php echo $tele;  ?>
                                  </td>
                                  <td>
                                    <?php echo $login;  ?>
                                  </td>
                                  
                                  <td>
                                    <a href="edit_personnel.php?id=<?php echo $id; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="delete_personnel.php?id=<?php echo $id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
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