<?php
    // Define PAGE constant with page name for header.php initialization
    define('PAGE', 'shortener');

    // Include header.php with page header
    include_once('header.php');

    if (isset($_GET['c'])) {
        $query = Db::queryOne('
            SELECT url
            FROM shorted
            WHERE code=?
        ', htmlspecialchars($_GET['c']));

        if ($query) {
            Db::query('
                UPDATE shorted
                SET stat=stat+1
                WHERE code=?
            ', htmlspecialchars($_GET['c']));

            header('Location: ' . $query['url']);

            exit();
        } else {
            $ownerror = lang('sf_rnexist');
        }
    }

    if ($_POST) {
        if (!isset($_POST['code']) || empty($_POST['code'])) {
            do {
                $rand = '';
                $alphabet = 'abcdefghijklmnopqrstuvwxyz0123456789';
                for ($i = 0; $i < conf('sh_length'); $i++) {
                    $rand .= $alphabet[rand(0, strlen($alphabet))];
                }
            } while (Db::queryOne('
                SELECT id
                FROM shorted
                WHERE code=?
            ', $rand));

            $code = $rand;
        } else {
            if (Db::queryOne('
                SELECT id
                FROM shorted
                WHERE code=?
            ', $_POST['code'])) {
                $ownexists = true;
            } else {
                $code = $_POST['code'];
            }
        }

        if (!isset($ownexists)) {
            if (Db::query('
                INSERT INTO shorted (url, code)
                VALUES (?, ?)
            ', htmlspecialchars($_POST['url']), htmlspecialchars($code))) {
                $success = true;
            } else {
                $error = true;
            }
        }
    }
?>
    <?php if ($_POST): ?>
        <?php if (isset($ownexists)): ?>
            <div class="alert alert-warning" role="alert">
                <?= htmlspecialchars(lang('sf_exists')); ?>
            </div>
        <?php elseif (isset($success)): ?>
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars(lang('sf_success')); ?>
                <b><a class="alert-link" href="<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>?c=<?= htmlspecialchars($code); ?>"><?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>?c=<?= htmlspecialchars($code); ?></a></b>
            </div>
        <?php elseif (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars(lang('sf_error')); ?>
            </div>
        <?php elseif (isset($ownerror)): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($ownerror); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label for="url"><?= lang('sf_url'); ?></label>
            <input id="url" type="url" class="form-control" name="url" required>
            <small class="form-text text-muted"><?= lang('sf_http'); ?></small>
        </div>
        <div class="form-group">
            <label for="code"><?= lang('sf_code'); ?></label>
            <input id="code" type="text" class="form-control" name="code">
            <small class="form-text text-muted"><?= lang('sf_notrequired'); ?></small>
        </div>
        <button type="submit" class="btn btn-primary"><?= lang('sf_shorten'); ?></button>
    </form>

<?php
    include_once('footer.php');
?>
