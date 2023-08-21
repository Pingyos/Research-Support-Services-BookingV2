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
                            <div class="col-md-12 col-lg-4 col-xl-12 order-0 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div id='calendar'></div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var calendarEl = document.getElementById('calendar');

                                                var calendar = new FullCalendar.Calendar(calendarEl, {
                                                    plugins: ['interaction', 'dayGrid'],
                                                    editable: true,
                                                    eventLimit: true,
                                                    events: [

                                                    ],
                                                    duration: {
                                                        days: 365
                                                    }
                                                });
                                                calendar.render();
                                            });
                                        </script>

                                        <script src="js/jquery-3.3.1.min.js"></script>
                                        <script src="js/popper.min.js"></script>
                                        <script src="js/bootstrap.min.js"></script>
                                        <script src='fullcalendar/packages/core/main.js'></script>
                                        <script src='fullcalendar/packages/interaction/main.js'></script>
                                        <script src='fullcalendar/packages/daygrid/main.js'></script>
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


    <div class="buy-now">
        <a href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/" target="_blank" class="btn btn-danger btn-buy-now">Upgrade to Pro</a>
    </div>

    <!-- Core JS -->
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