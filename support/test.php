<?php
require_once 'connect.php';

// กำหนดจำนวนรายการที่ต้องการแสดงต่อหน้า
$itemsPerPage = 10; // เปลี่ยนตามความต้องการ

$searchTitle1 = $row['title1'];
$searchTitle2 = $row['title2'];
$searchTitle3 = $row['title3'];

// คำนวณจำนวนข้อมูลทั้งหมด
$stmtCount = $mysqli->prepare("SELECT COUNT(*) FROM booking WHERE title = ? OR title = ? OR title = ?");
$stmtCount->bind_param("sss", $searchTitle1, $searchTitle2, $searchTitle3);
$stmtCount->execute();
$resultCount = $stmtCount->get_result();
$totalItems = $resultCount->fetch_assoc()['COUNT(*)'];

// คำนวณจำนวนหน้าทั้งหมด
$totalPages = ceil($totalItems / $itemsPerPage);

// กำหนดหน้าปัจจุบัน (โดยสามารถรับค่ามาจากการรีเควสหรือตามความต้องการ)
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// คำนวณข้อมูลที่จะแสดงบนหน้าปัจจุบัน
$offset = ($currentPage - 1) * $itemsPerPage;

// ดึงข้อมูลจากฐานข้อมูลโดยใช้ LIMIT เพื่อแบ่งหน้า
$stmt = $mysqli->prepare("SELECT * FROM booking WHERE title = ? OR title = ? OR title = ? ORDER BY id DESC LIMIT ?, ?");
$stmt->bind_param("sssss", $searchTitle1, $searchTitle2, $searchTitle3, $offset, $itemsPerPage);
$stmt->execute();
$result = $stmt->get_result();
?>

<!-- แสดงข้อมูลและ pagination -->
<div class="card-body">
    <div class="row">
        <?php foreach ($result as $t1) {
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
                        <p class="card-text"><?= $t1['name']; ?> / <?= $t1['title']; ?></p>
                        <p class="card-text"><b><?= $t1['meeting']; ?> : <?= $t1['service']; ?></b></p>
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#exLargeModal<?= $t1['id']; ?>">Details</a>
                            <p class="card-text" style="font-size: 12px;">
                                Date: <?= date('Y-m-d', strtotime($t1['dateCreate'])); ?><br>
                                Time: <?= date('H:i:s', strtotime($t1['dateCreate'])); ?>
                            </p>
                            <?php if ($canCancel) { ?>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal<?= $t1['id']; ?>">Cancel</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item first">
                <a class="page-link" href="?page=1"><i class="tf-icon bx bx-chevrons-left"></i></a>
            </li>
            <li class="page-item prev">
                <a class="page-link" href="?page=<?php echo max(1, $currentPage - 1); ?>"><i class="tf-icon bx bx-chevron-left"></i></a>
            </li>
            <?php for ($page = 1; $page <= $totalPages; $page++) { ?>
                <li class="page-item <?php if ($page == $currentPage) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                </li>
            <?php } ?>
            <li class="page-item next">
                <a class="page-link" href="?page=<?php echo min($totalPages, $currentPage + 1); ?>"><i class="tf-icon bx bx-chevron-right"></i></a>
            </li>
            <li class="page-item last">
                <a class="page-link" href="?page=<?php echo $totalPages; ?>"><i class="tf-icon bx bx-chevrons-right"></i></a>
            </li>
        </ul>
    </nav>
</div>