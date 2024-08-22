<?php 
include 'header.php';
 
 $user = $_SESSION['user']['id'];
 $query = $pdo->prepare('SELECT email FROM utilisateur WHERE id = ?');
 $query->execute(array(1));
 $data = $query->fetchAll(PDO::FETCH_ASSOC);
 foreach($data as $row){
    $email = $row['email'];
 }
 $query = $pdo->prepare("SELECT s.id AS id,
                        fullname AS nom,
                        domaine,
                        webmail,
                        s.date_license AS temps,
                        lic.duree_mois*30 AS periode
                        FROM client cl 
                        INNER JOIN site s
                        ON client_id = cl.id
                        INNER JOIN license lic
                        ON lic.id = license_id WHERE client_id = ?");                                                                                   
 $query->execute(array($user));
 $data = $query->fetchAll(PDO::FETCH_ASSOC);
 $domainlist = []; 
 $Pourcentlist = [];                              
 foreach ($data as $row) {
   $num = $row['id'];
   $proprietaire = $row['nom'];
   $domaine = $row['domaine'];
   $timeLicense = $row['temps'];
   $periodeLicense = $row['periode'];
   $mail =$row['webmail'];

   $dateActuelle = new DateTime('2024-10-04 16:19:36');
   $dateAncienne = new DateTime($timeLicense);
   $difference = $dateActuelle->diff($dateAncienne);
   $nbrJours = $difference->days;
   $nbrJoursRestant = $periodeLicense-$nbrJours;
   $jourAccumuleEnPourcentage = ($nbrJours*100)/$periodeLicense;
   $PourcentageFormate = round($jourAccumuleEnPourcentage, 2);
   
   if($PourcentageFormate >= 50 && $PourcentageFormate <= 53){
   	echo "<script>
            window.onload = function() {
                Toastify({
                    text: 'La licence de {$domaine} a deja atteint la moitie, ca reste {$nbrJoursRestant} jour(s)',
                    duration: 5000,
                    close: true,
                    position: 'right',
                    style: {
                        background: 'rgba(255, 193, 7, 0.8)',
                        color: '#856404', 
                     },
                }).showToast();
            };
        </script>";
   
   }
   
   if($nbrJoursRestant <= 32 && $nbrJoursRestant >= 31){
    echo "<script>
            window.onload = function() {
                Toastify({
                    text: 'Bientot, va rester 1 mois pour la licence de {$domaine}',
                    duration: 5000,
                    close: true,
                    position: 'right',
                    style: {
                        background: 'rgba(255, 193, 7, 0.8)',
                        color: '#856404', 
                     },
                }).showToast();
            };
        </script>";

   }
   if($nbrJoursRestant <= 30 && $nbrJoursRestant >= 25){
    echo "<script>
            window.onload = function() {
                Toastify({
                    text: 'Vous etes dans votre dernier de la licence de {$domaine}',
                    duration: 5000,
                    close: true,
                    position: 'right',
                    style: {
                        background: 'rgba(255, 193, 7, 0.8)',
                        color: '#856404', 
                     },
                }).showToast();
            };
        </script>";

   }

   if($nbrJoursRestant <= 7 && $nbrJoursRestant >= 5){
    echo "<script>
            window.onload = function() {
                Toastify({
                    text: 'Nous avons atteint la derniere semaine de la licence de {$domaine}',
                    duration: 5000,
                    close: true,
                    position: 'right',
                    style: {
                        background: 'rgba(255, 193, 7, 0.8)',
                        color: '#856404', 
                     },
                }).showToast();
            };
        </script>";

   }
   if($nbrJoursRestant <= 2 && $nbrJoursRestant >= 1){
    echo "<script>
            window.onload = function() {
                Toastify({
                    text: 'Ca reste un jour pour l'expiration du license de {$domaine}',
                    duration: 5000,
                    close: true,
                    position: 'right',
                    style: {
                        background: 'rgba(220, 53, 69, 0.8)',
                        color: '#721c24', 
                     },
                }).showToast();
            };
        </script>";

   }
   if($nbrJoursRestant == 0){
    echo "<script>
            window.onload = function() {
                Toastify({
                    text: 'La license de {$domaine} va expire aujourd'hui',
                    duration: 5000,
                    close: true,
                    position: 'right',
                    style: {
                        background: 'rgba(220, 53, 69, 0.8)',
                        color: '#721c24', 
                     },
                }).showToast();
            };
        </script>";
   }
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
                        background: 'rgba(23, 162, 184, 0.4)',
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
                        background: 'rgba(23, 162, 184, 0.4)',
                        color: '#0c5460', 
                     },
                }).showToast();
            };
        </script>";
        unset($_SESSION['message_del']); 
    }
    
