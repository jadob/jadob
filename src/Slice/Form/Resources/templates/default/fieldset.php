<fieldset class="input-collection">
    <legend><?= $input->getLegend(); ?></legend>
    <?php foreach ($input as $collectionItem) {
        echo $this->renderField($collectionItem, $formName);
    } ?>
</fieldset>