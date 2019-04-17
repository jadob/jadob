<?php /** @var \Throwable $exception */ ?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Exception Occured | Jadob <?= \Jadob\Core\Kernel::VERSION; ?></title>
    <style>
        /* http://meyerweb.com/eric/tools/css/reset/
   v2.0 | 20110126
   License: none (public domain)
*/

        html, body, div, span, applet, object, iframe,
        h1, h2, h3, h4, h5, h6, p, blockquote, pre,
        a, abbr, acronym, address, big, cite, code,
        del, dfn, em, img, ins, kbd, q, s, samp,
        small, strike, strong, sub, sup, tt, var,
        b, u, i, center,
        dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend,
        table, caption, tbody, tfoot, thead, tr, th, td,
        article, aside, canvas, details, embed,
        figure, figcaption, footer, header, hgroup,
        menu, nav, output, ruby, section, summary,
        time, mark, audio, video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }

        /* HTML5 display-role reset for older browsers */
        article, aside, details, figcaption, figure,
        footer, header, hgroup, menu, nav, section {
            display: block;
        }

        body {
            line-height: 1;
        }

        ol, ul {
            list-style: none;
        }

        blockquote, q {
            quotes: none;
        }

        blockquote:before, blockquote:after,
        q:before, q:after {
            content: '';
            content: none;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
    </style>
    <style>
        body {
            /*background: #EEEEEE;*/
            color: #212121;
        }
        .error-container {
            width: 60%;
            margin-right: auto;
            margin-left: auto;
        }

        .error-container .lenny {
            text-align: center;
            margin: 25px;
        }
        .error-container .content {
            background: #FFFFFF;
            margin-top: 25px;
            padding-bottom: 10px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
        }

        .content .exception-info .exception-fqcn {
            padding: 10px;
            background: #F44236;
            font-weight: 700;
        }

        .content .exception-info .exception-message {
            font-size: 24px;
            /*background: #FFFFFF;*/
            padding: 10px;
            background: #E57373;
            font-weight: 700;
        }

        .content .stack-trace {
            padding: 10px;
            display: grid;
        }

        .content .stack-trace .trace-header {
            font-size: 20px;
        }

        .content .stack-trace .row .number {
            font-weight: 700;
            width: 10%;
            float: left;
            clear: both;

        }

        .content .stack-trace .row .file {
            /*font-weight: 700;*/
            width: 80%;
            float: left;

        }
    </style>
</head>
<body>
<div class="error-container">
    <div class="lenny">ᕙ(⇀‸↼‶)ᕗ</div>
    <main class="content">
        <header class="navbar">
            <div class="exception-info">

                <h1 class="exception-message">
                    <?= $exception->getMessage(); ?>
                </h1>
                <p class="exception-fqcn">
                    <?= get_class($exception); ?> <br>
                    Thrown in: <strong><?= $exception->getFile(); ?></strong>:<strong><?= $exception->getLine(); ?></strong>
                </p>
            </div>
        </header>
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
                        <p class="function-location">at <?= $item['file']; ?>:<?= $item['line']; ?></p>
                    </div>
                </div>
            <?php } ?>
        </section>
    </main>
    <footer class="footer"></footer>
</div>
</body>
</html>