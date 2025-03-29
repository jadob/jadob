<?php declare(strict_types=1);
use Jadob\Core\Kernel;

/**
 * @var $exception Exception 
*/?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo get_class($exception); ?> | Jadob Debugger</title>
    <meta name="robots" content="noindex, nofollow">
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

        strong {
            font-weight: 700;
        }

        .error-wrapper {
            padding-top: 15px;
            width: 60%;
            margin-right: auto;
            margin-left: auto;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .error-wrapper__header {
            display: flex;
            border-bottom: 1px solid #D2D7D3;
            padding-bottom: 10px;
        }

        .error-wrapper__header_metadata {
            width: 75%;
            float: left;
        }

        .error-wrapper__header_metadata_exception-info {
            color: #95A5A6;
            font-size: 14px;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .error-wrapper__header_metadata_exception-class {
            font-size: 24px;
            color: #212121;
            font-weight: 700;
            margin-top: 15px;
            margin-bottom: 10px;
        }

        .error-wrapper__content_metadata_exception-message {
            font-size: 32px;
            color: #CF000F;
            font-weight: 700;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .error-wrapper__sad-emoticon_wrapper {
            opacity: 0.3;
            padding: 25px;
            color: #D64541;
            font-size: 70px;
            display: block;
        }

        .error-wrapper__sad-emoticon_wrapper:hover {
            opacity: 1;
        }

        .error-wrapper__content_stack-trace {
            display: grid;
        }

        .error-wrapper__content_stack-trace-header {
            font-size: 22px;
            color: #212121;
            font-weight: 700;
            margin-top: 15px;
            margin-bottom: 10px;
        }

        .error-wrapper__footer {
            padding-top: 10px;
            border-top: 1px solid #D2D7D3;
        }

        .error-wrapper__footer-link {
            font-size: 12px;
            color: #95A5A6;
            text-decoration: none;
        }

        .table {
            width: 100%;
        }

        .table tr {
            border-bottom: 1px solid #212121;
        }

        .table thead {
            font-weight: 700;
        }

        .table td {
            padding: 5px;
        }

        .table .key {
            border-right: 1px dotted #95A5A6;
        }

        .no-message {
            color: #95A5A6;
            font-weight: 400;
        }

        .table .file-path {
            padding-top: 5px;
            color: #95A5A6;
            font-size: 12px;
        }
    </style>
</head>
<body>
<main class="error-wrapper">
    <section class="error-wrapper__header">
        <div class="error-wrapper__header_metadata">
            <h2 class="error-wrapper__header_metadata_exception-class"><?php echo \get_class($exception); ?></h2>
            <p class="error-wrapper__header_metadata_exception-info">File:
                <strong><?php echo $exception->getFile(); ?></strong></p>
            <p class="error-wrapper__header_metadata_exception-info">Line:
                <strong><?php echo $exception->getLine(); ?></strong></p>
            <p class="error-wrapper__header_metadata_exception-info">Code:
                <strong><?php echo $exception->getCode(); ?></strong></p>
        </div>
        <section class="error-wrapper__sad-emoticon">
            <span class="error-wrapper__sad-emoticon_wrapper">ಠ_ಠ</span>
        </section>
    </section>
    <section class="error-wrapper__content">
        <h1 class="error-wrapper__content_metadata_exception-message">
            <?php if (strlen($exception->getMessage()) > 0) { ?>
                <?php echo $exception->getMessage(); ?>
            <?php } else { ?>
                <span class="no-message">This exception has no message.</span>
            <?php }; ?>
        </h1>
        <section class="error-wrapper__content_stack-trace">
            <h2 class="error-wrapper__content_stack-trace-header">
                Stack Trace:
            </h2>
            <table class="table">
                <thead>
                <tr>
                    <td class="key">No.</td>
                    <td class="function">Method:</td>
                    <td class="line">Line:</td>

                </tr>
                </thead>
                <tbody>
                <?php $stackTrace = $exception->getTrace();
                $stepsCount = count($stackTrace);
                foreach ($stackTrace as $element) { ?>
                    <tr>
                        <td class="key"><?php echo $stepsCount--; ?></td>
                        <td class="function">
                            <?php
                            $fullFunctionCall = $element['function'];
                            if (isset($element['class'])) {
                                $fullFunctionCall = $element['class'] . $element['type'] . $element['function'];
                            }
                            ?>
                            <?php echo $fullFunctionCall ?>
                            (<?php echo \Jadob\Debug\ErrorHandler\DevelopmentErrorHandler::parseParams($element['args'] ?? null) ?>
                            )
                            <p class="file-path">
                                <?php if (isset($element['file'])) { ?>
                                    <?php echo $element['file']; ?>
                                <?php } ?>
                            </p>
                        </td>
                        <td> <?php echo $element['line'] ?? null ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </section>
    </section>

    <footer class="error-wrapper__footer">
        <a target="_blank"
           class="error-wrapper__footer-link"
           href="https://github.com/jadob/jadob">Jadob Framework <?php echo Kernel::VERSION ?> </a>
    </footer>
</main>

</body>
</html>