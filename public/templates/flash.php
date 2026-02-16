<?php

$messages = flash_get();

$messagesMap = [
  'error' => [
    'class' => 'alert-destructive',
    'title' => 'Virhe',
  ],
  'info' => [
    'class' => 'alert-info',
    'title' => 'Huomio',
  ],
  'warning' => [
    'class' => 'alert-warning',
    'title' => 'Varoitus',
  ],
  'success' => [
    'class' => 'alert-success',
    'title' => 'Menestys',
  ],
];
?>

<?php if (!empty($messages)): ?>
  <?php foreach ($messages as $msg): ?>

    <div role="alert" class="alert <?= $messagesMap[$msg['type']]['class']; ?>">
      <div>
        <h5 class="alert-title"><?= $messagesMap[$msg['type']]['title']; ?></h5>
        <p class="alert-description">
          <?= htmlspecialchars($msg['message']) ?>
        </p>
      </div>
    </div>

  <?php endforeach; ?>

<?php endif; ?>
