<script>
  const ctx = document.getElementById('myChart');
  const domain = <?php echo $domainJson; ?>;
  const pourcentage = <?php echo $PourcentJson; ?>;
  const jour = <?php echo $nbrJourJson; ?>;

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: domain  ,
      datasets: [{
        label: 'Pourcentage',
        data: pourcentage,
        borderWidth: 3
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
  
  const ctx1 = document.getElementById('myChart1');
  
  new Chart(ctx1, {
    type: 'line',
    data: {
      labels: domain,
      datasets: [{
        label: 'Jours consommés',
        data: jour ,
        borderWidth: 3
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<script src="js/custom.min.js"></script>
<script src="plugin/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<script src="plugin/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="plugin/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="plugin/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="plugin/nprogress/nprogress.js"></script>