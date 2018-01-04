<?php
/**
 * @var  $formName string
 * @var  $input \Slice\Form\Field\TextInput
 */
$inputId = $formName . '_' . $input->getName();
?>
    <div class="form-group <?= $input->isValid() ? '' : 'has-error' ?>">
        <label for="<?= $inputId; ?>"
               class="text-muted control-label">
            <?= $input->getLabel(); ?>
        </label>
        <input
                id="<?= $inputId; ?>"
                type="text"
                name="<?= $formName; ?>[<?= $input->getName(); ?>]"
                value="<?= $input->getValue() ?: '' ?>"
                class="form-control"
            <?= $input->getRequired() ? 'required' : '' ?>
                placeholder="<?= $input->getPlaceholder(); ?>">
    </div>
<?php unset($inputId);