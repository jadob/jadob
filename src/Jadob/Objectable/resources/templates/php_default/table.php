<div class="table-responsive">
    <table class="table table-sm table-striped table-bordered table-hover">
        <thead>
        <tr>
            <?php foreach ($headers as $header) { ?>
                <td><?= $header ?></td>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <?php foreach ($row as $cell) { ?>
                    <td><?= $cell ?></td>
                <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>