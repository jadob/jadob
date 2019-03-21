<?php /** @var \Throwable $exception */ ?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Exception Occured | Jadob <?= \Jadob\Core\Kernel::VERSION; ?></title>
</head>
<body>
<div class="error-container">
    <header class="navbar"></header>
    <main class="content">
        <section class="exception-info">
            <p class="exception-fqcn">
                <?= get_class($exception); ?>
            </p>
            <h1 class="exception-message">
                <?= $exception->getMessage(); ?>
            </h1>
            <p class="exception-file">
                <strong><?= $exception->getFile(); ?></strong>:<strong><?= $exception->getLine(); ?></strong>
            </p>
        </section>
        <section class="stack-trace">
            <h1 class="trace-header">Stack Trace:</h1>
            <?php
            $x = 0;
            foreach ($exception->getTrace() as $item) { ?>
                <?php $x++; ?>

                <div class="row">
                    <div class="number"><?= $x; ?></div>
                    <div class="file">
                        <div class="function-name">
                            <?= $item['class']; ?><?= $item['type']; ?><?= $item['function']; ?>(
                            <?php foreach ($item['args'] as $arg) { ?>
                                <?= gettype($arg); ?><?php if (is_string($arg)) { ?>(<?= $arg; ?>)<?php } ?>
                            <?php } ?>
                            )
                        </div>
                        <?= $item['file']; ?>:<?= $item['line']; ?>
                    </div>
                </div>
            <?php } ?>
        </section>
    </main>
    <footer class="footer"></footer>
</div>
</body>
</html>