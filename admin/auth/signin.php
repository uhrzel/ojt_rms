<?php
error_reporting(0);
require_once('Login.class.php');

if(isset($_SESSION['admin_id']) || $_SESSION['admin_id'] == true) {
    header('Location: ../index.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];

    $login = new Login();
    $login->login($email, $password);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sign In</title>
    <link href="../../assets/css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="../../assets/img/logo.png?" />
    <script data-search-pseudo-elements defer src="../../assets/js/all.min.js"></script>
    <script src="../../assets/js/feather.min.js"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <div class="container">
                <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                    <div class="card shadow-lg border-0 rounded-lg mt-5" style="width: 340px;">
                        <div class="card-header justify-content-center">
                            <h3 class="font-weight-light my-1 font-weight-bold text-uppercase">
                                Administrator
                            </h3>
                        </div>
                        <div class="card-body">

                            <?php require_once('../components/alert.php'); ?>

                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <div class="form-group">
                                    <label class="small mb-1" for="user_email">Email</label>
                                    <input class="form-control py-4" id="user_email" type="email" name="user_email" aria-describedby="emailHelp" placeholder="Enter email address" />
                                </div>
                                <div class="form-group"><label class="small mb-1" for="user_password">Password</label>
                                    <input class="form-control py-4" id="user_password" type="password"
                                        name="user_password" placeholder="Enter password" />
                                </div>
                                <div class="form-group mt-4 mb-0">
                                    <button type="submit" name="sign_in" class="btn btn-primary btn-block text-uppercase">
                                        Sign In
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Script JS-->
    <script src="../../assets/js/jquery-3.4.1.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/scripts.js"></script>
</body>

</html>