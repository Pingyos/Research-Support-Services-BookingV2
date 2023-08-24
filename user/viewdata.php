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
                                                <div class="row mb-5">
                                                    <div class="col-md-6 col-lg-4 mb-3">
                                                        <div class="card h-100">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Card title</h5>
                                                                <p class="card-text">
                                                                    Some quick example text to build on the card title and make up the bulk of the card's content.
                                                                </p>
                                                                <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exLargeModal">Go somewhere</a>
                                                            </div>
                                                        </div>
                                                    </div>
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
                <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
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
                                                <input type="text" name="date" id="date" class="form-control" value="" readonly />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 mb-2">
                                            <label for="timeslot" class="form-label">Time</label>
                                            <div class="input-group input-group-merge">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-time"></i></span>
                                                <input type="text" name="timeslot" id="timeslot" class="form-control" value="" readonly />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 mb-2">
                                            <label for="title" class="form-label">title</label>
                                            <div class="input-group input-group-merge">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-purchase-tag-alt"></i></span>
                                                <input type="text" name="title" id="title" class="form-control" value="<?php echo isset($_GET['title']) ? htmlspecialchars($_GET['title']) : ''; ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 mb-2">
                                            <label for="name" class="form-label">FullName</label>
                                            <div class="input-group input-group-merge">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                <input type="text" name="name" id="name" class="form-control" value="Nest Pingyos" readonly />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 mb-2">
                                            <label for="email" class="form-label">Email</label>
                                            <div class="input-group input-group-merge">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-envelope"></i></span>
                                                <input type="text" name="email" id="email" class="form-control" value="Phatcharapon.p@cmu.ac.th" readonly />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 mb-2">
                                            <label for="tel" class="form-label">Tel</label>
                                            <div class="input-group input-group-merge">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-phone"></i></span>
                                                <input type="text" name="tel" id="tel" class="form-control" value="0987654321" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-6 col-12 mb-2">
                                            <label for="tel" class="form-label">Meeting Option</label>
                                            <div class="input-group input-group-merge">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-down-arrow-alt"></i></span>
                                                <select class="form-select" name="meeting" required id="meeting" aria-label="Default select example">
                                                    <option value="" disabled selected>Choose an option</option>
                                                    <option value="Zoom meeting">Zoom meeting</option>
                                                    <option value="Face to face meeting">Face to face meeting</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-6 col-12 mb-2">
                                            <label class="form-label" for="basic-icon-default-message">Manuscript Title</label>
                                            <div class="input-group input-group-merge">
                                                <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-comment"></i></span>
                                                <textarea id="manutitle" name="manutitle" class="form-control" placeholder="Hi" aria-describedby="basic-icon-default-message2" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>

                        </div>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- Include jQuery library -->
                        <script>
                            $(document).ready(function() {
                                $(".book").click(function() {
                                    var timeslot = $(this).data('timeslot');
                                    var urlParams = new URLSearchParams(window.location.search);
                                    var dateParam = urlParams.get('date');

                                    $("#timeslot").val(timeslot);
                                    $("#date").val(dateParam);
                                    $("#exLargeModal").modal('show');
                                });
                            });
                        </script>
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