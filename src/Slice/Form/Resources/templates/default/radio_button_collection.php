<?php
/**
 * @var $formName string
 * @var $input \Slice\Form\Field\RadioButtonCollection
 */
?>
<div class="radio-button-collection">
    <?php foreach ($input as $collectionItem) {
        echo $this->renderField($collectionItem, $formName);
    } ?>
</div>