<?php ob_start(); ?>
    <h2>Service Temporarily Unavailable.</h2>
    <p>Try again later.</p>
<?php $content = ob_get_contents();
ob_end_clean();
$title = 'Service Temporarily Unavailable.';

require_once __DIR__ . '/base.php';
?>