?>
<div class="container container-dash">
    <h1><i class="fa fa-dashboard"></i>Dashboard</h1>
    <div class="col-dash">
      <div class="col-6">
        <span><h2>1.Période d'hébergement(%)</h2></span>
        <canvas id="myChart"></canvas> 
      </div>
        <div class="col-6">
            <span><h2>2.Validité de certificat SSL</h2></span>
            <canvas id="myChart1"></canvas> 
        </div>  
    </div>
    <div class="dash-table">
        <div class="table-header">
            <h1><i class="fa fa-table"></i>Informations pour chaque site</h1>
        </div>
        <table id="datatable" class="table table-striped">
         <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Domaine</th>
            <th scope="col">WebMail</th>
            <th scope="col">Hebergement</th>
            <th scope="col">Certificat SSL</th>
            <th scope="col">Date d'expiration</th>
            <th scope="col">Action</th>
          </tr>
          </thead>
          <tbody>  
            <?php 
             
            foreach ($data as $value) {
              $numero = $value['id'];
              $proprietaire1 = $value['nom'];
              $domain = $value['domaine'];
              $domainlist[] = $value['domaine'];
              $timeLicense1 = $value['temps'];
              $periodeLicense1 = $value['periode'];
              $webmail = $value['webmail'];  

              $dateActuelle = new DateTime('2024-10-04 16:19:36');
              $dateAncienne1 = new DateTime($timeLicense1);
              $difference1 = $dateActuelle->diff($dateAncienne1);
              $nbrJours1 = $difference1->days;
              $nbrJoursRestant1 = $periodeLicense1-$nbrJours;
              $jourAccumuleEnPourcentage1 = ($nbrJours1*100)/$periodeLicense1;
              $PourcentageFormate1 = round($jourAccumuleEnPourcentage1, 2);
              $Pourcentlist[] = round($PourcentageFormate1,1);
             ?>
          <tr>
            <th scope="row"><?php echo $numero; ?></th>
            <td><?php echo $domain;?>
                <br>
                <small>crée le <?php echo $timeLicense1;  ?></small>
            </td>
            <td><?php echo $webmail; ?></td>
            <td class="project_progress">  
             <div class="progress progress_sm">
               <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $PourcentageFormate1; ?>"></div>
            </div>
            <?php if($nbrJours > $periodeLicense1 ){
                echo '<small class="text-danger">
                       Le site a deja depassé sa periode d\'hebergement('.$periodeLicense1.' jours)
                      </small>';
                }
                  else{
                       echo '<small>'.
                              $PourcentageFormate1.'%( '.$nbrJours1.' jours sur '.$periodeLicense1.' jours)
                            </small>';
               } ?>
               
            </td>
            
               <?php  
                $query = $pdo->prepare("SELECT
                                        ce.duree_mois*30 AS ssl_periode,
                                        li.timestamp AS date_ligne
                                        FROM ligne_ssl li 
                                        INNER JOIN certificat_ssl ce
                                        ON ce.id = ssl_id
                                        WHERE  site_id = ? LIMIT 1");
                 $query->execute(array($numero));
                 $total = $query->rowCount();
                 $result = $query->fetchAll(PDO::FETCH_ASSOC);
                  if ($total == 0) {
                    echo '<td>
                     <span class="badge badge-danger" style>Pas de SSL</span>
                       </td>';
                     }else{

                      foreach ($result as $value) {
                                             
                        $timeSSL =$value['date_ligne'];
                        $periodeSSL = $value['ssl_periode'];                
                                                 
                         $dateAncienneSSL = new DateTime($timeSSL);
                         $diffSSL = $dateActuelle->diff($dateAncienneSSL);
                         $nbrJoursSSL = $diffSSL->days;
                         $nbrJourSSL[] = $nbrJoursSSL;
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


                     } ?>
           
            <td> <span>
                 Licence: <?php 
                 $licenceTimestamp = strtotime($timeLicense1);
                 echo date('Y-m-d H:i:s', strtotime('+'.$periodeLicense1.' days', $licenceTimestamp));
                 ?>
                 </span>
                <br/>
                <?php 
                    
                  if($nbrJoursSSL <= $periodeSSL){
                    $SSLTimestamp = strtotime($timeSSL);
                    echo '<span>SSL: '.date('Y-m-d H:i:s', strtotime('+'.$periodeSSL.' days', $SSLTimestamp)).'   </span>';
                  }
                  
                ?> 
            </td>
            <td>
            <?php 
                if($nbrJours1 > $periodeLicense1){
                   echo '<a href="#" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>Reactiver</a>';
                }else{
                 echo '<a href="https://'.$domaine.'" target="_blank" class="btn btn-primary btn-xs">
                 <i class="fa fa-eye"></i> View </a>';
                }
                  
             ?>
            <a href="edit_client_site.php?id=<?php echo $numero;?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
            <a onclick="confirm('Etes-vous sur de supprimer <?php echo $domain; ?>')" href="delete_client_site.php?id=<?php echo $numero;?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
            </td>
          </tr>
          </tbody>
         <?php } 
           $domain_vide = array(" ");
           $domain_fusionne = array_merge($domain_vide,$domainlist);
           $domainJson = json_encode($domain_fusionne);

           $Pourcent_vide = array(0);
           $Pourcent_fusionne = array_merge($Pourcent_vide,$Pourcentlist);
           $PourcentJson = json_encode($Pourcent_fusionne);
            
           $nbrJour_vide = array(0);
           $nbrJour_fusionne = array_merge($nbrJour_vide,$nbrJourSSL);
           $nbrJourJson = json_encode($nbrJour_fusionne); 

           
         ?>
        </table>
    </div>
</div>

<?php include 'footer1.php'; ?>

