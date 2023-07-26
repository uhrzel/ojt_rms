<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Forgot Password</title>
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
                                Forgot Password
                            </h3>
                        </div>
                        <div class="card-body">

                            <?php require_once('../components/alert.php'); ?>

                            <form method="POST" action="forgot_password_action.php">
                                <div class="form-group"><label class="small mb-1" for="email">Email</label>
                                    <input class="form-control py-4" id="email" type="text"
                                        name="email" placeholder="Enter Email" />
                                </div>
                                <div class="form-group mt-4 mb-0">
                                    <button type="submit" name="email_submit"
                                        class="btn btn-primary btn-block text-uppercase">
                                        Submit
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