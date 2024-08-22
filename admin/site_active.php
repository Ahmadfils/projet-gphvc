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
                <h3>Site Web <small>active</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                  <div class="input-group">
                    <a href="add_site.php" class="btn btn-dark"><i class="fa fa-plus"></i> Add a new site </a>
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
                                  <th>Domaine Name</th>
                                  <th>Proprietaire</th>
                                  <th>eMail professionnel</th>
                                  <th>Validité d'Hebergement</th>
                                  <th style="text-align: center">Certificat SSL</th>
                                  <th style="width: 30%">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                $query = $pdo->prepare("SELECT s.id AS id,
                                                        fullname AS nom,
                                                        institution,
                                                        domaine,
                                                        webmail,
                                                        s.date_license AS temps,
                                                        lic.duree_mois*30 AS periode
                                                        FROM client cl 
                                                        INNER JOIN site s
                                                        ON client_id = cl.id
                                                        INNER JOIN license lic
                                                        ON lic.id = license_id  
                                                        ORDER BY temps DESC  ");
                                $query->execute();
                                $data = $query->fetchAll(PDO::FETCH_ASSOC);
                                
                                foreach ($data as $row) {
                                     $num = $row['id'];
                                     $proprietaire = $row['nom'];
                                     $institution = $row['institution'];
                                     $domaine = $row['domaine'];
                                     $timeLicense = $row['temps'];
                                     $periodeLicense = $row['periode'];
                                     $mail =$row['webmail'];

                                     $dateActuelle = new DateTime();
                                     $dateAncienne = new DateTime($timeLicense);
                                     $difference = $dateActuelle->diff($dateAncienne);
                                     $nbrJours = $difference->days;
                                     $nbrJoursRestant = $periodeLicense-$nbrJours;
                                     $jourAccumuleEnPourcentage = ($nbrJours*100)/$periodeLicense;
                                     $PourcentageFormate = round($jourAccumuleEnPourcentage, 2);
                             
                                     if($nbrJours <= $periodeLicense){ 
                                       echo
                                          '<tr>
                                            <td>'.$num.'</td>
                                            <td>
                                              '.$domaine.'
                                              <br />
                                              <small>crée le '.$timeLicense.'</small>
                                            </td>
                                            <td>
                                              ';
                                              if(empty($institution) || $institution == 'NaN'){
                                                echo $proprietaire;
                                                }else{
                                                  echo $institution;
                                                }
                                        echo 
                                           '</td>
                                            <td>
                                              '.$mail.'
                                              <br />
                                              <small> <a href="#" class="badge badge-primary" style="padding: 3px">Envoyer un mail</a></small>
                                            </td>
                                            <td class="project_progress">  
                                                  <div class="progress progress_sm">
                                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="'.$PourcentageFormate.'"></div>
                                                  </div>
                                                  <small>
                                                  '.$PourcentageFormate.'% ('.$nbrJours.' jours sur '.$periodeLicense.' jours)
                                                  </small>
                                            </td>';

                                             $query = $pdo->prepare("SELECT
                                                                     ce.duree_mois*30 AS ssl_periode,
                                                                     li.timestamp AS date_ligne
                                                                     FROM ligne_ssl li 
                                                                     INNER JOIN certificat_ssl ce
                                                                     ON ce.id = ssl_id
                                                                     WHERE  site_id = ? LIMIT 1");
                                             $query->execute(array($num));
                                             $total = $query->rowCount();
                                             $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                             if ($total == 0) {
                                               echo '<td>
                                                     <span class="badge badge-danger">Pas de SSL</span>
                                                     </td>';
                                             }else{

                                              foreach ($result as $value) {
                                             
                                                 $timeSSL =$value['date_ligne'];
                                                 $periodeSSL = $value['ssl_periode'];                
                                                 
                                                 $dateAncienneSSL = new DateTime($timeSSL);
                                                 $diffSSL = $dateActuelle->diff($dateAncienneSSL);
                                                 $nbrJoursSSL = $diffSSL->days;
                                                 $nbrJoursRestantSLL = $periodeSSL-$nbrJoursSSL;
                                                 
                                                 if($nbrJoursSSL <= $periodeSSL){
                                                  echo 
                                                    '<td>
                                                      <span class="badge badge-primary">active</span>
                                                      <br/>
                                                      <small>'.
                                                       $nbrJoursSSL.' jours sur '. $periodeSSL.' jours
                                                      </small>
                                                    </td>';

                                                  }else if($nbrJoursSSL > $periodeSSL){

                                                    echo 
                                                      '<td>
                                                          <span class="badge badge-warning">non active</span>
                                                       </td>';
                                                  }
                                                 
                                            }


                                             }
                                            
                                             

                                            echo 
                                            '<td>
                                              <a href="https://'.$domaine.'" target="_blank"class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View </a>
                                              <a href="edit_site.php?id='.$num.'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                              <a href="delete_site.php?id='.$num.'" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                            </td>
                                          </tr>';
                                      
                                    
                                     }else{


                                       $query = $pdo->prepare("DELETE FROM
                                                              corbeille
                                                              WHERE site_id = ? 
                                                              AND validite_mois = ? ");
                                      $query->execute(array($num,$periodeLicense));

                                      $query = $pdo->prepare("INSERT INTO 
                                                              corbeille(site_id,validite_mois) 
                                                              value(?,?)");
                                      $query->execute(array($num,$periodeLicense));

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