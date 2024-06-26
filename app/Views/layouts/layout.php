<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    
    <title>SIAE Web | <?= $this->renderSection('title') ?></title>
    
    <link href="<?php echo base_url(); ?>Assets/css/styles.css" rel="stylesheet" />

    <?= $this->renderSection('css') ?>

    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

    <!-- sweetalert 2 -->
    <link rel="stylesheet" href="<?= base_url() ?>Assets/plugins/node_modules/sweetalert2/dist/sweetalert2.min.css">
    <script src="<?= base_url() ?>Assets/plugins/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <!-- jquery-ui -->
    <link rel="stylesheet" href="<?= base_url() ?>Assets/plugins/jquery-ui/jquery-ui.css">

    <script src="<?= base_url() ?>Assets/js/jquery-3.7.0.min.js"></script>
    <!-- jquery-ui -->
    <script src="<?= base_url() ?>Assets/plugins/jquery-ui/jquery-ui.js"></script>

    <!-- Toastr -->
	<link rel="stylesheet" href="<?= base_url() ?>Assets/plugins/toastr/toastr.min.css">
	<script src="<?= base_url() ?>Assets/plugins/toastr/toastr.min.js"></script>

    <!-- Select 2 -->
    <link rel="stylesheet" href="<?= base_url() ?>Assets/plugins/select2/select2.min.css">
    <script src="<?= base_url() ?>Assets/plugins/select2/select2.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <?= $this->include('layouts/header') ?>
    <div id="layoutSidenav">
        <?= $this->include('layouts/aside') ?>
        <div id="layoutSidenav_content">
            <main>
                <?= $this->renderSection('content') ?>
            </main>
            <?= $this->include('layouts/footer') ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>Assets/js/scripts.js"></script>
    
    <?= $this->renderSection('scripts') ?>
</body>

</html>