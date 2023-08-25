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
                                        <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" title="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel4">Booking</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var calendarEl = document.getElementById('calendar');

                                                var calendar = new FullCalendar.Calendar(calendarEl, {
                                                    plugins: ['interaction', 'dayGrid'],
                                                    editable: true,
                                                    eventLimit: true,
                                                    events: [],
                                                    duration: {
                                                        days: 365
                                                    },
                                                    eventClick: function(info) {
                                                        var event = info.event;
                                                        var modal = new bootstrap.Modal(document.getElementById('exLargeModal'));
                                                        modal.show();

                                                        var modalContent = `
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel4">Booking</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form method="POST">
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-lg-6 col-md-6 col-12 mb-2">
                                                                                    <label for="name" class="form-label">Name</label>
                                                                                    <div class="input-group input-group-merge">
                                                                                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                                                                                        <input type="text" name="name" id="name" class="form-control" value="${event.extendedProps.name}" readonly />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6 col-12 mb-2">
                                                                                    <label for="email" class="form-label">Email</label>
                                                                                    <div class="input-group input-group-merge">
                                                                                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                                                                        <input type="email" name="email" id="email" class="form-control" value="${event.extendedProps.email}" readonly />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6 col-12 mb-2">
                                                                                    <label for="meeting" class="form-label">Meeting Type</label>
                                                                                    <div class="input-group input-group-merge">
                                                                                        <span class="input-group-text"><i class="bx bx-map-pin"></i></span>
                                                                                        <input type="text" name="meeting" id="meeting" class="form-control" value="${event.extendedProps.meeting}" readonly />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6 col-12 mb-2">
                                                                                    <label for="title" class="form-label">Title</label>
                                                                                    <div class="input-group input-group-merge">
                                                                                        <span class="input-group-text"><i class="bx bx-purchase-tag-alt"></i></span>
                                                                                        <input type="text" name="title" id="title" class="form-control" value="${event.title}" readonly />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 col-md-6 col-12 mb-2">
                                                                                    <label for="manutitle" class="form-label">Manuscript Title</label>
                                                                                    <div class="input-group input-group-merge">
                                                                                        <span class="input-group-text"><i class="bx bx-comment"></i></span>
                                                                                        <textarea id="manutitle" name="manutitle" class="form-control" placeholder="Hi" aria-describedby="basic-icon-default-message2" readonly>${event.extendedProps.manutitle}</textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <hr>
                                                                                <div class="row">
                                                                                    <div class="col-lg-6 col-md-6 col-12 mb-2">
                                                                                        <label for="status_user" class="form-label">Status</label>
                                                                                        <div class="input-group input-group-merge">
                                                                                            <span class="input-group-text"><i class="bx bx-down-arrow-alt"></i></span>
                                                                                                <select id="status_user" name="status_user" class="form-select" onchange="handleStatusChange()">
                                                                                                <option>Select</option>
                                                                                                <option value="1">Confirmed</option>
                                                                                                <option value="2">Cancel</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6 col-md-6 col-12 mb-2">
                                                                                        <div id="service" style="display: none;">
                                                                                            <label for="service" class="form-label">Service</label>
                                                                                            <div class="input-group input-group-merge">
                                                                                                <span class="input-group-text"><i class="bx bx-info-circle"></i></span>
                                                                                                <input type="text" name="service" id="service" class="form-control" value="" />
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12 col-md-6 col-12 mb-2" id="note"style="display: none;">
                                                                                        <label for="note" class="form-label">Note</label>
                                                                                        <div class="input-group input-group-merge" >
                                                                                            <span class="input-group-text"><i class="bx bx-notepad"></i></span>
                                                                                            <textarea id="note" name="note" class="form-control"  aria-describedby="basic-icon-default-message2" ></textarea>
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
                                                                        </div>    
                                                                        <input type="hidden" name="id" value="${event.id}" />
                                                                    </form>
                                                                `;
                                                        $('#exLargeModal .modal-content').html(modalContent);
                                                    }
                                                });

                                                <?php
                                                require_once 'connect.php';

                                                $stmt = $mysqli->prepare("SELECT id, title, date, manutitle, name, email, meeting, tel, status_user, service, note FROM booking");
                                                $stmt->execute();
                                                $result = $stmt->get_result();

                                                while ($row = $result->fetch_assoc()) {
                                                    $event = array(
                                                        'id' => $row['id'],
                                                        'title' => $row['title'],
                                                        'manutitle' => $row['manutitle'],
                                                        'name' => $row['name'],
                                                        'email' => $row['email'],
                                                        'meeting' => $row['meeting'],
                                                        'tel' => $row['tel'],
                                                        'status_user' => $row['status_user'],
                                                        'service' => $row['service'],
                                                        'note' => $row['note'],
                                                        'start' => $row['date'],
                                                        'end' => $row['date'],
                                                    );
                                                    echo "calendar.addEvent(" . json_encode($event) . ");\n";
                                                }
                                                ?>

                                                calendar.render();
                                            });
                                        </script>
                                        <?php
                                        require_once 'connect.php';

                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                            $status_user = $_POST['status_user'];
                                            $service = $_POST['service']; // รับค่า service จากฟอร์ม
                                            $note = $_POST['note']; // รับค่า note จากฟอร์ม
                                            $eventId = $_POST['id'];

                                            // เริ่มต้นคำสั่ง SQL UPDATE
                                            $stmt = $mysqli->prepare("UPDATE booking SET status_user = ?, service = ?, note = ? WHERE id = ?");
                                            $stmt->bind_param("sssi", $status_user, $service, $note, $eventId);
                                            $result = $stmt->execute(); // ทำการ execute คำสั่ง SQL UPDATE
                                            $stmt->close();

                                            // ตรวจสอบว่าการ execute สำเร็จหรือไม่และแสดงผลตามนั้น
                                            if ($result) {
                                                echo '
                                                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                                                <script>
                                                swal({
                                                    title: "Confirmed booking", 
                                                    text: "Success",
                                                    type: "success", 
                                                    timer: 2000, 
                                                    showConfirmButton: false 
                                                }, function(){
                                                    window.location.href = "index.php"; 
                                                    });
                                            </script>';
                                            } else {
                                                echo '
                                                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                                                <script>
                                                swal({
                                                title: "Booking Fail",
                                                type: "error"
                                                }, function() {
                                                window.location = "index.php";
                                                });
                                            </script>';
                                            }
                                        }
                                        ?>

                                        <script>
                                            function handleStatusChange() {
                                                var statusSelect = document.getElementById("status_user");
                                                var serviceContainer = document.getElementById("service");
                                                var noteContainer = document.getElementById("note");

                                                if (statusSelect.value === "1") {
                                                    serviceContainer.style.display = "block";
                                                    noteContainer.style.display = "block";
                                                    document.getElementById("service").querySelector("input").required = true;
                                                } else if (statusSelect.value === "2") {
                                                    serviceContainer.style.display = "none";
                                                    noteContainer.style.display = "block";
                                                    document.getElementById("service").querySelector("input").required = false;
                                                    document.getElementById("service").querySelector("input").value = "";
                                                } else {
                                                    serviceContainer.style.display = "none";
                                                    noteContainer.style.display = "none";
                                                    document.getElementById("service").querySelector("input").required = false;
                                                }

                                            }
                                        </script>
                                        <script src="../js/jquery-3.3.1.min.js"></script>
                                        <script src="../js/popper.min.js"></script>
                                        <script src="../js/bootstrap.min.js"></script>
                                        <script src='../fullcalendar/packages/core/main.js'></script>
                                        <script src='../fullcalendar/packages/interaction/main.js'></script>
                                        <script src='../fullcalendar/packages/daygrid/main.js'></script>
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