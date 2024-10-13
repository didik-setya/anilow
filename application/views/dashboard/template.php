<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.1.8/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url('assets/select2/dist/css/select2.min.css') ?>">

    <script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.1.8/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('assets/select2/dist/js/select2.min.js') ?>"></script>




    <style>
        .menu-sidenav {
            padding: 5px 5px 5px 5px;
        }

        .menu-sidenav i {
            margin-left: 3px;
            margin-right: 3px;
        }
    </style>

    <title><?= $title ?></title>
</head>

<body>

    <!-- sidenav -->
    <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="staticBackdropLabel">AniLow</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body text-center">
            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary btn-sm w-100 menu-sidenav my-2"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="<?= base_url('dashboard/content') ?>" class="btn btn-outline-primary btn-sm w-100 menu-sidenav my-2"><i class="fas fa-photo-video"></i> Content</a>
            <a href="<?= base_url('dashboard/category') ?>" class="btn btn-outline-primary btn-sm w-100 menu-sidenav my-2"><i class="fas fa-gifts"></i> Category</a>
            <a href="<?= base_url('dashboard/season') ?>" class="btn btn-outline-primary btn-sm w-100 menu-sidenav my-2"><i class="fas fa-tree"></i> Season</a>
            <a href="<?= base_url('dashboard/genre') ?>" class="btn btn-outline-primary btn-sm w-100 menu-sidenav my-2"><i class="fas fa-list-ol"></i> Genre</a>
        </div>
    </div>
    <!-- end sidenav -->

    <div class="container-fluid">
        <div class="row py-3">
            <div class="col-3">
                <button class="btn btn-sm btn-success" onclick="add_data()"><i class="fa fa-plus"></i></button>
            </div>
            <div class="col-6">
                <h5 class="text-center"><?= $title ?></h5>
            </div>
            <div class="col-3 text-end">
                <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>


    <?php $this->load->view($view); ?>
    <?php $this->load->view('dashboard/mainjs'); ?>

</body>

</html>