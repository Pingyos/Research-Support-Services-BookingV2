<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">

<?php require_once 'head.php'; ?>

<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <?php require_once 'aside.php'; ?>
      <div class="layout-page">
        <?php require_once 'nav.php'; ?>
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <a href="" class="btn btn-secondary col-12">Editor English Hours(Mr.Michael Cote)</a>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-4 order-1 mb-4">
                <div class="card h-100">
                  <div class="card-header">
                    <a href="" class="btn btn-secondary col-12">Research Consult (Dr.Patompong Khaw-on)</a>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-4 order-2 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <a href="" class="btn btn-secondary col-12">Statistic Consult (Dr.Patompong Khaw-on)</a>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <?php require_once 'footer.php'; ?>
          <div class="content-backdrop fade"></div>
        </div>
      </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>

  <!-- build:js assets/vendor/js/core.js -->
  <script src="assets/vendor/libs/jquery/jquery.js"></script>
  <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script>
  <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

  <!-- Main JS -->
  <script src="assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="assets/js/dashboards-analytics.js"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>