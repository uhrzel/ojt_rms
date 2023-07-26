<?php
require_once('init.php');

$title = 'Profile';
$curr_page = basename(__FILE__);

?>

<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
            <div class="container-fluid">
                <div class="page-header-content">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="user"></i></div>
                        <span>Your Profile</span>
                    </h1>
                </div>
            </div>
        </div>

        <!--Start Table-->
        <div class="container-fluid mt-n10">
            <div class="card mb-4">
                <div class="card-header">Profile</div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="user-name">Name</label>
                            <input class="form-control" id="user-name" type="text"
                                value="<?= $coordinator['first_name'] . ' ' . $coordinator['last_name']; ?>" readonly />
                        </div>
                        <div class="form-group">
                            <label for="user-email">Email</label>
                            <input class="form-control" id="user-email" type="email" value="<?= $coordinator['user_email']; ?>"
                                readonly />
                        </div>
                        <div class="form-group">
                            <label for="contact-number">Contact Number</label>
                            <input class="form-control" id="contact-number" type="text"
                                value="<?= $coordinator['contact_number']; ?>" readonly />
                        </div>
                        <div class="form-group">
                            <label for="organization-name">Organization Name</label>
                            <input class="form-control" id="organization-name" type="text"
                                value="<?= $coordinator['organization_name']; ?>" readonly />
                        </div>
                        <!-- <form method="POST" action="change_password.php">
                            <div class="form-group">
                                <label for="user-password">Password</label>
                                <input class="form-control" id="user-password" name="password" type="password" />
                            </div>
                            <div class="form-group">
                                <label for="user-password">New Password</label>
                                <input class="form-control" id="user-password" name="new_password" type="password" />
                            </div>
                            <div class="form-group">
                                <label for="user-password">Confirm New Password</label>
                                <input class="form-control" id="user-password" name="confirm_new_password" type="password" />
                            </div>
                            <button class="btn btn-primary mr-2 my-1" type="submit">Change Password</button>
                        </form> -->
                    </form>
                </div>
            </div>
        </div>
        <!--End Table-->
    </main>

    <?php require_once('components/footer.php'); ?>