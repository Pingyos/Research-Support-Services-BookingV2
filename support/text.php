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
                                                                <div class="col-lg-12 col-md-6 col-12 mb-2">
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
                                                                        <select id="status_user" name="status_user" class="form-select">
                                                                            <option>Select</option>
                                                                            <option value="Confirmed">Confirmed</option>
                                                                            <option value="Cancel">Cancel</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div id="serviceSection" class="col-lg-6 col-md-6 col-12 mb-2" style="display: none;">
                                                                    <label for="service" class="form-label"><?= $t1['meeting']; ?></label>
                                                                    <div class="input-group input-group-merge">
                                                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-map-pin"></i></span>
                                                                        <input type="text" name="service" id="service" class="form-control" value="" />
                                                                    </div>
                                                                </div>
                                                                <div id="noteSection" class="col-lg-12 col-md-6 col-12 mb-2">
                                                                    <label class="form-label" for="basic-icon-default-message">Manuscript Title</label>
                                                                    <div class="input-group input-group-merge">
                                                                        <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-comment"></i></span>
                                                                        <textarea id="noteInput" name="note" class="form-control" placeholder="Hi" aria-describedby="basic-icon-default-message2"></textarea>
                                                                    </div>
                                                                </div>
                                                                <script>
                                                                    document.addEventListener('DOMContentLoaded', function() {
                                                                        var statusUserSelect = document.getElementById('status_user');
                                                                        var serviceSection = document.getElementById('serviceSection');
                                                                        var noteSection = document.getElementById('noteSection');

                                                                        // ซ่อนส่วนเริ่มต้นเมื่อหน้าต่างโมดัลถูกโหลด
                                                                        serviceSection.style.display = 'none';
                                                                        noteSection.style.display = 'none';

                                                                        statusUserSelect.addEventListener('change', function() {
                                                                            if (statusUserSelect.value === 'Confirmed') {
                                                                                serviceSection.style.display = 'block';
                                                                                noteSection.style.display = 'block';
                                                                            } else if (statusUserSelect.value === 'Cancel') {
                                                                                serviceSection.style.display = 'none';
                                                                                noteSection.style.display = 'block';
                                                                            } else {
                                                                                serviceSection.style.display = 'none';
                                                                                noteSection.style.display = 'none';
                                                                            }
                                                                        });
                                                                    });
                                                                </script>

                                                            </div>