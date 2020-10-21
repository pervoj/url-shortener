<?php
    // Define PAGE constant with page name for header.php initialization
    define('PAGE', 'unshortener');

    // Include header.php with page header
    include_once('header.php');

    if ($_POST) {
        $url = file_get_contents('https://unshorten.me/s/' . trim(htmlspecialchars($_POST['url'])));
    }
?>

<?php if (isset($url)): ?>
    <div class="alert alert-success" role="alert">
        <?= lang('uf_unshortened'); ?>
        <a class="alert-link" href="<?= htmlspecialchars($url); ?>"><?= htmlspecialchars($url); ?></a>
    </div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <label for="url"><?= lang('uf_url'); ?></label>
        <input id="url" type="url" class="form-control" name="url" required>
        <small class="form-text text-muted"><?= lang('sf_http'); ?></small>
    </div>
    <button type="submit" class="btn btn-primary"><?= lang('uf_unshorten'); ?></button>
</form>

<?php
    include_once('footer.php');
?>
