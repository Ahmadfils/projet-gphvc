<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title">
              <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>GPHVC-Setic</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              
              <div class="profile_info">
                 <form>
                  <select id="language-selector" class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto">
                     <option value="en" <?php //if ($lang == 'en') echo 'selected;'?>selected>English</option>
                     <option value="fr" <?php //if ($lang == 'fr') echo 'selected;'?>>Francais</option>
                  </select>
                </form> 
                <script>
                  /*document.getElementById('language-selector').addEventListener('change', function() {
                      var selectedValue = this.value;
                      window.location.href = window.location.pathname + '?lang=' + selectedValue;
                  });*/
                </script> 
               </div>
              </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3><?php //echo $trad['welcome']; ?></h3>
                <ul class="nav side-menu">
                  
                  <li><a href="index.php"><i class="fa fa-home"></i> Home </a>
                  </li>
                  
                  <li><a><i class="fa fa-desktop"></i> Application <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="site_active.php">Site active</a></li>
                      <li><a href="site_absolete.php">Site Absolete</a></li>
                    </ul>
                  </li>
                  
                  <li><a><i class="fa fa-users"></i> Utilisateurs <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="personnel.php">Personnel du SETIC</a></li>
                      <li><a href="client.php"> Client</a></li>
                    </ul>
                  </li>
                 
                  <li><a href="email.php"><i class="fa fa-envelope"></i> Messages</a>
                  </li>
                  
                  <li><a><i class="fa fa-sitemap"></i> Services <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="license.php">License d'Hebergement</a></li>
                      <li><a href="certificat.php">Certificats SSL</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation</a>
                  
                  </li>

                </ul>
              </div>    
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>