<?php require_once 'header.php';

   if(isset($_SESSION['user']['email'])){
    $email = $_SESSION['user']['email'];
    $query = $pdo->prepare("SELECT DATE_FORMAT(timestamp,'%b %Y') AS day FROM client WHERE email = ?");
    $query->execute(array($email));
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $row) {
      $date = $row['day'];
    }
   }
    


?>
<main class="container">
  <div class="d-flex align-items-center p-3 my-3 text-white bg-purple rounded shadow-sm">
    <img class="me-3" src="images/admin-icn.png" alt="" width="48" height="38">
    <div class="lh-1">
      <h1 class="h6 mb-0 text-white lh-1"><?php echo $_SESSION['user']['fullname']; ?></h1>
      <small>Since <?php echo $date; ?></small>
    </div>
  </div>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">Recent updates</h6>
    <div class="d-flex text-body-secondary pt-3">
      <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
      <p class="pb-3 mb-0 small lh-sm border-bottom">
        <strong class="d-block text-gray-dark">@admin</strong>
        Some representative placeholder content, with some information about this user. Imagine this being some sort of status update, perhaps?
      </p>
    </div>
    <div class="d-flex text-body-secondary pt-3">
      <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#e83e8c"/><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text></svg>
      <p class="pb-3 mb-0 small lh-sm border-bottom">
        <strong class="d-block text-gray-dark">@username</strong>
        Some more representative placeholder content, related to this other user. Another status update, perhaps.
      </p>
    </div>
    <div class="d-flex text-body-secondary pt-3">
      <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#6f42c1"/><text x="50%" y="50%" fill="#6f42c1" dy=".3em">32x32</text></svg>
      <p class="pb-3 mb-0 small lh-sm border-bottom">
        <strong class="d-block text-gray-dark">@username</strong>
        This user also gets some representative placeholder content. Maybe they did something interesting, and you really want to highlight this in the recent updates.
      </p>
    </div>

  </div>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">Contact de l'Assistant</h6>
    <?php  
      $query = $pdo->prepare("SELECT * FROM utilisateur WHERE id = ?");
      $query->execute(array(1));
      $stmt = $query->fetchAll(PDO::FETCH_ASSOC);
      foreach ($stmt as $row) {
        $email = $row['email'];
        $fullname = $row['prenom'];
        $tel = $row['telephone'];
    ?>
    <div class="d-flex text-body-secondary pt-3">
      <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="36" height="40" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
      <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
        <div class="d-flex justify-content-between">
          <h6 class="text-gray-dark"><?php  echo $email; ?></h6>
          <a href="#">Texter</a>
        </div>
        <span class="d-block"><?php echo '@'.$fullname; ?></span>
      </div>
    </div>
    <div class="d-flex text-body-secondary pt-3">
      <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="36" height="40" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
      <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
        <div class="d-flex justify-content-between">
          <h6 class="text-gray-dark"><?php  echo $tel; ?></h6>
          <a href="#">Copier</a>
        </div>
        <span class="d-block">@Setic</span>
      </div>
    </div>
  <?php } ?>
  </div>
  <div class="my-3 p-3 bg-body rounded shadow-sm">
  	<a href="client_logout.php"><h3><i class="fa fa-sign-out pull-left"></i>Logout</a></h3>
  </div>
</main>
<script src="js/custom.min.js"></script>

 </body>
</html>