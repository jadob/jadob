<?php ob_start(); ?>
    <h2>Page Not Found.</h2>
    <p>Check your URL and try again.</p>
<?php $content = ob_get_contents();
ob_end_clean();
$title = 'Page Not Found';

require_once __DIR__ . '/base.php';
?>
