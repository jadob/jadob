<?php
$inputId = $formName . '_' . $input->getName();
$isRequiredDefined = false;
?>
<div class="choice-type">
    <label for="<?= $inputId; ?>"><?= $input->getLabel(); ?></label>:
    <!-- okay, so at first we need to know what we need to render -->
    <?php if ($input->getExpanded()) { //render inputs ?>
        <?php foreach ($input->getValues() as $key => $value) { ?>

        <?php } ?>
    <?php } else { ?>
        <select <?= $input->getRequired() ? 'required' : '' ?> <?= $input->getMultiple() ? 'multiple' : '' ?> id="<?= $inputId; ?>" name="<?= $formName; ?>[<?= $input->getName(); ?>]<?= $input->getMultiple() ? '[]' : '' ?>">
            <?php foreach ($input->getValues() as $key => $value) { ?>
                <option value="<?= $key; ?>"><?= $value; ?></option>
            <?php } ?>
        </select>
    <?php } ?>
</div>
<?php unset($inputId, $isRequiredDefined); ?>