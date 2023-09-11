<div class="col-sm-12">
    <div class="card-body">
        <div class="row">
            <?php
            $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $items_per_page = 9; // จำนวนรายการที่แสดงในแต่ละหน้า
            $offset = ($current_page - 1) * $items_per_page;

            require_once 'connect.php';
            $stmt = $mysqli->prepare("SELECT * FROM booking  ORDER BY dateCreate DESC LIMIT ?, ?");
            $stmt->bind_param("ii", $offset, $items_per_page);
            $stmt->execute();
            $result = $stmt->get_result();

            // คำนวณค่า $total_items และ $total_pages โดยใช้สูตรด้านบน
            $total_items = $result->num_rows;
            $total_pages = ceil($total_items / $items_per_page);

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
                            <h5 class="card-title">
                                <?= strftime('%d %B %Y', strtotime($t1['date'])); ?> | <?= $t1['timeslot']; ?>
                            </h5>
                            <p class="card-text"><?= $t1['name']; ?> | <?= $t1['title']; ?></p>
                            <p class="card-text"><?= $t1['meeting']; ?> |<?= $t1['service']; ?></p>
                            <a class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#exLargeModal<?= $t1['id']; ?>">Details</a>
                            <?php if ($canCancel) : ?>
                                <a class="btn btn-danger text-white" href="javascript:void(0);" onclick="confirmDelete('<?= $t1['booking_id']; ?>')">Cancel</a>
                                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

                                <script>
                                    function confirmDelete(bookingId) {
                                        swal({
                                                title: "Are you sure?",
                                                text: "you want to cancel this booking? Once cancelled, it cannot be recovered.",
                                                type: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#DD6B55",
                                                confirmButtonText: "Yes, cancel it!",
                                                cancelButtonText: "No",
                                                closeOnConfirm: false
                                            },
                                            function(isConfirm) {
                                                if (isConfirm) {
                                                    window.location = "delbooking.php?booking_id=" + bookingId;
                                                }
                                            });
                                    }
                                </script>

                            <?php endif; ?>
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
                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-navigation"></i></span>
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
                                                <input type="text" name="status_user" class="form-control" value="<?php
                                                                                                                    if ($t1['status_user'] == "'") {
                                                                                                                        echo "Pending";
                                                                                                                    } elseif ($t1['status_user'] == 1) {
                                                                                                                        echo "Confirmed";
                                                                                                                    } elseif ($t1['status_user'] == 2) {
                                                                                                                        echo "Cancel Booking";
                                                                                                                    } else {
                                                                                                                        echo "Pending"; // กรณีอื่น ๆ
                                                                                                                    }
                                                                                                                    ?>" readonly />
                                            </div>
                                        </div>
                                        <?php if (!empty($t1['service'])) : ?>
                                            <div class="col-lg-6 col-md-6 col-12 mb-2 service-section">
                                                <label for="service" class="form-label"><?= $t1['meeting']; ?></label>
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"><i class="bx bx-map-pin"></i></span>
                                                    <input type="text" name="service" class="form-control" value="<?= $t1['service']; ?>" readonly />
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($t1['note'])) : ?>
                                            <div class="col-lg-12 col-md-12 col-12 mb-2 note-section">
                                                <label class="form-label" for="basic-icon-default-message">Manuscript Title</label>
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"><i class="bx bx-comment"></i></span>
                                                    <textarea name="note" class="form-control" placeholder="Hi" readonly><?= $t1['note']; ?></textarea>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </form>
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // require_once 'index-db.php';
                                echo '<pre>';
                                print_r($_POST);
                                echo '</pre>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=1"><i class="tf-icon bx bx-chevrons-left"></i></a>
                </li>
                <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo max(1, $current_page - 1); ?>"><i class="tf-icon bx bx-chevron-left"></i></a>
                </li>
                <?php
                for ($page = 1; $page <= $total_pages; $page++) {
                ?>
                    <li class="page-item <?php echo ($page == $current_page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                    </li>
                <?php
                }
                ?>
                <li class="page-item <?php echo ($current_page == $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo min($total_pages, $current_page + 1); ?>"><i class="tf-icon bx bx-chevron-right"></i></a>
                </li>
                <li class="page-item <?php echo ($current_page == $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $total_pages; ?>"><i class="tf-icon bx bx-chevrons-right"></i></a>
                </li>
            </ul>
        </nav>
    </div>
</div>