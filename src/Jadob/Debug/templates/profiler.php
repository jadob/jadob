<style>
    .jadob-profiler {
        position: fixed;
        bottom: 0;
        width: 100%;
        background: #424242;
        color: #EEEEEE;
        padding: 3px;
    }
</style>
<div class="jadob-profiler">
    <section class="profiler-section">
        <strong>PHP:</strong> <?php echo PHP_VERSION; ?> |
        <strong>Jadob:</strong> <?php echo \Jadob\Core\Kernel::VERSION; ?> |
        <strong>PHP SAPI:</strong> <?php echo PHP_SAPI; ?> |
        <strong>xdebug:</strong>
        <?php if (\extension_loaded('xdebug')) { ?>
            enabled
            <a href="<?php echo $coverageUrl; ?>">coverage report</a>
        <?php } else { ?>
            disabled
        <?php } ?> |

    </section>

</div>