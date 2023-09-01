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
                                                <?php
                                                require_once 'connect.php';
                                                if (isset($_GET['date'])) {
                                                    $title = $_GET['title'];
                                                    $date = $_GET['date'];
                                                    $stmt = $mysqli->prepare("select * from booking_t2 where date = ?");
                                                    $stmt->bind_param('s', $date);
                                                    $bookings = array();
                                                    if ($stmt->execute()) {
                                                        $result = $stmt->get_result();
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                $bookings[] = $row['timeslot'];
                                                            }

                                                            $stmt->close();
                                                        }
                                                    }
                                                }
                                                $duration = 60;
                                                $cleanup = 0;
                                                $start = "13:00";
                                                $end = "16:00";

                                                function timeslots($duration, $cleanup, $start, $end)
                                                {
                                                    $start = new DateTime("$start");
                                                    $end = new DateTime("$end");
                                                    $interval = new DateInterval("PT" . $duration . "M");
                                                    $cleanupInterval = new DateInterval("PT" . $cleanup . "M");
                                                    $slots = array();
                                                    for ($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)) {
                                                        $endPeriod = clone $intStart;
                                                        $endPeriod->add($interval);
                                                        if ($endPeriod > $end) {
                                                            break;
                                                        }
                                                        $slots[] = $intStart->format("H:iA") . "_" . $endPeriod->format("H:iA");
                                                    }
                                                    return $slots;
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-12 col-12 mt-2">
                                                        <?php echo isset($msg) ? $msg : ""; ?>
                                                    </div>
                                                    <?php $timeslots = timeslots($duration, $cleanup, $start, $end,);
                                                    foreach ($timeslots as $ts) {
                                                    ?>
                                                        <div class="col-md-2 col-12 mt-2">
                                                            <div class="form-group"></div>
                                                            <?php if (in_array($ts, $bookings)) { ?>
                                                                <button class="col-md-12  col-12 btn btn-secondary"><?php echo $ts; ?></button><br>
                                                            <?php } else { ?>
                                                                <button class="col-md-12 col-12 btn btn-primary book" data-bs-toggle="modal" data-bs-target="#exLargeModal" data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>
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
                                                                <div style="display: flex; justify-content: space-between;">
                                                                    <a id="offButton" class="btn btn-outline-dark" style="margin-left: auto;" href="javascript:void(0);" onclick="confirmDelete()">Off</a>
                                                                    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                                                                    <script>
                                                                        function confirmDelete() {
                                                                            swal({
                                                                                title: "Are you sure?",
                                                                                text: "Once cancel, you will not be able to recover this booking!",
                                                                                type: "warning",
                                                                                showCancelButton: true,
                                                                                confirmButtonColor: "#DD6B55",
                                                                                confirmButtonText: "Yes, cancel it!",
                                                                                cancelButtonText: "Cancel",
                                                                                closeOnConfirm: false
                                                                            }, function(isConfirm) {
                                                                                if (isConfirm) {
                                                                                    var date = document.getElementById("date").value;
                                                                                    var timeslot = document.getElementById("timeslot").value;
                                                                                    var email = document.getElementById("email").value;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "off_booking_t2.php",
                                                                                        data: {
                                                                                            date: date,
                                                                                            timeslot: timeslot
                                                                                        },
                                                                                        success: function(response) {
                                                                                            if (response === 'success') {
                                                                                                swal("Cancelled!", "Your booking has been cancelled.", "success");
                                                                                                setTimeout(function() {
                                                                                                    location.reload();
                                                                                                }, 1000);
                                                                                            } else {
                                                                                                displayErrorMessage("An error occurred while cancelling your booking. Please try again later.");
                                                                                            }
                                                                                        },
                                                                                        error: function(xhr, textStatus, errorThrown) {
                                                                                            console.log(xhr);
                                                                                            displayErrorMessage("An error occurred while cancelling your booking. Please try again later.");
                                                                                        }
                                                                                    });
                                                                                }
                                                                            });
                                                                        }
                                                                    </script>
                                                                </div>
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
                                                                    <input type="text" name="booking_id" value="<?php echo 'P-' . date('is') . '-' . (date('Y')); ?>" hidden>
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
                                            <?php
                                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                require_once 'bookingtime_t2_db.php';
                                                // echo '<pre>';
                                                // print_r($_POST);
                                                // echo '</pre>';
                                            }
                                            ?>
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
        <script src="../assets/vendor/libs/jquery/jquery.js"></script>
        <script src="../assets/vendor/libs/popper/popper.js"></script>
        <script src="../assets/vendor/js/bootstrap.js"></script>
        <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

        <script src="../assets/vendor/js/menu.js"></script>
        <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

        <script src="../assets/js/main.js"></script>

        <script src="../assets/js/dashboards-analytics.js"></script>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>