<?php
 require_once "header.php";
 require_once "sidebar.php";
 require_once "topnav.php";
 if(isset($_SESSION['message'])){
   

 }
  $query = $pdo->prepare("SELECT * FROM client ");
  $query->execute();
  $total_client = $query->rowCount();

  $query = $pdo->prepare("SELECT s.id FROM site s WHERE NOT EXISTS (SELECT site_id FROM corbeille WHERE s.id = site_id)");
  $query->execute();
  $total_site_active = $query->rowCount();

  $query = $pdo->prepare("SELECT * FROM corbeille");
  $query->execute();
  $total_site_absolete = $query->rowCount();

  $query = $pdo->prepare("SELECT * FROM license");
  $query->execute();
  $total_license = $query->rowCount();

  $query = $pdo->prepare("SELECT s.id,
                          duree_mois*30  
                          FROM site s 
                          JOIN ligne_ssl l 
                          ON s.id = site_id 
                          JOIN certificat_ssl c 
                          ON ssl_id = c.id 
                          WHERE DATEDIFF(NOW(),l.timestamp)>=?");
  $query->execute(array('duree_mois*30'));
  $total_ssl_site = $query->rowCount();

  $query = $pdo->prepare("SELECT s.id 
                          FROM site s 
                          JOIN ligne_ssl l 
                          ON s.id = site_id  
                          WHERE ssl_id = ? ");
  $query->execute(array('0'));
  $total_out1 = $query->rowCount();

  $query = $pdo->prepare("SELECT s.id 
                          FROM site s 
                          JOIN ligne_ssl l 
                          ON s.id = site_id 
                          JOIN certificat_ssl c 
                          ON ssl_id = c.id 
                          WHERE DATEDIFF(NOW(),l.timestamp)<? ");
  $query->execute(array('duree_mois*30'));
  $total_out2 = $query->rowCount();

  $query = $pdo->prepare("SELECT s.id 
                          FROM site s 
                          LEFT JOIN ligne_ssl l 
                          ON s.id = site_id 
                          WHERE NOT EXISTS (SELECT site_id FROM ligne_ssl)");
  $query->execute();
  $total_out3 = $query->rowCount();

  $total_ssl_out = $total_out1 + $total_out2 + $total_out1;



?>
 <!-- page content -->
 <div class="right_col" role="main">
  <div class="row" style="display: inline-block;" >
          <div class="tile_count">
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Clients</span>
              <div class="count"><?php echo $total_client; ?></div>
              <span class="count_bottom"><i class="green">4% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Total License</span>
              <div class="count"><?php echo $total_license; ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total active Site</span>
              <div class="count green"> <?php echo $total_site_active; ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total absolete Site</span>
              <div class="count"><?php echo $total_site_absolete; ?></div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Site SSL</span>
              <div class="count"><?php echo $total_ssl_site; ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i>Site OutSSL</span>
              <div class="count"><?php echo $total_ssl_out; ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Traffic d'Herbergement <small>active et absolete</small></h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 ">
                  <div id="chart_plot_01" class="demo-placeholder"></div>
                </div>
                <div class="col-md-3 col-sm-3  bg-white">
                  <div class="x_title">
                    <h2>Top License Performance</h2>
                    <div class="clearfix"></div>
                  </div>
                   <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>Top 5</p>
                      </th>
                      <th>
                        <div class="col-lg-7 col-md-7 col-sm-7 ">
                          <p class="">Type</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 ">
                          <p class="">Progress</p>
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <canvas class="canvasDoughnut" height="140" width="110" style="margin: 10px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>BASIQUE </p>
                            </td>
                            <td>30%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>CLASSIQUE </p>
                            </td>
                            <td>10%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>PREMIUM </p>
                            </td>
                            <td>20%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>START </p>
                            </td>
                            <td>15%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Others </p>
                            </td>
                            <td>30%</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
                  

                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
    
 </div>   
        

       
 <!-- /page content -->
        
<?php
  require_once "footer.php";
?>
        