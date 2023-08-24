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
                            <div class="col-lg-12 mb-4 order-0">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <div class="col-sm-12">
                                            <div class="card-body">
                                                <div class="row">
                                                    <?php
                                                    require_once 'connect.php';
                                                    $stmt = $mysqli->prepare("SELECT * FROM booking");
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();

                                                    foreach ($result as $t1) {
                                                        $title = $t1['title'];
                                                    ?>
                                                        <div class="col-md-6 col-lg-4 mb-3">
                                                            <div class="card h-100">
                                                                <div class="card-body">
                                                                    <h5 class="card-title"><?= $t1['date']; ?> - <?= $t1['timeslot']; ?></h5>
                                                                    <p class="card-text"><?= $t1['title']; ?></p>
                                                                    <p class="card-text"><?= $t1['meeting']; ?></p>
                                                                    <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exLargeModal<?= $t1['id']; ?>">Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="exLargeModal<?= $t1['id']; ?>" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl" title="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel4">Booking</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form method="POST">
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-lg-6 col-md-6 col-12 mb-2">
                                                                                    <label for="timeslot" class="form-label">Date</label>
                                                                                    <div class="input-group input-group-merge">
                                                                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-calendar"></i></span>
                                                                                        <input type="text" name="date" id="date" class="form-control" value="<?= $t1['date']; ?>" readonly />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6 col-12 mb-2">
                                                                                    <label for="timeslot" class="form-label">Time</label>
                                                                                    <div class="input-group input-group-merge">
                                                                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-time"></i></span>
                                                                                        <input type="text" name="timeslot" id="timeslot" class="form-control" value="<?= $t1['timeslot']; ?>" readonly />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 col-md-6 col-12 mb-2">
                                                                                    <label class="form-label" for="basic-icon-default-message">Manuscript Title</label>
                                                                                    <div class="input-group input-group-merge">
                                                                                        <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-comment"></i></span>
                                                                                        <textarea id="manutitle" name="manutitle" class="form-control" placeholder="Hi" aria-describedby="basic-icon-default-message2" readonly><?= $t1['manutitle']; ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <hr>
                                                                                <div class="col-lg-6 col-md-6 col-12 mb-2">
                                                                                    <label for="timeslot" class="form-label"><?= $t1['meeting']; ?></label>
                                                                                    <div class="input-group input-group-merge">
                                                                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-broadcast"></i></span>
                                                                                        <input type="text" name="date" id="date" class="form-control" value="<?= $t1['meeting']; ?>" readonly />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6 col-12 mb-2">
                                                                                    <label for="timeslot" class="form-label">Time</label>
                                                                                    <div class="input-group input-group-merge">
                                                                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-time"></i></span>
                                                                                        <input type="text" name="timeslot" id="timeslot" class="form-control" value="<?= $t1['timeslot']; ?>" readonly />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
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

            </div>
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>


        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="../assets/vendor/libs/jquery/jquery.js"></script>
        <script src="../assets/vendor/libs/popper/popper.js"></script>
        <script src="../assets/vendor/js/bootstrap.js"></script>
        <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

        <script src="../assets/vendor/js/menu.js"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

        <!-- Main JS -->
        <script src="../assets/js/main.js"></script>

        <!-- Page JS -->
        <script src="../assets/js/dashboards-analytics.js"></script>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>