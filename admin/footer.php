
       <footer>
          <div class="pull-right">
           GPHVC-Setic developped by Abasi & Eddy. <a href="#"><b>Portfolio</b></a>
          </div>
          <div class="clearfix"></div>
        </footer>
       
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="../plugin/jquery/dist/jquery.min.js"></script>
    <script src="../plugin/bootstrap/dist/js/bootstrap.bundle.min.js"></script>    
    <script src="../plugin/nprogress/nprogress.js"></script>
    <script src="../plugin/Chart.js/dist/Chart.min.js"></script>
    <script src="../plugin/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="../plugin/Flot/jquery.flot.js"></script>
    <script src="../plugin/Flot/jquery.flot.time.js"></script>
    <script src="../plugin/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../plugin/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../plugin/flot.curvedlines/curvedLines.js"></script>
    <script src="../plugin/DateJS/build/date.js"></script>

    <!-- Datatables -->
    <script src="../plugin/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../plugin/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../plugin/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../plugin/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../plugin/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugin/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../plugin/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../js/custom.min.js"></script>
    <script type="text/javascript">
    const checkboxOui = document.getElementById('oui');
    const checkboxNon = document.getElementById('non');
    const inputInst = document.getElementById('inst');

    checkboxOui.addEventListener('change', function() {
        if(checkboxOui.checked){
            inputInst.value = '';
            inputInst.disabled = false;
            checkboxNon.checked = false;
        }else{
            inputInst.value = 'NaN';
            inputInst.disabled = true;
            checkboxOui.checked = false;
        }
    });

    checkboxNon.addEventListener('change', function() {
        if(checkboxNon.checked){
            inputInst.value = 'NaN';
            inputInst.disabled = true;
            checkboxOui.checked = false;
        }else{
            inputInst.value = '';
            inputInst.disabled = false;
            checkboxNon.checked = true;
        }
    
    });
    
</script>
  </body>
</html>