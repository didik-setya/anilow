<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <script src="<?= base_url('assets/jquery/jquery.min.css') ?>"></script>
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
    <title>Login Page</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-5 col-lg-3">



                <div class="card" style="top: 30vh;">
                    <div class="card-header bg-danger text-light">
                        <h5 class="text-center">Login Page</h5>
                    </div>
                    <form action="<?= base_url('welcome/validation_login') ?>" method="post">
                        <div class="card-body">

                            <?php if ($this->session->flashdata('false')) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $this->session->flashdata('false') ?>
                                </div>
                            <?php } ?>


                            <input type="text" name="username" id="username" required class="form-control my-2" placeholder="Username">
                            <input type="password" name="password" id="password" required class="form-control my-2" placeholder="Password...">
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-sm btn-success w-100" type="submit">Login</button>
                        </div>
                    </form>
                </div>





            </div>
        </div>
    </div>
</body>

</html>