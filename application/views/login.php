<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title><?= $title ?></title>

    <link href="<?= base_url('assets') ?>/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f1f1f1;
        }

        .form-signin {
            width: 100%;
            max-width: 370px;
            padding: 15px;
            margin: auto;
        }
    </style>
</head>

<body>

    <?= form_open('', ['class' => 'form-signin']); ?>
    <div class="mb-4 text-center">
        <div class=" mb-3">
            <i class="fa fa-sign-in-alt fa-2x rounded-circle bg-primary text-white p-4"></i>
        </div>
        <h1 class="h4 mb-0 font-weight-light">Login</h1>
        <p class="small text-muted">Login ke akun anda</p>
    </div>

    <div class="card">
        <div class="card-body">
            <?= $this->session->flashdata('msg'); ?>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-user"></i>
                        </div>
                    </div>
                    <input type="text" autocomplete="off" value="<?= set_value('username'); ?>" name="username" class="form-control" autofocus onfocus="this.select()" placeholder="Username">
                </div>
                <?= form_error('username'); ?>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>
                    <input name="password" type="password" class="form-control" placeholder="Password">
                </div>
                <?= form_error('password'); ?>
            </div>
            <button class="btn btn-primary btn-block" type="submit">Login</button>
        </div>
    </div>

    <p class="mt-3 mb-3 text-muted text-center">&copy; <?= date('Y') ?> Material Shop</p>
    <?= form_close(); ?>

</body>

</html>