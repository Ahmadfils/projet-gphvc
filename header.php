<?php 
ob_start();
session_start();
include ("inc/config.php");
include ("inc/CSRF_Protect.php");
$csrf = new CSRF_Protect();

if(!isset($_SESSION['user'])){
  header('Location:login.php');
  exit();
}
 ?>

<!DOCTYPE html>
  <head>
    <html lang="en" >
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GPHVC</title>
    <link rel="icon" href="images/setic.png">
    <link href="plugin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="plugin/nprogress/nprogress.css" rel="stylesheet">
    <link href="../plugin/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body> 

  <script src="plugin/jquery/dist/jquery.min.js"></script>
  <script src="plugin/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
  <symbol id="bootstrap" viewBox="0 0 118 94">
   
  <symbol id="home" viewBox="0 0 16 16">
    <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
  </symbol>
  <symbol id="speedometer2" viewBox="0 0 16 16">
    <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
    <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
  </symbol>
  <symbol id="people-circle" viewBox="0 0 16 16">
    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
  </symbol>
  <symbol id="grid" viewBox="0 0 16 16">
    <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
  </symbol>
</svg>
  <header>
    <div class="px-3 py-2 text-bg-dark border-bottom bg-light">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-between">
          <a href="index.php" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
            <img src="images/seticbg.png" alt="#">
          </a>

          <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
            <li>
              <a href="index.php" class="nav-link text-secondary">
                <svg class="d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#home"/></svg>
                Home
              </a>
            </li>
            <li>
              <a href="dashboard.php" class="nav-link text-secondary">
                <svg class="d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#speedometer2"/></svg>
                Dashboard
              </a>
            </li>
            <li>
              <a href="mail.php" class="nav-link text-secondary">
                <svg class="d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#grid"/></svg>
                Messages
              </a>
            </li>
        
            <li>
              <a href="profile.php" class="nav-link text-secondary">
                <svg class="d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#people-circle"/></svg>
                Profile
              </a>
            </li>
          </ul>
  
            <?php if(!isset($_SESSION['user'])){
              echo '<div class="text-end">
              <a href="login.php"><button type="button" class="btn btn-light text-dark me-2">Login</button></a>
              <button type="button" class="btn btn-primary">Sign-up</button>
              </div>';

            } ?>

            <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto" role="search">
              <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
            </form>
           
            <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto">
              <select class="form-control">
                <option>English</option>
                <option>Francais</option>
              </select>
            </form>
          </div>
      </div>
    </div> 
  </header>