<?php
    // Include initializer.php for app initialization
    include_once('initializer.php');
?>

<!doctype html>
<html lang="<?= lang('tr_code'); ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="<?= conf('pi_logo'); ?>">
        <title><?= conf('pi_title'); ?></title>
    </head>
    <body>
        <nav class="navbar sticky-top navbar-expand-lg
            <?php
                // Set navbar theme from configuration
                switch (conf('pi_theme')) {
                    case 1:
                        echo('navbar-dark bg-dark');
                        break;
                    case 2:
                        echo('navbar-dark bg-primary');
                        break;

                    default:
                        echo('navbar-light bg-light');
                        break;
                }
            ?>
        ">
            <span class="navbar-brand mb-0 h1">
                <img src="<?= conf('pi_logo'); ?>" height="30" class="d-inline-block align-top" alt="" loading="lazy">
                <?= conf('pi_title'); ?>
            </span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item
                        <?php
                            if (PAGE == 'shortener') {
                                echo('active');
                            }
                        ?>
                    ">
                        <a class="nav-link" href="index.php"><?= lang('mb_short'); ?> <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item
                        <?php
                            if (PAGE == 'unshortener') {
                                echo('active');
                            }
                        ?>
                    ">
                        <a class="nav-link" href="unshortener.php"><?= lang('mb_unshort'); ?> <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">