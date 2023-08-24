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
                                                <div class="container">
                                                    <div class="wrapper">
                                                        <h1> A day in my 'sleepy' life 😅</h1>
                                                        <ul class="sessions">
                                                            <li>
                                                                <div class="time">09:00 AM</div>
                                                                <p>How is it already 9:00? Just how??? 🤯🤯</p>
                                                            </li>
                                                            <li>
                                                                <div class="time">09:05 AM</div>
                                                                <p>Few more minutes of sleep won't do anyone any harm 🤷..</p>
                                                            </li>
                                                            <li>
                                                                <div class="time">09:30 AM</div>
                                                                <p>Get up 🙄</p>
                                                            </li>
                                                            <li>
                                                                <div class="time">1:00 PM</div>
                                                                <p>How can I feel sleepy again?😵</p>
                                                            </li>
                                                            <li>
                                                                <div class="time">01:30 PM</div>
                                                                <p>Lunch time after which sleep just doesn't want to let go of me. 🤝</p>
                                                            </li>
                                                            <li>
                                                                <div class="time">3:30 PM</div>
                                                                <p>Drink the magical chai, it will ward off sleep they said. 🤷‍</p>
                                                            </li>
                                                            <li>
                                                                <div class="time">4:30 PM </div>
                                                                <p>The only time I don't feel sleepy cause it's work out time. I mean walking time. 😹</p>
                                                            </li>
                                                            <li>
                                                                <div class="time">07:00 PM </div>
                                                                <p>Food my tummy needs, sleep my body needs.👿</p>
                                                            </li>
                                                            <li>
                                                                <div class="time">07:30 PM </div>
                                                                <p>My tummy's happy time 🍝</p>
                                                            </li>
                                                            <li>
                                                                <div class="time">10:00 PM </div>
                                                                <p>uh oh!!! fuel low, get some snacks but wait should I just take a quick nap?🤓 </p>
                                                            </li>
                                                            <li>
                                                                <div class="time">2:30 PM </div>
                                                                <p>All hail! The time to sleep has finally arrived.😴😴😴😴😴 </p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <style>
                                                        h1 {
                                                            font-size: 1.1rem;
                                                            font-family: sans-serif;
                                                        }

                                                        .sessions {
                                                            margin-top: 2rem;
                                                            border-radius: 12px;
                                                            position: relative;
                                                        }

                                                        li {
                                                            padding-bottom: 1.5rem;
                                                            border-left: 1px solid #abaaed;
                                                            position: relative;
                                                            padding-left: 20px;
                                                            margin-left: 10px;
                                                        }

                                                        li:last-child {
                                                            border: 0px;
                                                            padding-bottom: 0;
                                                        }

                                                        li:before {
                                                            content: '';
                                                            width: 15px;
                                                            height: 15px;
                                                            background: white;
                                                            border: 1px solid #4e5ed3;
                                                            box-shadow: 3px 3px 0px #bab5f8;
                                                            border-radius: 50%;
                                                            position: absolute;
                                                            left: -10px;
                                                            top: 0px;
                                                        }

                                                        .time {
                                                            color: #2a2839;
                                                            font-family: 'Poppins', sans-serif;
                                                            font-weight: 500;
                                                            font-size: .9rem;
                                                            margin-bottom: .3rem;
                                                        }
                                                    </style>
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