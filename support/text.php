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
                                                                                    <div class="col-lg-6 col-md-6 col-12 mb-2" id="service">
                                                                                        <label for="service" class="form-label">Service</label>
                                                                                        <div class="input-group input-group-merge">
                                                                                            <span class="input-group-text"><i class="bx bx-info-circle"></i></span>
                                                                                            <input type="text" name="service" id="service" class="form-control" value="${event.extendedProps.service}" />
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-lg-12 col-md-6 col-12 mb-2" id="note">
                                                                                        <label for="note" class="form-label">Note</label>
                                                                                        <div class="input-group input-group-merge">
                                                                                            <span class="input-group-text"><i class="bx bx-notepad"></i></span>
                                                                                            <textarea id="note" name="note" class="form-control" aria-describedby="basic-icon-default-message2">${event.extendedProps.note}</textarea>
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