<div class="input-collection">
    <?php foreach ($input as $collectionItem) {
        echo $this->renderField($collectionItem, $formName);
    } ?>
</div>