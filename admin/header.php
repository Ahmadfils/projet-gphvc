<?php  
ob_start();
session_start();
include("../inc/config.php");
include("../inc/CSRF_Protect.php");
$csrf = new CSRF_Protect();

if(!isset($_SESSION['user'])){
  header('Location:login.php');
  exit();
}

/*$lang = 'en';

if(isset($_GET['lang'])){
   $lang = $_GET['lang'];
   $query = $pdo->prepare("SELECT 
                         t.lang_key AS cle,
                         t.value AS value
                         FROM traductions t 
                         JOIN languages l 
                         ON lang_id = l.id WHERE code = ?");
 $query->execute(array($lang));
 $result = $query->fetchAll(PDO::FETCH_ASSOC);
 $trad = array();
 foreach ($result as $row) {
   $trad[$row['cle']] = $row['value'];
 }
}else{
  $lang = 'en';
}*/

?>

<!DOCTYPE html>
<html lang="<?php //echo $lang; ?>en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GPHVC</title>
    <link rel="icon" href="../images/setic.png">
    <!-- Bootstrap -->
    <link href="../plugin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../plugin/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../plugin/iCheck/skins/flat/green.css" rel="stylesheet">
     <!-- FullCalendar -->
    <link href="../plugin/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="../plugin/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
    <!-- Datatables -->
    <link href="../plugin/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../plugin/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../plugin/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../plugin/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!-- Custom Theme Style -->
    <link href="../css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div id="content-body" class="container body">
      <div class="main_container">
      