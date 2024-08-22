<?php 
require_once 'header.php';
require_once 'sidebar.php';
require_once 'topnav.php';
 ?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Site Web <small>absolete</small></h3>
              </div>
            </div>
                  
                  <div class="x_content">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">
                          
                          <div class="clearfix"></div>
                          <table id="datatable" class="table table-striped">
                              <thead>
                                <tr>
                                  <th style="width: 1%">#</th>
                                  <th>Domaine Name</th>
                                  <th>Proprietaire</th>
                                  <th>Contact</th>
                                  <th>Validite d'Hebergement</th>
                                  <th style="text-align: center">Certificat SSL</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                  $query = $pdo->prepare("SELECT co.id AS id,
                                                          domaine,
                                                          webmail,
                                                          ce.duree_mois*30 AS ssl_periode,
                                                          li.timestamp AS date_ligne,
                                                          s.date_license AS date_site,
                                                          l.duree_mois*30 AS periode
                                                          FROM certificat_ssl ce
                                                          INNER JOIN  ligne_ssl li
                                                          ON ce.id = ssl_id 
                                                          INNER JOIN corbeille co 
                                                          ON co.site_id = li.site_id 
                                                          INNER JOIN  site s  
                                                          ON s.id = co.site_id 
                                                          INNER JOIN license l
                                                          ON l.id = license_id
                                                          ORDER BY date_site DESC  ");
                                  $query->execute();
                                  $data = $query->fetchAll(PDO::FETCH_ASSOC);
                                  foreach ($data as $row) {
                                     $num = $row['id'];
                                     $domaine = $row['domaine'];
                                     $time = $row['date_site'];
                                     $periode = $row['periode'];
                                     $mail =$row['webmail'];

                                     $query = $pdo->prepare("SELECT 
                                                             fullname AS nom,
                                                             institution
                                                             whatsapp_number,
                                                             fix_number,
                                                             mobile_number
                                                             FROM client cl 
                                                             INNER JOIN site si
                                                             ON client_id = cl.id
                                                             WHERE si.id = ? ");
                                     $query->execute(array($num));
                                     $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                    
                                     foreach ($result as $value) {
                                       
                                       $proprietaire = $value['nom'];
                                       $institution = $value['institution'];
                                       $whatsapp = $value['whatsapp_number'];
                                       $fix = $value['fix_number'];
                                       $mobile = $value['mobile_number'];
                                     
                                  ?>
                                <tr>
                                  <td><?php echo $num; ?></td>
                                  <td>
                                    <a><?php echo $domaine; ?></a>
                                    <br />
                                    <small>Created <?php echo $time; ?></small>
                                  </td>
                                  <td>
                                    <?php  
                                    if(empty($institution) || $institution == 'NaN'){
                                       echo $proprietaire;
                                    }else{
                                      echo $institution;
                                    } ?>
                                  </td>
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
                                    <?php echo $periode; ?>
                                  </td>
                                  <td class="project_progress">
                                    <div class="progress progress_sm">
                                      <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="57"></div>
                                    </div>
                                    <small>57% Complete</small>
                                  </td>
                                  <td>
                                    <span class="badge badge-primary btn-xs">active</span>
                                    <br/>
                                    <small>
                                      720jours 720jours
                                    </small>
                                  </td>
                                  <td>
                                    <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                  </td>
                                </tr> 
                                  <?php
                                     }
                                   } 
                                   ?>
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