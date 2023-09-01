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
                                        <div class="row">
                                            <?php
                                            require_once 'connect.php';
                                            $stmt = $mysqli->prepare("SELECT * FROM booking ORDER BY id DESC");
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            foreach ($result as $t1) {
                                                $title = $t1['title'];


                                                $bgColor = '';
                                                if ($t1['status_user'] == 0) {
                                                    $bgColor = '#f5f5f5'; // สีเทา
                                                } else if ($t1['status_user'] == 1) {
                                                    $bgColor = '#EAFAF1'; // สีเขียวอ่อน
                                                } else if ($t1['status_user'] == 2) {
                                                    $bgColor = '#FBEEE6'; // สีส้มอ่อน
                                                }
                                                $status_user = $t1['status_user'];
                                                $canCancel = $status_user != 1 && $status_user != 2;

                                            ?>
                                                <div class="col-md-6 col-lg-4 mb-3">
                                                    <div class="card h-100" style="background-color: <?php echo $bgColor; ?>">
                                                        <div class="card-body">
                                                            <p class="card-text">Booking id <?= $t1['booking_id']; ?></p>
                                                            <h5 class="card-title"><?= $t1['date']; ?> - <?= $t1['timeslot']; ?></h5>
                                                            <p class="card-text"><?= $t1['name']; ?> / <?= $t1['title']; ?></p>
                                                            <p class="card-text"><?= $t1['meeting']; ?> (<?= $t1['service']; ?>)</p>
                                                            <a class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#exLargeModal<?= $t1['id']; ?>">Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php foreach ($result as $t1) { ?>
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
                                                                    <div class="col-lg-6 col-md-6 col-12 mb-2">
                                                                        <label for="title" class="form-label">title</label>
                                                                        <div class="input-group input-group-merge">
                                                                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-purchase-tag-alt"></i></span>
                                                                            <input type="text" name="title" id="title" class="form-control" value="<?= $t1['title']; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6 col-12 mb-2">
                                                                        <label for="name" class="form-label">FullName</label>
                                                                        <div class="input-group input-group-merge">
                                                                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                                            <input type="text" name="name" id="name" class="form-control" value="<?= $t1['name']; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6 col-12 mb-2">
                                                                        <label for="email" class="form-label">Email</label>
                                                                        <div class="input-group input-group-merge">
                                                                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-envelope"></i></span>
                                                                            <input type="text" name="email" id="email" class="form-control" value="<?= $t1['email']; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6 col-12 mb-2">
                                                                        <label for="meeting" class="form-label">meeting</label>
                                                                        <div class="input-group input-group-merge">
                                                                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-phone"></i></span>
                                                                            <input type="text" name="meeting" id="meeting" class="form-control" value="<?= $t1['meeting']; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 col-md-12 col-12 mb-2">
                                                                        <label class="form-label" for="basic-icon-default-message">Manuscript Title</label>
                                                                        <div class="input-group input-group-merge">
                                                                            <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-comment"></i></span>
                                                                            <textarea id="manutitle" name="manutitle" class="form-control" placeholder="Hi" aria-describedby="basic-icon-default-message2" readonly><?= $t1['manutitle']; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="col-lg-6 col-md-6 col-12 mb-2">
                                                                        <label for="status_user" class="form-label">Status</label>
                                                                        <div class="input-group input-group-merge">
                                                                            <span class="input-group-text"><i class="bx bx-down-arrow-alt"></i></span>
                                                                            <select id="status_user" name="status_user" class="form-select status-user-select">
                                                                                <option><?= $t1['status_user']; ?></option>
                                                                                <option value="1">Confirmed</option>
                                                                                <option value="2">Cancel</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6 col-12 mb-2 service-section" style="display: none;">
                                                                        <label for="service" class="form-label"><?= $t1['meeting']; ?></label>
                                                                        <div class="input-group input-group-merge">
                                                                            <span class="input-group-text"><i class="bx bx-map-pin"></i></span>
                                                                            <input type="text" name="service" class="form-control" value="<?= $t1['service']; ?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 col-md-12 col-12 mb-2 note-section" style="display: none;">
                                                                        <label class="form-label" for="basic-icon-default-message">Manuscript Title</label>
                                                                        <div class="input-group input-group-merge">
                                                                            <span class="input-group-text"><i class="bx bx-comment"></i></span>
                                                                            <textarea name="note" class="form-control" placeholder="Hi"><?= $t1['note']; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <script>
                                                                        document.addEventListener('DOMContentLoaded', function() {
                                                                            var modalContainer = document.getElementById('exLargeModal<?= $t1['id']; ?>');
                                                                            var statusUserSelect = modalContainer.querySelector('.status-user-select');
                                                                            var serviceSection = modalContainer.querySelector('.service-section');
                                                                            var noteSection = modalContainer.querySelector('.note-section');
                                                                            var serviceInput = serviceSection.querySelector('input[name="service"]');

                                                                            // ซ่อนส่วนเริ่มต้นเมื่อหน้าต่างโมดัลถูกโหลด
                                                                            serviceSection.style.display = 'none';
                                                                            noteSection.style.display = 'none';
                                                                            serviceInput.removeAttribute('required');

                                                                            statusUserSelect.addEventListener('change', function() {
                                                                                if (statusUserSelect.value === '1') {
                                                                                    serviceSection.style.display = 'block';
                                                                                    noteSection.style.display = 'block';
                                                                                    serviceInput.setAttribute('required', 'required');
                                                                                } else if (statusUserSelect.value === '2') {
                                                                                    serviceSection.style.display = 'none';
                                                                                    noteSection.style.display = 'block';
                                                                                    serviceInput.removeAttribute('required');
                                                                                    serviceInput.value = ''; // กำหนดค่าว่างให้กับฟิลด์ service
                                                                                } else {
                                                                                    serviceSection.style.display = 'none';
                                                                                    noteSection.style.display = 'none';
                                                                                    serviceInput.removeAttribute('required');
                                                                                }
                                                                            });

                                                                            // เรียกฟังก์ชันเช็คเงื่อนไขเริ่มต้นเมื่อหน้าเว็บโหลดเสร็จ
                                                                            checkInitialConditions();

                                                                            // ฟังก์ชันเช็คเงื่อนไขเริ่มต้น
                                                                            function checkInitialConditions() {
                                                                                if (statusUserSelect.value === '1') {
                                                                                    serviceSection.style.display = 'block';
                                                                                    noteSection.style.display = 'block';
                                                                                    serviceInput.setAttribute('required', 'required');
                                                                                } else if (statusUserSelect.value === '2') {
                                                                                    serviceSection.style.display = 'none';
                                                                                    noteSection.style.display = 'block';
                                                                                    serviceInput.removeAttribute('required');
                                                                                    serviceInput.value = ''; // กำหนดค่าว่างให้กับฟิลด์ service
                                                                                }
                                                                            }
                                                                        });
                                                                    </script>
                                                                    <input type="hidden" name="id" value="<?= $t1['id']; ?>">
                                                                    <input type="hidden" name="dateCreate" value="<?= date('Y-m-d H:i:s'); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                        <?php
                                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                            require_once 'index-db.php';
                                                            echo '<pre>';
                                                            print_r($_POST);
                                                            echo '</pre>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
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