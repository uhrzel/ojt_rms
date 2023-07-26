<?php
require_once('init.php');

date_default_timezone_set('Asia/Manila');

$title = 'Attendance';
$curr_page = basename(__FILE__);

?>

<?php require_once('components/header.php'); ?>
<style>
    #qrcode-container {
        display: none;
    }

    .qrcode {
        padding: 16px;
    }

    .qrcode img {
        margin: 0 auto;
    }
</style>
<?php require_once('components/sidebar.php'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
            <div class="container-fluid">
                <div class="page-header-content">
                    <h1 class="page-header-title d-inline-block">
                        <div class="page-header-icon"><i data-feather="calendar"></i></div>
                        <span>
                            <?= $title; ?>
                        </span>
                    </h1>

                    <div class=float-right>

                        <span class="badge badge-pill badge-light badge-lg p-2">
                            <i class="fas fa-clock"></i> <?= date('l, F d, Y'); ?> - <span id="time"></span>
                        </span>

                        <script>
                            function display_c() {
                                var refresh = 1000;
                                mytime = setTimeout('display_ct()', refresh)
                            }

                            function display_ct() {
                                var strcount
                                var x = new Date()
                                var ampm = x.getHours() >= 12 ? 'PM' : 'AM';
                                hours = x.getHours() % 12;
                                hours = hours ? hours : 12;
                                minutes = x.getMinutes() < 10 ? '0' + x.getMinutes() : x.getMinutes();
                                seconds = x.getSeconds() < 10 ? '0' + x.getSeconds() : x.getSeconds();
                                var x1 = hours + ":" + minutes + ":" + seconds + " " + ampm;
                                document.getElementById('time').innerHTML = x1;
                                tt = display_c();
                            }

                            display_ct();
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <!--Table-->
        <div class="container-fluid mt-n10">
            <?php require_once('components/alert.php'); ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header d-inline-block">
                            <i class="fas fa-table mr-1"></i>
                            Attendance List

                            <div class="float-right">
                                <a href="attendance.php" class="btn btn-primary btn-sm mr-2">
                                    <i class="fas fa-sync-alt"></i> Refresh
                                </a>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#generateQRCodeModal">
                                    <i class="fas fa-check"></i> Check Attendance
                                </button>
                            </div>
                        </div>


                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="dataTable_" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Date</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                            <th>Log
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($attendances as $attendance) : ?>
                                        <tr>
                                            <td><?= $attendance['first_name'] . ' ' . $attendance['last_name']; ?></td>
                                            <td><?= $attendance['attendance_date']; ?></td>
                                            <td><?= $attendance['attendance_time_in']; ?></td>
                                            <td><?= $attendance['attendance_time_out']; ?></td>
                                            <td><?= $attendance['attendance_log']; ?></td>
                                            <td>
                                                <a href="attendance_delete.php?attendance_id=<?= $attendance['attendance_id']; ?>"
                                                    class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Generate QR Code Modal -->
                <div class="modal fade" id="generateQRCodeModal" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" role="dialog" aria-labelledby="generateQRCodeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="generateQRCodeModalLabel">Generate QR Code</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                    <div id="qrcode-container">
                                        <div id="qrcode" class="card border-0 qrcode"></div>
                                    </div>

                                    <input type="hidden" id="coordinator_id" name="coordinator_id"
                                        value="<?= $coordinator['coordinator_id']; ?>">
                                    <input type="hidden" id="organization_id" name="organization_id"
                                        value="<?= $coordinator['organization_id']; ?>">
                                    <button type="button" onclick="generateQRCode()"
                                        class="card-footer bg-primary btn btn-primary btn-block">
                                        Generate QR Code
                                    </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Table-->



            <script type="text/javascript">
                function generateQRCode() {
                    let date = new Date();
                    let hours = date.getHours();
                    let minutes = date.getMinutes();
                    let ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12;
                    minutes = minutes < 10 ? '0' + minutes : minutes;
                    let time = hours + ":" + minutes + " " + ampm;

                    let attendance_date = new Date().toLocaleDateString('en-PH', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });

                    let attendance_time = time;

                    let coordinator_id = $('#coordinator_id').val();
                    let organization_id = $('#organization_id').val();

                    let qrcodeContainer = document.getElementById("qrcode");
                    qrcodeContainer.innerHTML = "";

                    let text =
                        `coordinator_id=${coordinator_id}&organization_id=${organization_id}&attendance_date=${attendance_date}&attendance_time=${attendance_time}`;

                    new QRCode(qrcodeContainer, {
                        text: text,
                        width: 256,
                        height: 256,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });

                    document.getElementById("qrcode-container").style.display = "block";
                }
            </script>

            <!-- create task modal -->
            <div class="modal fade" id="createTaskModal" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="createTaskModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <form method="POST" action="task_create.php">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createTaskModalLabel">Create task</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="user_id" value="<?=$user_id; ?>">
                                <input type="hidden" name="organization_id"
                                    value="<?=$organization['organization_id']; ?>">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="task_name">Name</label>
                                            <input type="text" class="form-control" id="task_name" name="task_name"
                                                placeholder="Enter task Name" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="task_deadline">Deadline (Optional) </label>
                                            <input type="date" class="form-control" id="task_deadline"
                                                name="task_deadline" placeholder="Enter task Deadline" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="task_description">Description</label>
                                            <textarea class="form-control" id="task_description" rows="3"
                                                name="task_description" placeholder="Enter task Description"
                                                required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" name="create_task" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end create task modal -->

    </main>

    <?php require_once('components/footer.php'); ?>