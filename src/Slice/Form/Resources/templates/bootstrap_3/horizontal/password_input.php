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
                type="password"
                name="<?= $formName; ?>[<?= $input->getName(); ?>]"
                value=""
                class="form-control"
            <?= $input->getRequired() ? 'required' : '' ?>
                placeholder="<?= $input->getPlaceholder(); ?>">
    </div>
<?php unset($inputId);