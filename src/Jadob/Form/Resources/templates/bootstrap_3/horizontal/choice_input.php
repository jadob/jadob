<?php
/** @var \Jadob\Form\Field\ChoiceInput $input */
//@TODO: adding selected/checked values
$inputId = $formName . '_' . $input->getName();
$isRequiredDefined = false;
?>
    <div class="choice-type form-group">
        <label class="text-muted control-label" for="<?= $inputId; ?>"><?= $input->getLabel(); ?></label>
        <?php /** okay, so at first we need to know what we need to render **/ ?>
        <?php if ($input->getExpanded()) { //render inputs ?>
            <?php foreach ($input->getValues() as $key => $value) { ?>
                <div class="radio<?= $input->getOrientation() === 'vertical' ? '-inline' : '' ?>">
                    <label class="control-label text-muted"><input
                                name="<?= $formName; ?>[<?= $input->getName(); ?>]<?= $input->getMultiple() ? '[]' : '' ?>"
                                type="<?= $input->getMultiple() ? 'checkbox' : 'radio' ?>"
                                value="<?= $key ?>"
                        ><?= $value ?></label>
                </div>

            <?php } ?>
        <?php } else { // render select form?>
            <select class="form-control" <?= $input->getRequired() ? 'required' : '' ?> <?= $input->getMultiple() ? 'multiple' : '' ?>
                    id="<?= $inputId; ?>"
                    name="<?= $formName; ?>[<?= $input->getName(); ?>]<?= $input->getMultiple() ? '[]' : '' ?>">
                <?php foreach ($input->getValues() as $key => $value) { ?>
                    <option value="<?= $key; ?>"><?= $value; ?></option>
                <?php } ?>
            </select>
        <?php } ?>
    </div>
<?php unset($inputId, $isRequiredDefined); ?>