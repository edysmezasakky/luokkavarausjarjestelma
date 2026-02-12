<?php require __DIR__ . '/partials/header.view.php'; ?>

<h1>Hello page</h1>

<form action="<?= url('hello') ?>" method="post">
    <input class="input" type="text" name="name">
    <button class="btn" type="submit">Send</button>
</form>

<?php require __DIR__ . '/partials/footer.view.php'; ?>