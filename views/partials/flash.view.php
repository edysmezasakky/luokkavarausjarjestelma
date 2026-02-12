<?php

use App\Flash;

$messages = Flash::get();

// Map your backend types to DaisyUI classes
$alertClassMap = [
    'success' => 'alert-success', // Green
    'error'   => 'alert-error',   // Red
    'warning' => 'alert-warning', // Yellow
    'info'    => 'alert-info'     // Blue
];
?>


<?php if (!empty($messages)): ?>
    <div class="toast toast-top toast-end">
        <?php foreach ($messages as $msg): ?>

            <div role="alert" class="alert <?= $alertClassMap[$msg['type']] ?? 'alert-info' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span><?= htmlspecialchars($msg['message']) ?></span>
            </div>

        <?php endforeach; ?>
    </div>
<?php endif; ?>
